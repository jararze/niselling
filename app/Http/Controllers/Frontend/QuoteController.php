<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Configuration\Agent;
use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\QueryParameterValueResolver;

class QuoteController extends Controller
{

    const PAYMENT_METHOD_BANK_TRANSFER = 1;

    public function updateContactType($id, string $contactType)
    {
        $quote = Quote::findOrFail($id);
        $quote->type_contact = $contactType;
        $quote->save();
        return $quote;
    }

    public function whatsapp($id)
    {
        try {
            $this->updateContactType($id, 'whatsapp');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function thanks($id)
    {
        $this->updateContactType($id, 'phone');
        return view('frontend.quote.thanks');
    }

    public function online($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->type_contact = 'online';
        $quote->save();

        return view('frontend.quote.online', [
            'id' => $id,
        ]);
    }


    public function bank_transfer(Request $request)
    {
        $isBankTransfer = $request->payment == self::PAYMENT_METHOD_BANK_TRANSFER;

        $wayToPay = $isBankTransfer ? 'transferencia_bancaria' : 'online_libelula';
        $route = $isBankTransfer ? 'frontend.quote.bank.transfer' : 'frontend.quote.libelula.transfer';

        $quote = Quote::findOrFail($request->id);
        $quote->way_to_pay = $wayToPay;
        $quote->save();

        return view($route, [
            'id' => $request->id,
        ]);
    }

    public function libelula_transfer(Request $request)
    {
        $quote = Quote::findOrFail($request->id);
        $send_id = strtotime($quote->created_at) . $quote->id;

        $body = [
            "appkey" => config('app.libelula_app_key'),
            "email_cliente" => $quote->email,
            "identificador" => $send_id,
            "callback_url" => config('app.libelula_callback_url'),
            "url_retorno" => config('app.libelula_url_return'),
            "descripcion" => "Reserva del vehiculo " . $quote->modelOfCar->name . " " . $quote->gradeOfCar->name . " " . $quote->colorOfCar->name . " a nombre de: " . $quote->name . " " . $quote->last_name . " con CI: " . $quote->dni . " en la ciudad de: " . $quote->cityOfCar->name . " con un monto de: " . $quote->gradeOfCar->price,
            "nombre_cliente" => $quote->name,
            "apellido_cliente" => $quote->last_name,
            "nit" => $quote->dni,
            "razón_social" => $quote->name . " " . $quote->last_name,
            "ci" => $quote->dni,
            "fecha_vencimiento" => $quote->created_at->addDays(1)->format('Y-m-d H:i'),
            "lineas_detalle_deuda" => [
                ["concepto" => "Reserva del vehiculo " . $quote->modelOfCar->name . " " . $quote->gradeOfCar->name . " " . $quote->colorOfCar->name, "cantidad" => 1, "costo_unitario" => 1, "descuento_unitario" => 0],
            ],
            "lineas_metadatos" => [
                ["nombre" => "Vendedor", "dato" => $quote->agentOfCar->name],
                ["nombre" => "Showroom", "dato" => $quote->showroomOfCar->name]
            ]
        ];

        $client = new Client();
        $response = $client->request('POST', config('app.libelula_api_url'), [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($body),
        ]);
        $responseContents = $response->getBody()->getContents();
        $parsedResponse = json_decode($responseContents, true);
//        dd($parsedResponse);
        if ($parsedResponse['error'] == 0) {
            $quote->libelula_id = $send_id;
            $quote->libelula_id_transaction = $parsedResponse['id_transaccion'];
            $quote->codigo_recaudacion = $parsedResponse['codigo_recaudacion'];
            $quote->save();
//            dd("dasd");
            return redirect($parsedResponse['url_pasarela_pagos']);
        } else {
            $quote->error_libelula = $parsedResponse['mensaje'];
            $quote->save();
            return redirect()->route('frontend.index')->with('error', 'Error al procesar la solicitud');
        }
    }

    public function voucher(Request $request)
    {
        dd($request);
        $validatedData = $request->validate([
            'comprobante' => 'required|mimes:jpg,jpeg,png,pdf|max:5120', // max size 5MB
        ]);



        if ($validatedData->fails()) {
            return view('frontend.quote.store.voucher')
                ->withErrors($validatedData)
                ->withInput();
        }

        $quote = Quote::findOrFail($request->id);

        if ($request->hasFile('comprobante')) {

            $originalImage = $request->file('comprobante');
            $filename = time() . '_' . $originalImage->getClientOriginalName();
            $originalPath = 'public/vaucher/' . $quote->id . '/';
            Storage::makeDirectory($originalPath);

            $extension = strtolower($originalImage->getClientOriginalExtension());
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($originalImage);

                Storage::put($originalPath . $filename, (string)$image->encode());
            } elseif ($extension == 'pdf') {
                Storage::putFileAs($originalPath, $originalImage, $filename);
            } else {
                return back()->with('error', 'Invalid file type');
            }


            $quote->way_to_pay_image = $filename;
            $quote->save();

            return view('frontend.thanks.voucher', [
                'id' => $request->id,
            ]);

        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last-name' => ['required', 'string', 'max:255'],
            'models' => ['required'],
            'grade' => ['required'],
            'phone' => ['required'],
            'city' => ['required'],
            'dni' => ['required'],
            'ext' => ['required'],
            'showroom' => ['required'],
            'email' => ['required'],
            'testDrive' => 'sometimes',
        ]);


        $quote = new Quote();
        $quote->name = $validatedData['name'];
        $quote->last_name = $validatedData['last-name'];
        $quote->model = $validatedData['models'];
        $quote->grade = $validatedData['grade'];
        $quote->phone = $validatedData['phone'];
        $quote->city = $validatedData['city'];
        $quote->dni = $validatedData['dni'];
        $quote->ext = $validatedData['ext'];
        $quote->showroom = $validatedData['showroom'];
        $quote->email = $validatedData['email'];
        $quote->test_drive = $request->has('testDrive') ? $request->get('testDrive') : 0;

        $quote->save();

        return Redirect::route('frontend.quote_second.show', $quote->id)->with('status', 'created');

    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeFinal(Request $request)
    {

        $validatedData = $request->validate([
            'models' => ['required'],
            'grade' => ['required'],
            'selected_color' => ['required'],
        ]);

        $oldQuote = Quote::findOrfail($request->quote_id);

        $oldQuote->model = $validatedData['models'];
        $oldQuote->grade = $validatedData['grade'];
        $oldQuote->color = $validatedData['selected_color'];

        $agents = Agent::where('showroom_id', $oldQuote->showroom)->get();

        $lastAssignedAgentId = Cache::get('last_assigned_agent', $agents->first()->id);
        $currentKey = $agents->search(function ($agent) use ($lastAssignedAgentId) {
            return $agent->id == $lastAssignedAgentId;
        });
        $nextKey = ($currentKey + 1) % $agents->count();
        $nextAgent = $agents[$nextKey];
        $oldQuote->agent_id = $nextAgent->id;
        Cache::put('last_assigned_agent', $nextAgent->id);

        $apiData = $this->getApiData($oldQuote);

// aqui esta mi antiguo codigo para envio de la api volver aqui si falla en produccion

//        $client = new Client();
//
//        $username = 'paginaWeb@api.com';
//        $password = 'paginaWeb123';
//        $apiUrl = 'https://test-nissanbolivia.tecnomcrm.com/api/v1/webconnector/consultas/adf';
//
//        $apiData = [
//            'prospect' => [
//                'requestdate' => date('c'),
//                'customer' => [
//                    'comments' => 'Esta compra viene del cotizador de NIssan Bolivia: ' . $oldQuote->id,
//                    'contacts' => [
//                        [
//                            'emails' => [
//                                [
//                                    'value' => $oldQuote->email
//                                ]
//                            ],
//                            'names' => [
//                                [
//                                    'part' => 'first',
//                                    'value' => $oldQuote->name
//                                ],
//                                [
//                                    'part' => 'last',
//                                    'value' => $oldQuote->last_name
//                                ]
//                            ],
//                            'phones' => [
//                                [
//                                    'type' => 'cellphone',
//                                    'value' => $oldQuote->phone
//                                ]
//                            ],
//                            'addresses' => [
//                                [
//                                    'city' => $oldQuote->cityOfCar->name,
//                                    'postalcode' => '591'
//                                ]
//                            ],
//                        ],
//                    ]
//                ],
//                'vehicles' => [
//                    [
//                        'make' => $oldQuote->modelOfCar->name,
//                        'model' => $oldQuote->gradeOfCar->name,
//                        'trim' => $oldQuote->gradeOfCar->name,
//                        'year' => $oldQuote->gradeOfCar->commercial_date
//                    ]
//                ],
//                'provider' => [
//                    'name' => [
//                        'value' => 'Cotizador Nissan'
//                    ],
//                    'service' => 'Cotizador Nissan'
//                ],
//                'vendor' => [
//                    'contacts' => [],
//                    'vendorname' => [
//                        'value' => $nextAgent->email
//                    ]
//                ]
//            ]
//        ];

        try {
//            $response = $client->post($apiUrl, [
//                'json' => $apiData,
//                'auth' => [$username, $password]
//            ]);
            $response = $this->sendAPIRequest($apiData);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) { // Success case
                $result = json_decode($response->getBody()->getContents(), true);
                $oldQuote->tecnom_id = $result['id'];
                $oldQuote->status = 'crm';
            } elseif ($statusCode == 400) { // Expected error case
                $oldQuote->error_tecnom = $statusCode;
//                dd('Error: '. $response->getBody()->getContents());
            } else { // Unexpected error case
                $oldQuote->error_tecnom = $response->getBody();
//                dd('Unexpected status code: ' . $statusCode . ', Response: ' . $response->getBody()->getContents());
            }

        } catch (GuzzleException $e) {
            $oldQuote->error_tecnom = $e->getCode();
        }
        $oldQuote->save();
        return Redirect::route('frontend.quote.final.proform', $oldQuote->id)->with('status', 'created');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
        $quote = Quote::findOrfail($id);
        $grades = Grade::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        $colors = VehicleColor::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        return view('frontend.quote.show', compact('quote', 'colors', 'models', 'grades'));
    }

