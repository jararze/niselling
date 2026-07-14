<?php

namespace Tests\Feature;

use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\Frontend\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteStoreFinalValidationTest extends TestCase
{
    use RefreshDatabase;

    private ModelOfCar $model;
    private Grade $grade;
    private Grade $gradeOfOtherModel;
    private Quote $quote;

    protected function setUp(): void
    {
        parent::setUp();

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

        $otherModel = ModelOfCar::create([
            'type_id' => $type->id,
            'name' => 'Frontier',
            'slug' => 'frontier',
            'image' => 'frontier.png',
            'data_sheet' => 'frontier.pdf',
            'order' => 2,
            'status' => 1,
        ]);

        $gradeData = [
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
        ];

        $this->grade = Grade::create($gradeData + [
            'model_of_cars_id' => $this->model->id,
            'name' => 'Advance',
        ]);

        $this->gradeOfOtherModel = Grade::create($gradeData + [
            'model_of_cars_id' => $otherModel->id,
            'name' => 'Pro-4X',
        ]);

        VehicleColor::create([
            'model_of_cars_id' => $this->model->id,
            'name' => 'Blanco',
            'color_code' => '#FFFFFF',
            'image' => 'blanco.png',
            'order' => 1,
            'status' => 1,
        ]);

        $this->quote = new Quote();
        $this->quote->name = 'Juan';
        $this->quote->last_name = 'Perez';
        $this->quote->model = $this->model->id;
        $this->quote->grade = $this->grade->id;
        $this->quote->phone = 70000000;
        $this->quote->email = 'juan@example.com';
        $this->quote->city = 1;
        $this->quote->dni = 1234567;
        $this->quote->ext = 'LP';
        $this->quote->test_drive = 0;
        $this->quote->showroom = 1;
        $this->quote->save();
    }

    public function test_placeholder_text_as_grade_is_rejected_with_422(): void
    {
        // Bug de producción: selectLoader2.js inyecta un <option> sin value y
        // el texto del placeholder llega como valor de grade.
        $response = $this->postJson(route('frontend.quote.store.final'), [
            'quote_id' => $this->quote->id,
            'models' => $this->model->id,
            'grade' => 'Seleccione un modelo primero.',
            'selected_color' => '#FFFFFF',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['grade']);
        $this->assertSame($this->grade->id, (int) $this->quote->fresh()->grade);
    }

    public function test_grade_belonging_to_another_model_is_rejected_with_422(): void
    {
        $response = $this->postJson(route('frontend.quote.store.final'), [
            'quote_id' => $this->quote->id,
            'models' => $this->model->id,
            'grade' => $this->gradeOfOtherModel->id,
            'selected_color' => '#FFFFFF',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['grade']);
        $this->assertSame($this->grade->id, (int) $this->quote->fresh()->grade);
    }

    public function test_nonexistent_model_is_rejected_with_422(): void
    {
        $response = $this->postJson(route('frontend.quote.store.final'), [
            'quote_id' => $this->quote->id,
            'models' => 999999,
            'grade' => $this->grade->id,
            'selected_color' => '#FFFFFF',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['models']);
    }

    public function test_valid_update_persists_and_redirects(): void
    {
        $response = $this->post(route('frontend.quote.store.final'), [
            'quote_id' => $this->quote->id,
            'models' => $this->model->id,
            'grade' => $this->grade->id,
            'selected_color' => '#FFFFFF',
        ]);

        $response->assertRedirect(route('frontend.quote.final.proform', $this->quote->id));

        $fresh = $this->quote->fresh();
        $this->assertSame($this->grade->id, (int) $fresh->grade);
        $this->assertSame('#FFFFFF', $fresh->color);
    }
}
