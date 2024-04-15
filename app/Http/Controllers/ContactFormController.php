<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'cellphone' => 'required|string|min:7|max:15',
                'pageUrl' => 'required|string|url|max:255',
            ]);

            $contactForm = ContactForm::create($validatedData);
            $validatedData['contactFormId'] = $contactForm->id;
//            dd($validatedData);
            $apiData = $this->getApiData($validatedData);

            try {
                $response = $this->sendAPIRequest($apiData);
                $statusCode = $response->getStatusCode();

                if ($statusCode == 200) {
                    $result = json_decode($response->getBody()->getContents(), true);
                    $contactForm->tecnom_id = $result['id'];
                    $contactForm->status = 'Send';
                } elseif ($statusCode == 400) { // Expected error case
                    $contactForm->error_tecnom = $statusCode;
                } else { // Unexpected error case
                    $contactForm->error_tecnom = $response->getBody();
                }

                $contactForm->save();

            } catch (GuzzleException $e) {
                dd($e->getCode(), $e->getMessage());
            }

            return response()->json(['message' => 'Form data submitted successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error creating contact form jorge: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $values = ContactForm::all();

        return view('backend.configuration.whatsapp.index', [
            'messages' => $values
        ]);
    }

    public function edit($id)
    {
        $values = ContactForm::findOrFail($id);
        return view('backend.configuration.whatsapp.edit', [
            'data' => $values,
        ]);
    }


    public function resend($id)
    {
        $whatsapp = ContactForm::findOrFail($id);
        $apiData = $this->getApiData($whatsapp);

        try {

            $response = $this->sendAPIRequest($apiData);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) { // Success case
                $result = json_decode($response->getBody()->getContents(), true);
                $whatsapp->tecnom_id = $result['id'];
                $whatsapp->status = 'crm';
            } elseif ($statusCode == 400) { // Expected error case
                $whatsapp->error_tecnom = $statusCode;
            } else { // Unexpected error case
                $whatsapp->error_tecnom = $response->getBody();
            }
            $whatsapp->save();
        } catch (GuzzleException $e) {
            $whatsapp->error_tecnom = $e->getCode();
        }
        $whatsapp->save();

        $data = ContactForm::findOrFail($id);
        return view('backend.configuration.whatsapp.edit', [
            'data' => $data
        ]);
    }

    private function getAPICredentials(): array
    {
        return [
            'username' => config('app.api_username'),
            'password' => config('app.api_password'),
        ];
    }

    private function getApiData($whatsapp): array
    {
        // Build and return the 'apiData' array...
//        dd('jorge');
//        dd($whatsapp);
//        dd($whatsapp['name']);
        $apiData = [
            'prospect' => [
                'requestdate' => date('c'),
                'customer' => [
                    'comments' => 'Contacto de whatsapp Nissan.: ' . $whatsapp['contactFormId'], // aqui la URL directo
                    'contacts' => [
                        [
                            'emails' => [
                                [
                                    'value' => $whatsapp['email']
                                ]
                            ],
                            'names' => [
                                [
                                    'part' => 'first',
                                    'value' => $whatsapp['name']
                                ],
                            ],
                            'phones' => [
                                [
                                    'type' => 'cellphone',
                                    'value' => $whatsapp['cellphone']
                                ]
                            ],
                            'addresses' => [
                                [
                                    'city' => 'Sin ciudad',
                                    'postalcode' => '591'
                                ]
                            ],
                        ],
                    ]
                ],
                'vehicles' => [
                    [
                        'make' => "Sin Auto",
                        'model' => " ",
                        'trim' => " ",
                        'year' => date('Y')
                    ]
                ],
                'provider' => [
                    'name' => [
                        'value' => 'Whatsapp'
                    ],
                    'service' => 'Cotizador Nissan' //URL
                ],
                'vendor' => [
                    'contacts' => [],
                    'vendorname' => [
                        'value' => "ajfernandez@nissan.com.bo"
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

        $response = $client->post($apiUrl, [
            'json' => $apiData,
            'auth' => [$credentials['username'], $credentials['password']],
        ]);

        return $response;
    }


    public function destroy(Request $request): JsonResponse
    {
        $ids = $request->input('ids');
        $deleted = ContactForm::destroy($ids);
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Type deleted successfully.',
                'data' => $ids
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Type not found or could not be deleted.',
                'data' => null
            ], 404);
        }

    }
}
