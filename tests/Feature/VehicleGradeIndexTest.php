<?php

namespace Tests\Feature;

use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VehicleGradeIndexTest extends TestCase
{
    use RefreshDatabase;

    private function createModelWithGrade(string $modelName, string $slug, string $gradeName, int $order): ModelOfCar
    {
        $type = Type::firstOrCreate(['name' => 'SUV'], ['available' => 1]);

        $model = ModelOfCar::create([
            'type_id' => $type->id,
            'name' => $modelName,
            'slug' => $slug,
            'image' => $slug.'.png',
            'data_sheet' => $slug.'.pdf',
            'order' => $order,
            'status' => 1,
        ]);

        Grade::create([
            'model_of_cars_id' => $model->id,
            'name' => $gradeName,
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

        return $model;
    }

    public function test_grade_index_renders_when_a_grade_belongs_to_a_soft_deleted_model(): void
    {
        $this->createModelWithGrade('Kicks', 'kicks', 'Advance Sano', 1);

        // Estado legado (pre-fix), igual al de producción: el modelo fue
        // soft-borrado sin cascada y su versión quedó activa apuntando a él.
        $orphanParent = $this->createModelWithGrade('Path 2', 'path-2', 'Grado Huerfano', 2);
        DB::table('model_of_cars')->where('id', $orphanParent->id)->update(['deleted_at' => now()]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('backend.vehicle.grade.index'));

        $response->assertOk();
        $response->assertSee('Advance Sano');
        $response->assertDontSee('Grado Huerfano');
    }
}
