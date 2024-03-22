<?php

namespace App\Http\Controllers;

use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = Grade::orderBy('name', 'ASC')->get();
        return view('backend.vehicle.grade.index', [
            'values' => $values,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = ModelOfCar::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('backend.vehicle.grade.create', [
            'models' => $model,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'model_name' => ['required', 'string', 'max:255', 'unique:grades,name'],
            'engine' => ['required', 'string', 'max:255'],
            'cylindered' => ['required', 'string', 'max:255'],
            'transmission' => ['required', 'string', 'max:255'],
            'traction' => ['required', 'string', 'max:255'],
            'commercial_date' => ['required'],
            'origin' => ['required', 'string', 'max:255'],
            'factory' => ['required', 'string', 'max:255'],
            'delivery' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'discount' => ['required'],
            'order' => ['required'],
            'status_available' => ['required'],
            'model' => ['required'],
        ]);
        try {
            $grade = new Grade();
            $grade->name = $validatedData['model_name'];
            $grade->engine = $validatedData['engine'];
            $grade->cylindered = $validatedData['cylindered'];
            $grade->transmission = $validatedData['transmission'];
            $grade->traction = $validatedData['traction'];
            $grade->commercial_date = $validatedData['commercial_date'];
            $grade->origin = $validatedData['origin'];
            $grade->factory = $validatedData['factory'];
            $grade->delivery = $validatedData['delivery'];
            $grade->price = $validatedData['price'];
            $grade->discount = $validatedData['discount'];
            $grade->order = $validatedData['order'];
            $grade->model_of_cars_id = $validatedData['model'];
            $grade->status = $validatedData['status_available'] ? '1' : '0';


            $grade->save();

            return response()->json([
                'message' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error occurred while saving Grade: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $model = ModelOfCar::where('status', 1)->orderBy('name', 'ASC')->get();

        return view('backend.vehicle.grade.edit', [
            'grade' => $grade,
            'models' => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'model_name' => ['required', 'string', 'max:255'],
            'engine' => ['required', 'string', 'max:255'],
            'cylindered' => ['required', 'string', 'max:255'],
            'transmission' => ['required', 'string', 'max:255'],
            'traction' => ['required', 'string', 'max:255'],
            'commercial_date' => ['required'],
            'origin' => ['required', 'string', 'max:255'],
            'factory' => ['required', 'string', 'max:255'],
            'delivery' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'discount' => ['required'],
            'order' => ['required'],
            'status_available' => ['required'],
            'model' => ['required'],
        ]);

        try {

            $grade = Grade::findOrFail($request->id);
            $grade->name = $validatedData['model_name'];
            $grade->engine = $validatedData['engine'];
            $grade->cylindered = $validatedData['cylindered'];
            $grade->transmission = $validatedData['transmission'];
            $grade->traction = $validatedData['traction'];
            $grade->commercial_date = $validatedData['commercial_date'];
            $grade->origin = $validatedData['origin'];
            $grade->factory = $validatedData['factory'];
            $grade->delivery = $validatedData['delivery'];
            $grade->price = $validatedData['price'];
            $grade->discount = $validatedData['discount'];
            $grade->order = $validatedData['order'];
            $grade->model_of_cars_id = $validatedData['model'];
            $grade->status = $validatedData['status_available'] ? '1' : '0';


            $grade->save();

            return response()->json([
                'message' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error occurred while saving Grade: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        json_decode($request->getContent(), true);
        $ids = $request->ids;

        $deleted = Grade::destroy($ids);

        if ($deleted) {
            return response()->json([
                'status' => true,
                'variable3' => $ids
            ]);
        } else {
            return response()->json([
                'status' => false,
                'data' => null
            ], 404);
        }
    }
}
