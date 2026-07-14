<?php

namespace Tests\Feature;

use App\Http\Controllers\Frontend\QuoteController;
use App\Models\backend\Configuration\Agent;
use App\Models\backend\Configuration\City;
use App\Models\backend\Configuration\Showroom;
use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class QuoteStoreTest extends TestCase
{
    use RefreshDatabase;

    private ModelOfCar $model;
    private Grade $grade;
    private Showroom $showroom;
    private City $city;

    private function seedCatalog(bool $withAgent = true): void
    {
        $type = Type::create(['name' => 'SUV', 'available' => 1]);

        $this->model = ModelOfCar::create([
            'type_id' => $type->id,
            'name' => 'Kicks',
            'slug' => 'kicks',
            'image' => 'kicks.png',
            'data_sheet' => 'kicks.pdf',
            'order' => 1,
            'status' => 1,
        ]);

        $this->grade = Grade::create([
            'model_of_cars_id' => $this->model->id,
            'name' => 'Advance',
            'engine' => '1.6',
            'cylindered' => '1.6L',
            'transmission' => 'CVT',
            'traction' => '4x2',
            'commercial_date' => 2026,
            'origin' => 'JP',
            'factory' => 'Nissan',
            'delivery' => 'Inmediata',
            'price' => 30000,
            'discount' => 0,
            'order' => 1,
            'status' => 1,
        ]);

        VehicleColor::create([
            'model_of_cars_id' => $this->model->id,
            'name' => 'Blanco',
            'color_code' => '#FFFFFF',
            'image' => 'blanco.png',
            'order' => 1,
            'status' => 1,
        ]);

        $this->city = City::create(['name' => 'La Paz', 'status' => 1]);

        $this->showroom = Showroom::create([
            'city_id' => $this->city->id,
            'name' => 'Showroom Central',
            'status' => 1,
        ]);

        if ($withAgent) {
            Agent::create([
                'showroom_id' => $this->showroom->id,
                'name' => 'Ana Vendedora',
                'email' => 'ana@example.com',
                'phone' => 70000001,
                'status' => 1,
            ]);
        }
    }

    /**
     * Toda llamada HTTP saliente (Facebook y Tecnom) falla: el flujo
     * público debe guardar la cotización de todas formas.
     */
    private function makeOutboundHttpFail(): void
    {
        $mock = new MockHandler([
            new RequestException('Facebook caído', new GuzzleRequest('POST', 'https://graph.facebook.com')),
            new RequestException('Tecnom caído', new GuzzleRequest('POST', 'https://tecnom.example')),
        ]);

        $this->app->bind(Client::class, fn () => new Client(['handler' => HandlerStack::create($mock)]));
    }

    private function validPayload(): array
    {
        return [
            'name' => 'Juan',
            'last-name' => 'Perez',
            'models' => $this->model->id,
            'grade' => $this->grade->id,
            'phone' => 70000000,
            'city' => $this->city->id,
            'dni' => 1234567,
            'ext' => 'LP',
            'showroom' => $this->showroom->id,
            'email' => 'juan@example.com',
        ];
    }

    public function test_quote_is_saved_when_facebook_request_fails(): void
    {
        $this->seedCatalog();
        $this->makeOutboundHttpFail();

        $response = $this->post(route('frontend.quote.save'), $this->validPayload());

        $this->assertDatabaseHas('quotes', ['email' => 'juan@example.com']);
        $response->assertRedirectContains(route('frontend.quote_second.show', Quote::firstOrFail()->id));
        $response->assertRedirectContains('signature=');
    }

    public function test_quote_is_saved_when_the_referenced_model_was_soft_deleted(): void
    {
        $this->seedCatalog();
        $this->makeOutboundHttpFail();

        // Estado de producción: el modelo se soft-borró entre que el cliente
        // cargó el formulario y lo envió; sus relaciones vuelven null.
        DB::table('model_of_cars')->where('id', $this->model->id)->update(['deleted_at' => now()]);

        $response = $this->post(route('frontend.quote.save'), $this->validPayload());

        $this->assertDatabaseHas('quotes', ['email' => 'juan@example.com']);
        $response->assertRedirectContains(route('frontend.quote_second.show', Quote::firstOrFail()->id));
    }

    public function test_quote_is_saved_without_agent_when_showroom_has_no_active_agents(): void
    {
        $this->seedCatalog(withAgent: false);
        $this->makeOutboundHttpFail();
        Log::spy();

        $response = $this->post(route('frontend.quote.save'), $this->validPayload());

        $this->assertDatabaseHas('quotes', ['email' => 'juan@example.com', 'agent_id' => null]);
        $response->assertRedirectContains(route('frontend.quote_second.show', Quote::firstOrFail()->id));
        Log::shouldHaveReceived('warning');
    }

    public function test_facebook_event_hashes_the_real_last_name(): void
    {
        $this->seedCatalog();

        $quote = new Quote();
        $quote->name = 'Juan';
        $quote->last_name = 'Perez';
        $quote->model = $this->model->id;
        $quote->grade = $this->grade->id;
        $quote->phone = 70000000;
        $quote->email = 'juan@example.com';
        $quote->city = $this->city->id;
        $quote->dni = 1234567;
        $quote->ext = 'LP';
        $quote->test_drive = 0;
        $quote->showroom = $this->showroom->id;
        $quote->save();

        $event = (new QuoteController())->getApiDataFacebook($quote);

        $this->assertSame(hash('sha256', 'Perez'), $event['user_data']['ln']);
        $this->assertSame('Kicks', $event['custom_data']['vehicle_model']);
        $this->assertSame('Advance', $event['custom_data']['vehicle_grade']);
    }

    public function test_facebook_event_builds_even_when_relations_are_orphaned(): void
    {
        $this->seedCatalog();

        $quote = new Quote();
        $quote->name = 'Juan';
        $quote->last_name = 'Perez';
        $quote->model = 999999; // modelo inexistente/soft-borrado
        $quote->grade = 999999;
        $quote->phone = 70000000;
        $quote->email = 'juan@example.com';
        $quote->city = $this->city->id;
        $quote->dni = 1234567;
        $quote->ext = 'LP';
        $quote->test_drive = 0;
        $quote->showroom = $this->showroom->id;
        $quote->save();

        $event = (new QuoteController())->getApiDataFacebook($quote);

        $this->assertSame('', $event['custom_data']['vehicle_model']);
        $this->assertSame('', $event['custom_data']['vehicle_grade']);
    }
}
