<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Quote;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactFormController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $formData = $request->only(['name', 'email', 'cellphone', 'pageUrl']);

            ContactForm::create($formData);

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
    private function getApiData(ContactForm $whatsapp): array
    {
        // Build and return the 'apiData' array...
        $apiData = [
            'prospect' => [
                'requestdate' => date('c'),
                'customer' => [
                    'comments' => 'Contacto de whatsapp Nissan.: ' . $whatsapp->id,
                    'contacts' => [
                        [
                            'emails' => [
                                [
                                    'value' => $whatsapp->email
                                ]
                            ],
                            'names' => [
                                [
                                    'part' => 'first',
                                    'value' => $whatsapp->name
                                ],
                            ],
                            'phones' => [
                                [
                                    'type' => 'cellphone',
                                    'value' => $whatsapp->cellphone
                                ]
                            ],
                            'addresses' => [
                                [
                                    'city' => 'CIudad',
                                    'postalcode' => '591'
                                ]
                            ],
                        ],
                    ]
                ],
                'vehicles' => [
                    [
                        'make' => "whatsapp",
                        'model' => "whatsapp",
                        'trim' => "whatsapp",
                        'year' => "whatsapp"
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
                        'value' => "whatsapp"
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
