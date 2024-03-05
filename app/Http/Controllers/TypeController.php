<?php

namespace App\Http\Controllers;

use App\Models\backend\vehicle\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = Type::orderBy('name', 'ASC')->get();
        return view('backend.vehicle.type.index', [
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
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:types,name'],
//            'available' => 'sometimes',
        ]);

        $type = new Type();
        $type->name = $validatedData['name'];
        $type->available = $request->available ? '1' : '0';

        $type->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Type created successfully.',
            'data' => $type
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $values = Type::findOrFail($id);

        return view('backend.vehicle.type.view', [
            'data' => $values,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        \Log::info($request->all());

        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('types')->ignore($request->id), // Exclude the current record from the unique check
            ],
            'status' => 'required|boolean', // Assuming 'status' is a boolean field
        ]);
        $type = Type::findOrFail($request->id);
        $type->fill([
            'name' => $validatedData['name'],
            'available' => $validatedData['status'], // Use a more descriptive name if possible
        ]);

        if($type->save()){
            return response()->json([
                'success' => true,
                'form' => $type->id
            ]);
        }else{
            return response()->json([
                'success' => false,
                'form' => $type->id
            ]);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $ids = $request->input('ids');
        $deleted = Type::destroy($ids);

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
