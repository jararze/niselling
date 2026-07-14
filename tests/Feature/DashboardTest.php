<?php

namespace Tests\Feature;

use App\Models\backend\Configuration\Agent;
use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private function seedBaseData(): ModelOfCar
    {
        $type = Type::create(['name' => 'SUV', 'available' => 1]);

        $model = ModelOfCar::create([
            'type_id' => $type->id,
            'name' => 'Kicks',
            'slug' => 'kicks',
            'image' => 'kicks.png',
            'data_sheet' => 'kicks.pdf',
            'order' => 1,
            'status' => 1,
        ]);

        Grade::create([
            'model_of_cars_id' => $model->id,
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
            'model_of_cars_id' => $model->id,
            'name' => 'Blanco',
            'color_code' => '#FFFFFF',
            'image' => 'blanco.png',
            'order' => 1,
            'status' => 1,
        ]);

        // El blade del dashboard exige que existan las cuatro claves de
        // type_contact (whatsapp/online/phone/null) en los porcentajes.
        foreach (['whatsapp', 'online', 'phone', null] as $typeContact) {
            $quote = new Quote();
            $quote->name = 'Juan';
            $quote->last_name = 'Perez';
            $quote->model = $model->id;
            $quote->grade = Grade::first()->id;
            $quote->phone = 70000000;
            $quote->email = 'juan@example.com';
            $quote->city = 1;
            $quote->dni = 1234567;
            $quote->ext = 'LP';
            $quote->test_drive = 0;
            $quote->showroom = 1;
            $quote->type_contact = $typeContact;
            $quote->save();
        }

        return $model;
    }

    public function test_dashboard_renders_when_a_color_belongs_to_a_soft_deleted_model(): void
    {
        $this->seedBaseData();

        // Estado legado (pre-fix), igual al de producción: el modelo fue
        // soft-borrado sin cascada y su color quedó activo apuntando a él.
        $orphanParent = ModelOfCar::create([
            'type_id' => Type::first()->id,
            'name' => 'Path 2',
            'slug' => 'path-2',
            'image' => 'path2.png',
            'data_sheet' => 'path2.pdf',
            'order' => 2,
            'status' => 1,
        ]);

        VehicleColor::create([
            'model_of_cars_id' => $orphanParent->id,
            'name' => 'Plata Huerfano',
            'color_code' => '#C0C0C0',
            'image' => 'plata.png',
            'order' => 1,
            'status' => 1,
        ]);

        DB::table('model_of_cars')->where('id', $orphanParent->id)->update(['deleted_at' => now()]);

        $response = $this->actingAs(User::factory()->create())->get('/dashboard');

        $response->assertOk();
        $response->assertDontSee('Plata Huerfano');
    }

    public function test_dashboard_renders_with_healthy_data(): void
    {
        $this->seedBaseData();

        $response = $this->actingAs(User::factory()->create())->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Kicks');
    }
}
