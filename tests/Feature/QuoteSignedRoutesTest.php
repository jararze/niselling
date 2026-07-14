<?php

namespace Tests\Feature;

use App\Models\backend\Configuration\Agent;
use App\Models\backend\Configuration\City;
use App\Models\backend\Configuration\Showroom;
use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class QuoteSignedRoutesTest extends TestCase
{
    use RefreshDatabase;

    private ModelOfCar $model;
    private Grade $grade;
    private City $city;
    private Showroom $showroom;
    private Agent $agent;

    protected function setUp(): void
    {
        parent::setUp();

        // El layout frontend usa @vite y en testing no hay assets compilados.
        $this->withoutVite();

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

        VehicleColor::create([
            'model_of_cars_id' => $this->model->id,
            'name' => 'Negro',
            'color_code' => '#000000',
            'image' => 'negro.png',
            'order' => 2,
            'status' => 1,
        ]);

        $this->city = City::create(['name' => 'La Paz', 'status' => 1]);

        $this->showroom = Showroom::create([
            'city_id' => $this->city->id,
            'name' => 'Showroom Central',
            'status' => 1,
        ]);

        $this->agent = Agent::create([
            'showroom_id' => $this->showroom->id,
            'name' => 'Ana Vendedora',
            'email' => 'ana@example.com',
            'phone' => 70000001,
            'status' => 1,
        ]);
    }

    private function createQuote(string $email = 'juan@example.com'): Quote
    {
        $quote = new Quote();
        $quote->name = 'Juan';
        $quote->last_name = 'Perez';
        $quote->model = $this->model->id;
        $quote->grade = $this->grade->id;
        $quote->phone = 70000000;
        $quote->email = $email;
        $quote->city = $this->city->id;
        $quote->dni = 1234567;
        $quote->ext = 'LP';
        $quote->test_drive = 0;
        $quote->showroom = $this->showroom->id;
        $quote->color = '#FFFFFF';
        $quote->agent_id = $this->agent->id;
        $quote->save();

        return $quote;
    }

    private function makeOutboundHttpFail(): void
    {
        $mock = new MockHandler([
            new RequestException('Facebook caído', new GuzzleRequest('POST', 'https://graph.facebook.com')),
            new RequestException('Tecnom caído', new GuzzleRequest('POST', 'https://tecnom.example')),
        ]);

        $this->app->bind(Client::class, fn () => new Client(['handler' => HandlerStack::create($mock)]));
    }

    private function signedGetRoutes(Quote $quote): array
    {
        return [
            'frontend.quote_second.show' => route('frontend.quote_second.show', $quote->id),
            'frontend.quote.final.proform' => route('frontend.quote.final.proform', $quote->id),
            'frontend.quote.pdf' => route('frontend.quote.pdf', $quote->id),
            'frontend.online.reservation' => route('frontend.online.reservation', $quote->id),
            'frontend.thanks' => route('frontend.thanks', $quote->id),
        ];
    }

    public function test_get_routes_without_signature_return_403(): void
    {
        $quote = $this->createQuote();

        foreach ($this->signedGetRoutes($quote) as $name => $url) {
            $this->get($url)->assertForbidden();
        }
    }

    public function test_get_routes_with_valid_signature_return_200(): void
    {
        $quote = $this->createQuote();

        foreach (array_keys($this->signedGetRoutes($quote)) as $name) {
            $url = URL::temporarySignedRoute($name, now()->addHours(72), $quote->id);
            $this->get($url)->assertOk();
        }
    }

    public function test_signature_of_one_quote_does_not_open_another_quote(): void
    {
        $victim = $this->createQuote('victima@example.com');
        $attacker = $this->createQuote('atacante@example.com');

        // El atacante tiene una firma legítima para SU quote e intenta
        // reusarla cambiando el id del path: corazón del IDOR.
        $ownSigned = URL::temporarySignedRoute('frontend.quote_second.show', now()->addHours(72), $attacker->id);
        $tampered = str_replace("/quote/{$attacker->id}/", "/quote/{$victim->id}/", $ownSigned);

        $this->assertNotSame($ownSigned, $tampered);
        $this->get($tampered)->assertForbidden();
    }

    public function test_expired_signature_returns_403(): void
    {
        $quote = $this->createQuote();
        $url = URL::temporarySignedRoute('frontend.quote_second.show', now()->addHours(72), $quote->id);

        $this->travel(73)->hours();

        $this->get($url)->assertForbidden();
    }

    public function test_mutation_posts_without_signature_return_403(): void
    {
        $quote = $this->createQuote();

        $this->post(route('frontend.quote.store.final'), [
            'quote_id' => $quote->id,
            'models' => $this->model->id,
            'grade' => $this->grade->id,
            'selected_color' => '#FFFFFF',
        ])->assertForbidden();

        $this->post(route('frontend.bank.transfer'), ['id' => $quote->id, 'payment' => 1])
            ->assertForbidden();

        $this->post(route('frontend.quote.store.voucher'), ['id' => $quote->id])
            ->assertForbidden();

        $this->post(route('frontend.contact.whatsapp', $quote->id))
            ->assertForbidden();
    }

    public function test_signed_store_final_cannot_mutate_a_foreign_quote_via_body(): void
    {
        $victim = $this->createQuote('victima@example.com');
        $attacker = $this->createQuote('atacante@example.com');

        // Action firmada legítima del atacante (id firmado en el query);
        // intenta pisar la quote de la víctima metiendo su id en el body.
        $signedAction = URL::temporarySignedRoute(
            'frontend.quote.store.final',
            now()->addHours(72),
            ['quote_id' => $attacker->id]
        );

        $this->post($signedAction, [
            'quote_id' => $victim->id,
            'models' => $this->model->id,
            'grade' => $this->grade->id,
            'selected_color' => '#000000',
        ]);

        // La víctima conserva su color; solo la quote firmada puede cambiar.
        $this->assertSame('#FFFFFF', $victim->fresh()->color);
        $this->assertSame('#000000', $attacker->fresh()->color);
    }

    public function test_signed_whatsapp_post_updates_contact_type(): void
    {
        $quote = $this->createQuote();

        $url = URL::temporarySignedRoute('frontend.contact.whatsapp', now()->addHours(72), $quote->id);

        $this->post($url)->assertOk();
        $this->assertSame('whatsapp', $quote->fresh()->type_contact);
    }

    public function test_signed_bank_transfer_and_voucher_flow(): void
    {
        Storage::fake();
        $quote = $this->createQuote();

        $bankUrl = URL::temporarySignedRoute(
            'frontend.bank.transfer',
            now()->addHours(72),
            ['id' => $quote->id]
        );
        $this->post($bankUrl, ['payment' => 1])->assertOk();
        $this->assertSame('transferencia_bancaria', $quote->fresh()->way_to_pay);

        $voucherUrl = URL::temporarySignedRoute(
            'frontend.quote.store.voucher',
            now()->addHours(72),
            ['id' => $quote->id]
        );
        $this->post($voucherUrl, [
            'comprobante' => UploadedFile::fake()->create('comprobante.pdf', 100, 'application/pdf'),
        ])->assertOk();
        $this->assertNotNull($quote->fresh()->way_to_pay_image);
    }

    public function test_full_happy_path_with_signed_redirects(): void
    {
        $this->makeOutboundHttpFail();

        // 1. El cliente crea la cotización.
        $storeResponse = $this->post(route('frontend.quote.save'), [
            'name' => 'Juan',
            'last-name' => 'Perez',
            'models' => $this->model->id,
            'grade' => $this->grade->id,
            'phone' => 70000000,
            'city' => $this->city->id,
            'dni' => 1234567,
            'ext' => 'LP',
            'showroom' => $this->showroom->id,
            'email' => 'flujo@example.com',
        ]);

        $storeResponse->assertStatus(302);
        $showUrl = $storeResponse->headers->get('Location');
        $quote = Quote::where('email', 'flujo@example.com')->firstOrFail();
        $this->assertStringContainsString("/quote/{$quote->id}/second-part/show", $showUrl);
        $this->assertStringContainsString('signature=', $showUrl);

        // 2. Sigue el redirect firmado a la segunda parte.
        $this->get($showUrl)->assertOk();

        // 3. Confirma versión y color (action firmada del form).
        $finalResponse = $this->post(URL::temporarySignedRoute(
            'frontend.quote.store.final',
            now()->addHours(72),
            ['quote_id' => $quote->id]
        ), [
            'models' => $this->model->id,
            'grade' => $this->grade->id,
            'selected_color' => '#FFFFFF',
        ]);

        $finalResponse->assertStatus(302);
        $proformUrl = $finalResponse->headers->get('Location');
        $this->assertStringContainsString("/quote/{$quote->id}/quote/final/proform", $proformUrl);
        $this->assertStringContainsString('signature=', $proformUrl);

        // 4. Llega a la proforma y descarga el PDF firmado.
        $this->get($proformUrl)->assertOk();
        $this->get(URL::temporarySignedRoute('frontend.quote.pdf', now()->addHours(72), $quote->id))
            ->assertOk();
    }

    public function test_dead_routes_are_removed(): void
    {
        $this->assertFalse(app('router')->has('frontend.quote_second.update'));
        $this->assertFalse(app('router')->has('backend.quote.update'));
        $this->assertFalse(app('router')->has('frontend.thanks.voucher'));
    }
}
