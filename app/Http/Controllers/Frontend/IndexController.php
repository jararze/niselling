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
    public function index()
    {
        $models = ModelOfCar::where('status', 1)->orderBy('order', 'ASC')->get();
        $cities = City::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('index', [
            'models' => $models,
            'cities' => $cities,
        ]);
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
            ->pluck("name", "id");
        return response()->json($showrooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