    /**
     * Display the specified resource.
     */
    public function finalQuote($id)
    {
        $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
        $quote = Quote::findOrfail($id);
        $grades = Grade::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        $colors = VehicleColor::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        return view('frontend.quote.final_quote', compact('quote', 'colors', 'models', 'grades'));
    }

    public function generatePDF($quote_id)
    {
        $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
        $quote = Quote::findOrfail($quote_id);
        $grades = Grade::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        $colors = VehicleColor::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('frontend.quote.pdf', compact('quote', 'colors', 'models', 'grades'));
//        return view('frontend.quote.pdf', compact('quote', 'colors', 'models', 'grades'));
        $name = 'proforma_' . str_pad($quote->id, 6, '0', STR_PAD_LEFT) . '.pdf';
        return $pdf->download($name);
//        return $pdf->stream('quote.pdf');
    }

    public function getGrades($id): JsonResponse
    {
        $grades = DB::table('grades as g')
            ->join('model_of_cars as m', 'm.id', '=', 'g.model_of_cars_id')
            ->select('g.cylindered', 'g.transmission', 'g.traction', 'g.commercial_date', 'g.price', 'g.discount', 'm.data_sheet')
            ->where('g.id', $id)
            ->get();

        return response()->json($grades);
    }

    public function getModels($id): JsonResponse
    {
        $grades = Grade::where("model_of_cars_id", $id)
            ->pluck("name", "id");
        $image = ModelOfCar::where('id', $id)->pluck('image', 'slug');
        $colors = VehicleColor::where('model_of_cars_id', $id)->get();
        return response()->json(['grades' => $grades, 'image' => $image, 'colors' => $colors]);
    }

