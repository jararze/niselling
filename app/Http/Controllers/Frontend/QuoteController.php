<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Configuration\Agent;
use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'testDrive' => ['required'],
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
        $quote->test_drive = $validatedData['testDrive'];

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



        $client = new Client();

        $username = 'paginaWeb@api.com';
        $password = 'paginaWeb123';
        $apiUrl = 'https://test-nissanbolivia.tecnomcrm.com/api/v1/webconnector/consultas/adf';

        $apiData = [
            'prospect' => [
                'requestdate' => date('c'),
                'customer' => [
                    'comments' => 'Esta compra viene del cotizador de NIssan Bolivia: ' . $oldQuote->id,
                    'contacts' => [
                        [
                            'emails' => [
                                [
                                    'value' => $oldQuote->email
                                ]
                            ],
                            'names' => [
                                [
                                    'part' => 'first',
                                    'value' => $oldQuote->name
                                ],
                                [
                                    'part' => 'last',
                                    'value' => $oldQuote->last_name
                                ]
                            ],
                            'phones' => [
                                [
                                    'type' => 'cellphone',
                                    'value' => $oldQuote->phone
                                ]
                            ],
                            'addresses' => [
                                [
                                    'city' => $oldQuote->cityOfCar->name,
                                    'postalcode' => '591'
                                ]
                            ],
                        ],
                    ]
                ],
                'vehicles' => [
                    [
                        'make' => $oldQuote->modelOfCar->name,
                        'model' => $oldQuote->gradeOfCar->name,
                        'trim' => $oldQuote->gradeOfCar->name,
                        'year' => $oldQuote->gradeOfCar->commercial_date
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
                        'value' => $nextAgent->email
                    ]
                ]
            ]
        ];

        try {
            $response = $client->post($apiUrl, [
                'json' => $apiData,
                'auth' => [$username, $password]
            ]);

            if ($response->getStatusCode() != 200) {
                dd($response);
            } else {
                $result = json_decode($response->getBody()->getContents(), true);
                $oldQuote->tecnom_id = $result['id'];
            }
            $oldQuote->save();
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Manejar la excepción como necesites
        }

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
