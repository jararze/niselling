<?php

namespace App\Http\Controllers\Frontend;

use App\Exports\DataExport;
use App\Http\Controllers\Controller;
use App\Models\backend\Configuration\Agent;
use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;

class QuoteController extends Controller
{

    const PAYMENT_METHOD_BANK_TRANSFER = 1;

    // Las URLs del flujo público llevan firma con expiración: la proforma
    // caduca porque el tipo de cambio varía a diario.
    const SIGNED_URL_TTL_HOURS = 72;

    private function temporarySignedFlowUrl(string $routeName, mixed $parameters): string
    {
        return URL::temporarySignedRoute(
            $routeName,
            now()->addHours(self::SIGNED_URL_TTL_HOURS),
            $parameters
        );
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

    public function updateContactType($id, string $contactType)
    {
        $quote = Quote::findOrFail($id);
        $quote->type_contact = $contactType;
        $quote->save();
        return $quote;
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
            'bankTransferAction' => $this->temporarySignedFlowUrl('frontend.bank.transfer', ['id' => $quote->id]),
            'proformUrl' => $this->temporarySignedFlowUrl('frontend.quote.final.proform', $quote->id),
        ]);
    }


    public function bank_transfer(Request $request)
    {
        $isBankTransfer = $request->payment == self::PAYMENT_METHOD_BANK_TRANSFER;

        $wayToPay = $isBankTransfer ? 'transferencia_bancaria' : 'online_libelula';
        $route = $isBankTransfer ? 'frontend.quote.bank.transfer' : 'frontend.quote.libelula.transfer';

        // El id viene en el query string firmado, no del body (ver storeFinal).
        $quote = Quote::findOrFail($request->query('id'));
        $quote->way_to_pay = $wayToPay;
        $quote->save();

        return view($route, [
            'id' => $quote->id,
            'voucherAction' => $this->temporarySignedFlowUrl('frontend.quote.store.voucher', ['id' => $quote->id]),
        ]);
    }

    public function libelula_transfer(Request $request)
    {
        $quote = Quote::findOrFail($request->id);
        $send_id = strtotime($quote->created_at).$quote->id;

        $body = [
            "appkey" => config('app.libelula_app_key'),
            "email_cliente" => $quote->email,
            "identificador" => $send_id,
            "callback_url" => config('app.libelula_callback_url'),
            "url_retorno" => config('app.libelula_url_return'),
            "descripcion" => "Reserva del vehiculo ".$quote->modelOfCar->name." ".$quote->gradeOfCar->name." ".$quote->colorOfCar->name." a nombre de: ".$quote->name." ".$quote->last_name." con CI: ".$quote->dni." en la ciudad de: ".$quote->cityOfCar->name." con un monto de: ".$quote->gradeOfCar->price,
            "nombre_cliente" => $quote->name,
            "apellido_cliente" => $quote->last_name,
            "nit" => $quote->dni,
            "razón_social" => $quote->name." ".$quote->last_name,
            "ci" => $quote->dni,
            "fecha_vencimiento" => $quote->created_at->addDays(1)->format('Y-m-d H:i'),
            "lineas_detalle_deuda" => [
                [
                    "concepto" => "Reserva del vehiculo ".$quote->modelOfCar->name." ".$quote->gradeOfCar->name." ".$quote->colorOfCar->name,
                    "cantidad" => 1, "costo_unitario" => 1392, "descuento_unitario" => 0
                ],
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
//        dd($request);
        $validatedData = $request->validate([
            'comprobante' => 'required|mimes:jpg,jpeg,png,pdf|max:5120', // max size 5MB
        ]);

        // El id viene en el query string firmado, no del body (ver storeFinal).
        $quote = Quote::findOrFail($request->query('id'));

        if ($request->hasFile('comprobante')) {

            $originalImage = $request->file('comprobante');
            $filename = time().'_'.$originalImage->getClientOriginalName();
            $originalPath = 'public/vaucher/'.$quote->id.'/';
            Storage::makeDirectory($originalPath);

            $extension = strtolower($originalImage->getClientOriginalExtension());
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($originalImage);

                Storage::put($originalPath.$filename, (string) $image->encode());
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

        $colorCode = VehicleColor::where('model_of_cars_id', $validatedData['models'])
            ->whereNotNull('color_code')
            ->where('color_code', '<>', '')
            ->orderBy('id')
            ->limit(1)
            ->value('color_code');

        $quote->color = $colorCode;

        // El envío del evento a Facebook nunca debe impedir que la
        // cotización del cliente se guarde: se registra el fallo y se sigue.
        try {
            $event = $this->getApiDataFacebook($quote);
            $responseFb = $this->sendAPIRequestFacebook($event);
            $responseContent = $responseFb->getBody();
            $responseData = json_decode($responseContent, true);
            $statusCode = $responseFb->getStatusCode();

            if($statusCode >= 200 && $statusCode < 300 && isset($responseData['fbtrace_id'])) {
                $quote->fb_trace_id = $responseData['fbtrace_id'];
                $quote->fb_code_id = $statusCode;
                $quote->fb_message_id = "Cotización enviada y evento registrado.";
            } else {
                $quote->fb_trace_id = '';
                $quote->fb_code_id = $statusCode;
                $quote->fb_message_id = 'Error';
            }


        } catch (\Throwable $e) {
            $quote->fb_code_id = $e->getCode();
            Log::error('Falló el envío del evento de cotización a Facebook', [
                'email' => $quote->email,
                'error' => $e->getMessage(),
            ]);
        }



        $agents = Agent::where('showroom_id', $validatedData['showroom'])
            ->where('status',1)
            ->get();

        if ($agents->isEmpty()) {
            Log::warning('Cotización sin agente asignado: el showroom no tiene agentes activos', [
                'showroom_id' => $validatedData['showroom'],
                'email' => $quote->email,
            ]);
        } else {
            $lastAssignedAgentId = $agents->firstWhere('last_assigned_agent_id', true);

            $currentKey = $agents->search(fn($agent) => $agent->id == optional($lastAssignedAgentId)->id);
            $nextKey = ($currentKey + 1) % $agents->count();
            $nextAgent = $agents[$nextKey];
            $quote->agent_id = $nextAgent->id;

            $agents->each(function ($agent) use ($nextAgent) {
                $agent->last_assigned_agent_id = $agent->id === $nextAgent->id;
                $agent->save();
            });
        }

        // Mismo criterio que con Facebook: un fallo armando o enviando el
        // prospecto a Tecnom no puede impedir que la cotización se guarde.
        try {
            $apiData = $this->getApiData($quote);
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

        } catch (\Throwable $e) {
            $quote->error_tecnom = $e->getCode();
            Log::error('Falló el envío de la cotización a Tecnom', [
                'email' => $quote->email,
                'error' => $e->getMessage(),
            ]);
        }

        $quote->save();

        return redirect()->to(URL::temporarySignedRoute(
            'frontend.quote_second.show',
            now()->addHours(self::SIGNED_URL_TTL_HOURS),
            $quote->id
        ))->with('status', 'created');

    }

    public function getApiDataFacebook(Quote $quote): array
    {

        $hashed_email = hash('sha256', $quote->email ?? '');
        $hashed_phone = hash('sha256', $quote->phone ?? '');
        $hashed_ci = hash('sha256', $quote->dni ?? '');
        $hashed_fn = hash('sha256', $quote->name ?? '');
        $hashed_ln = hash('sha256', $quote->last_name ?? '');

        $event = [
            "event_name" => "Lead",
            "event_time" => time(),
            "user_data" => [
                "client_user_agent" => $_SERVER['HTTP_USER_AGENT'] ?? '',
                "client_ip_address" => $_SERVER['REMOTE_ADDR'] ?? '',
                "fn" => $hashed_fn,
                "ln" => $hashed_ln,
                "ph" => $hashed_phone,
                "em" => $hashed_email,
                "external_id" => $hashed_ci
            ],
            "custom_data" => [
                "lead_type" => "vehiculo cotizacion",
                "vehicle_model" => $quote->modelOfCar?->name ?? '',
                "vehicle_grade" => $quote->gradeOfCar?->name ?? ''
            ],
            "action_source" => "website"
        ];

        return $event;
    }

    private function getApiData(Quote $quote): array
    {
        $test_drive = $quote->test_drive == 1 ? 'Si' : "No";
        $apiData = [
            'prospect' => [
                'requestdate' => date('c'),
                'customer' => [
                    'comments' => 'Cotizacion de pagina web, el id es el:'.$quote->id.". \n Datos: \n Ciudad: ".$quote->cityOfCar?->name."\n CI: ".$quote->dni." ".$quote->ext." \n Color: ".$quote->colorOfCar?->name."\n Requiere Test Drive: ".$test_drive." \n Contacto por: ".$quote->type_contact,
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
                                    'city' => $quote->cityOfCar?->name,
                                    'postalcode' => '591'
                                ]
                            ],
                        ],
                    ]
                ],
                'vehicles' => [
                    [
                        'make' => 'Nissan',
                        'model' => $quote->modelOfCar?->name,
                        'trim' => $quote->gradeOfCar?->name,
                        'year' => $quote->gradeOfCar?->commercial_date
                    ]
                ],
                'provider' => [
                    'name' => [
                        'value' => 'Sitio web'
                    ],
                    'service' => ''
                ],
                'vendor' => [
                    'contacts' => [],
                    'vendorname' => [
                        'value' => $quote->agentOfCar?->email
//                        'value' => 'pcarrasco@nissan.com.bo'
                    ]
                ]
            ],
            // Rest of the array elements...
        ];
        return $apiData;
    }

    private function sendAPIRequestFacebook(array $apiData)
    {
        $facebook_client = app(Client::class);
        $response = $facebook_client->post('https://graph.facebook.com/v20.0/'.config('app.facebook_pixel_id').'/events', [
            'headers' => [
                'Authorization' => 'Bearer '.config('app.facebook_access_token'),
            ],
            'json' => [
                'data' => [$apiData]
            ]
        ]);

        return $response;
    }
    private function sendAPIRequest(array $apiData)
    {
        $client = app(Client::class);
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

    private function getAPICredentials(): array
    {
        return [
            'username' => config('app.api_username'),
            'password' => config('app.api_password'),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeFinal(Request $request)
    {

        // model/grade llegan de dropdowns poblados por JS: si el fetch falla,
        // el placeholder ("Seleccione un modelo primero.") viaja como valor.
        $validatedData = $request->validate([
            'models' => [
                'required', 'integer',
                Rule::exists('model_of_cars', 'id')->whereNull('deleted_at'),
            ],
            'grade' => [
                'required', 'integer',
                Rule::exists('grades', 'id')
                    ->where('model_of_cars_id', $request->input('models'))
                    ->whereNull('deleted_at'),
            ],
            'selected_color' => [
                'required',
                Rule::exists('vehicle_colors', 'color_code')
                    ->where('model_of_cars_id', $request->input('models'))
                    ->whereNull('deleted_at'),
            ],
        ]);

        // El id de la quote se lee SOLO del query string, que está cubierto
        // por la firma; el body no lo está y un atacante podría inyectar ahí
        // el id de otra quote.
        $oldQuote = Quote::findOrFail($request->query('quote_id'));

        $oldQuote->model = $validatedData['models'];
        $oldQuote->grade = $validatedData['grade'];
        $oldQuote->color = $validatedData['selected_color'];


        $oldQuote->save();
        return redirect()->to(URL::temporarySignedRoute(
            'frontend.quote.final.proform',
            now()->addHours(self::SIGNED_URL_TTL_HOURS),
            $oldQuote->id
        ))->with('status', 'created');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
        $quote = Quote::findOrfail($id);
        $grades = Grade::where('model_of_cars_id', $quote->model)
            ->where('status', 1)
            ->orderBy('order', 'ASC')
            ->get();
        $colors = VehicleColor::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        $storeFinalAction = $this->temporarySignedFlowUrl('frontend.quote.store.final', ['quote_id' => $quote->id]);
        return view('frontend.quote.show', compact('quote', 'colors', 'models', 'grades', 'storeFinalAction'));
    }

    /**
     * Display the specified resource.
     */
    public function finalQuote($id)
    {
        $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
        $quote = Quote::findOrfail($id);
        $grades = Grade::where('model_of_cars_id', $quote->model)
            ->where('status', 1)
            ->orderBy('order', 'ASC')
            ->get();
        $colors = VehicleColor::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        $signedUrls = [
            'pdfUrl' => $this->temporarySignedFlowUrl('frontend.quote.pdf', $quote->id),
            'reservationUrl' => $this->temporarySignedFlowUrl('frontend.online.reservation', $quote->id),
            'thanksUrl' => $this->temporarySignedFlowUrl('frontend.thanks', $quote->id),
            'whatsappEndpoint' => $this->temporarySignedFlowUrl('frontend.contact.whatsapp', $quote->id),
        ];
        return view('frontend.quote.final_quote', compact('quote', 'colors', 'models', 'grades') + $signedUrls);
    }

    public function generatePDF($quote_id)
    {
        $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
        $quote = Quote::findOrfail($quote_id);
        $grades = Grade::where('model_of_cars_id', $quote->model)
            ->where('status', 1)
            ->orderBy('order', 'ASC')
            ->get();
        $colors = VehicleColor::where('model_of_cars_id', $quote->model)->orderBy('order', 'ASC')->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('frontend.quote.pdf', compact('quote', 'colors', 'models', 'grades'));
//        return view('frontend.quote.pdf', compact('quote', 'colors', 'models', 'grades'));
        $name = 'proforma_'.str_pad($quote->id, 6, '0', STR_PAD_LEFT).'.pdf';
        return $pdf->download($name);
//        return $pdf->stream('quote.pdf');
    }

    public function getGrades($id): JsonResponse
    {
        $grades = DB::table('grades as g')
            ->join('model_of_cars as m', 'm.id', '=', 'g.model_of_cars_id')
            ->select('g.cylindered', 'g.transmission', 'g.traction', 'g.commercial_date', 'g.price', 'g.discount',
                'm.data_sheet')
            ->where('g.id', $id)
            ->get();

        return response()->json($grades);
    }

    public function getModels($id): JsonResponse
    {
        $grades = Grade::where("model_of_cars_id", $id)
            ->where('status', 1)
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

    public function export(Request $request)
    {
        $format = $request->input('format');
        $dateRange = $request->input('date_range');

//        $fileName = 'exported_data.' . $format;

        switch ($format) {
            case 'excel':
//                dd($fileName, $dateRange);
                $fileName = 'exported_data.xlsx';
                return Excel::download(new DataExport($dateRange), $fileName);
//                return new DataExport($dateRange);
            case 'pdf':
                // Handle PDF export
                break;
            case 'cvs':
                // Handle CVS export
                break;
            case 'zip':
                // Handle ZIP export
                break;
        }

        return redirect()->back()->with('error', 'Invalid export format selected.');
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


        try {

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
