<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\Configuration\City;
use App\Models\backend\Configuration\Showroom;
use App\Models\backend\vehicle\Grade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\backend\vehicle\ModelOfCar;
use Illuminate\Database\Eloquent\SoftDeletes;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
        if(empty($id)) {
            $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
            $cities = City::where('status', 1)
                ->has('showrooms')
                ->orderBy('name', 'ASC')
                ->get();
            return view('index', [
                'cities' => $cities,
                'models' => $models,
            ]);
        } else{
            $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
            $grades = Grade::where('model_of_cars_id' , $id)->orderBy('order', 'ASC')->get();
            $cities = City::where('status', 1)
                ->has('showrooms')
                ->orderBy('name', 'ASC')
                ->get();
            return view('index', [
                'models' => $models,
                'cities' => $cities,
                'grades' => $grades,
                'id' => $id,
            ]);
        }

    }

    public function getGrades($id):JsonResponse
    {
        $grades = Grade::where("model_of_cars_id", $id)
            ->pluck("name", "id");
        return response()->json($grades);
    }

    public function getShowrooms($id):JsonResponse
    {
        $showrooms = Showroom::where("city_id", $id)
            ->has('agents')
            ->pluck("name", "id");

        return response()->json($showrooms);
    }

}