    public function index()
    {
        $values = Quote::whereNull('way_to_pay')->orderBy('created_at', 'DESC')->get();
        return view('backend.quotes.index', [
            'values' => $values,
        ]);
    }

    public function transferOnline()
    {
        $values = Quote::where('way_to_pay', 'online_libelula')->orderBy('created_at', 'DESC')->get();
        return view('backend.quotes.index', [
            'values' => $values,
        ]);
    }

    public function bank()
    {
        $values = Quote::where('way_to_pay', 'transferencia_bancaria')->orderBy('created_at', 'DESC')->get();
        return view('backend.quotes.index', [
            'values' => $values,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $grade = Quote::findOrFail($id);

        return view('backend.quote.edit', [
            'quote' => $grade
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function resend($id)
    {
        $quote = Quote::findOrFail($id);
        $apiData = $this->getApiData($quote);
//        $client = new Client();
//
//        $username = 'paginaWeb@api.com';
//        $password = 'paginaWeb123';
//        $apiUrl = 'https://test-nissanbolivia.tecnomcrm.com/api/v1/webconnector/consultas/adf';
//
//        $apiData = [
//            'prospect' => [
//                'requestdate' => date('c'),
//                'customer' => [
//                    'comments' => 'Esta compra viene del cotizador de NIssan Bolivia: ' . $quote->id,
//                    'contacts' => [
//                        [
//                            'emails' => [
//                                [
//                                    'value' => $quote->email
//                                ]
//                            ],
//                            'names' => [
//                                [
//                                    'part' => 'first',
//                                    'value' => $quote->name
//                                ],
//                                [
//                                    'part' => 'last',
//                                    'value' => $quote->last_name
//                                ]
//                            ],
//                            'phones' => [
//                                [
//                                    'type' => 'cellphone',
//                                    'value' => $quote->phone
//                                ]
//                            ],
//                            'addresses' => [
//                                [
//                                    'city' => $quote->cityOfCar->name,
//                                    'postalcode' => '591'
//                                ]
//                            ],
//                        ],
//                    ]
//                ],
//                'vehicles' => [
//                    [
//                        'make' => $quote->modelOfCar->name,
//                        'model' => $quote->gradeOfCar->name,
//                        'trim' => $quote->gradeOfCar->name,
//                        'year' => $quote->gradeOfCar->commercial_date
//                    ]
//                ],
//                'provider' => [
//                    'name' => [
//                        'value' => 'Cotizador Nissan'
//                    ],
//                    'service' => 'Cotizador Nissan'
//                ],
//                'vendor' => [
//                    'contacts' => [],
//                    'vendorname' => [
//                        'value' => $quote->agentOfCar->email
//                    ]
//                ]
//            ]
//        ];

        try {

//            $response = $client->post($apiUrl, [
//                'json' => $apiData,
//                'auth' => [$username, $password]
//            ]);
            $response = $this->sendAPIRequest($apiData);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) { // Success case
                $result = json_decode($response->getBody()->getContents(), true);
                $quote->tecnom_id = $result['id'];
                $quote->status = 'crm';
            } elseif ($statusCode == 400) { // Expected error case
                $quote->error_tecnom = $statusCode;
            } else { // Unexpected error case
                $quote->error_tecnom = $response->getBody();
            }
            $quote->save();
        } catch (GuzzleException $e) {
            $quote->error_tecnom = $e->getCode();
        }
        $quote->save();
        $quote2 = Quote::findOrFail($id);
        return view('backend.quote.edit', [
            'quote' => $quote2
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
//        dd($quote);
        json_decode($request->getContent(), true);
        $ids = $request->ids;

        $deleted = Quote::destroy($ids);

        if ($deleted) {
            return response()->json([
                'status' => true,
                'variable3' => $ids
            ]);
        } else {
            return response()->json([
                'status' => false,
                'data' => null
            ], 404);
        }
    }

    private function getAPICredentials(): array
    {
        return [
            'username' => config('app.api_username'),
            'password' => config('app.api_password'),
        ];
    }

    private function getApiData(Quote $quote): array
    {
        // Build and return the 'apiData' array...
        $apiData = [
            'prospect' => [
                'requestdate' => date('c'),
                'customer' => [
                    'comments' => 'Esta compra viene del cotizador de NIssan Bolivia: ' . $quote->id,
                    'contacts' => [
                        [
                            'emails' => [
                                [
                                    'value' => $quote->email
                                ]
                            ],
                            'names' => [
                                [
                                    'part' => 'first',
                                    'value' => $quote->name
                                ],
                                [
                                    'part' => 'last',
                                    'value' => $quote->last_name
                                ]
                            ],
                            'phones' => [
                                [
                                    'type' => 'cellphone',
                                    'value' => $quote->phone
                                ]
                            ],
                            'addresses' => [
                                [
                                    'city' => $quote->cityOfCar->name,
                                    'postalcode' => '591'
                                ]
                            ],
                        ],
                    ]
                ],
                'vehicles' => [
                    [
                        'make' => $quote->modelOfCar->name,
                        'model' => $quote->gradeOfCar->name,
                        'trim' => $quote->gradeOfCar->name,
                        'year' => $quote->gradeOfCar->commercial_date
                    ]
                ],
                'provider' => [
                    'name' => [
                        'value' => 'Cotizador Nissan'
                    ],
                    'service' => 'Cotizador Nissan'
                ],
                'vendor' => [
                    'contacts' => [],
                    'vendorname' => [
                        'value' => $quote->agentOfCar->email
                    ]
                ]
            ],
            // Rest of the array elements...
        ];
        return $apiData;
    }

    private function sendAPIRequest(array $apiData)
    {
        $client = new Client();
        $credentials = $this->getAPICredentials();
        $apiUrl = config('app.api_url');
//        dd(config('app'));
//        dd('usario',$apiUrl);

        $response = $client->post($apiUrl, [
            'json' => $apiData,
            'auth' => [$credentials['username'], $credentials['password']],
        ]);

        return $response;
    }

    public function successfulPayment(Request $request)
    {
        $transaction_id = $request->input('transaction_id');
//        dd(config('app.libelula_url_return'));
        //dd($transaction_id);
        return view('frontend.quote.thanks');


    }

    public function verifyPayment($transaction)
    {
        $body = [
            "appkey" => config('app.libelula_app_key'),
            "codigo_recaudacion" => $transaction
        ];

        $quote = Quote::where('codigo_recaudacion', $transaction)->firstOrFail();

        $client = new Client();
        $response = $client->request('POST', "https://api.todotix.com/rest/deuda/consultar_deudas/por_identificador", [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($body),
        ]);
        $responseContents = $response->getBody()->getContents();
        $parsedResponse = json_decode($responseContents, true);
//        dd($parsedResponse['datos']['identificador']);
        if ($parsedResponse['error'] == 0) {
            $quote->libelula_id_response = $parsedResponse['datos']['identificador'];
            $quote->save();
            return view('backend.quote.edit', ['quote' => $quote]);
        }
    }


}
