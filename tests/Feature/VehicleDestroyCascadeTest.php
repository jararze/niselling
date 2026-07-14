<?php

namespace Tests\Feature;

use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleDestroyCascadeTest extends TestCase
{
    use RefreshDatabase;

    private Type $type;
    private ModelOfCar $model;
    private Grade $grade;
    private VehicleColor $color;

    protected function setUp(): void
    {
        parent::setUp();

        $this->type = Type::create(['name' => 'SUV', 'available' => 1]);

        $this->model = ModelOfCar::create([
            'type_id' => $this->type->id,
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

        $this->color = VehicleColor::create([
            'model_of_cars_id' => $this->model->id,
            'name' => 'Blanco',
            'color_code' => '#FFFFFF',
            'image' => 'blanco.png',
            'order' => 1,
            'status' => 1,
        ]);
    }

    private function createQuoteForModel(ModelOfCar $model): Quote
    {
        $quote = new Quote();
        $quote->name = 'Juan';
        $quote->last_name = 'Perez';
        $quote->model = $model->id;
        $quote->grade = $this->grade->id;
        $quote->phone = 70000000;
        $quote->email = 'juan@example.com';
        $quote->city = 1;
        $quote->dni = 1234567;
        $quote->ext = 'LP';
        $quote->test_drive = 0;
        $quote->showroom = 1;
        $quote->save();

        return $quote;
    }

    private function admin(): User
    {
        return User::factory()->create();
    }

    public function test_destroying_a_model_with_quotes_is_blocked(): void
    {
        $this->createQuoteForModel($this->model);

        $response = $this->actingAs($this->admin())->postJson(
            route('backend.vehicle.model.delete'),
            ['ids' => [$this->model->id]]
        );

        $response->assertStatus(422);
        $this->assertNull($this->model->fresh()->deleted_at);
        $this->assertNull($this->color->fresh()->deleted_at);
    }

    public function test_destroying_a_model_without_quotes_soft_deletes_colors_and_grades(): void
    {
        $response = $this->actingAs($this->admin())->postJson(
            route('backend.vehicle.model.delete'),
            ['ids' => [$this->model->id]]
        );

        $response->assertOk();
        $this->assertSoftDeleted('model_of_cars', ['id' => $this->model->id]);
        $this->assertSoftDeleted('vehicle_colors', ['id' => $this->color->id]);
        $this->assertSoftDeleted('grades', ['id' => $this->grade->id]);
    }

    public function test_destroying_a_type_with_quotes_is_blocked(): void
    {
        $this->createQuoteForModel($this->model);

        $response = $this->actingAs($this->admin())->postJson(
            route('backend.vehicle.type.delete', $this->type->id),
            ['ids' => [$this->type->id]]
        );

        $response->assertStatus(422);
        $this->assertDatabaseHas('types', ['id' => $this->type->id]);
        $this->assertNull($this->model->fresh()->deleted_at);
    }

    public function test_destroying_a_type_without_quotes_cascades_soft_delete(): void
    {
        $response = $this->actingAs($this->admin())->postJson(
            route('backend.vehicle.type.delete', $this->type->id),
            ['ids' => [$this->type->id]]
        );

        $response->assertOk();
        $this->assertSoftDeleted('types', ['id' => $this->type->id]);
        $this->assertSoftDeleted('model_of_cars', ['id' => $this->model->id]);
        $this->assertSoftDeleted('vehicle_colors', ['id' => $this->color->id]);
        $this->assertSoftDeleted('grades', ['id' => $this->grade->id]);
    }
}
