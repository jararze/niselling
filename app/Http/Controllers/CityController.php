<?php

namespace App\Http\Controllers;

use App\Models\backend\Configuration\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = City::orderBy('name', 'ASC')->get();
        return view('backend.configuration.city.index', [
            'values' => $values,
        ]);
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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:types,name'],
//            'available' => 'sometimes',
        ]);

        $city = new City();
        $city->name = $validatedData['name'];
        $city->status = $request->available ? '1' : '0';

        $city->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Type created successfully.',
            'data' => $city
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $values = City::findOrFail($id);

        return view('backend.configuration.city.view', [
            'data' => $values,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('cities')->ignore($request->id),],
            'status' => 'required|boolean',
        ]);
        $type = City::findOrFail($request->id);
        $type->fill([
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
        ]);

        $isSaved = $type->save();

        return response()->json([
            'success' => $isSaved,
            'form' => $type->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $ids = $request->input('ids');
        $deleted = City::destroy($ids);

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Type deleted successfully.',
                'data' => $ids // This will be the ID passed in the URL
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Type not found or could not be deleted.',
                'data' => null
            ], 404);
        }

    }
}
