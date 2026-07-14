<?php

namespace Tests\Feature;

use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VehicleColorIndexTest extends TestCase
{
    use RefreshDatabase;

    private function createModelWithColor(string $modelName, string $slug, string $colorName, string $colorCode, int $order): ModelOfCar
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

        VehicleColor::create([
            'model_of_cars_id' => $model->id,
            'name' => $colorName,
            'color_code' => $colorCode,
            'image' => $slug.'-color.png',
            'order' => 1,
            'status' => 1,
        ]);

        return $model;
    }

    public function test_color_index_renders_when_a_color_belongs_to_a_soft_deleted_model(): void
    {
        $this->createModelWithColor('Kicks', 'kicks', 'Blanco Sano', '#FFFFFF', 1);

        // Estado legado (pre-fix), igual al de producción: el modelo fue
        // soft-borrado sin cascada y su color quedó activo apuntando a él.
        $orphanParent = $this->createModelWithColor('Path 2', 'path-2', 'Plata Huerfano', '#C0C0C0', 2);
        DB::table('model_of_cars')->where('id', $orphanParent->id)->update(['deleted_at' => now()]);

        $response = $this->actingAs(User::factory()->create())
            ->get(route('backend.vehicle.color.index'));

        $response->assertOk();
        $response->assertSee('Blanco Sano');
        $response->assertDontSee('Plata Huerfano');
    }
}
