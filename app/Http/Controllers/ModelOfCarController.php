<?php

namespace App\Http\Controllers;

use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ModelOfCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = ModelOfCar::orderBy('name', 'ASC')->get();
        return view('backend.vehicle.model.index', [
            'values' => $values,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'ASC')->get();
        return view('backend.vehicle.model.create', [
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {

        $validatedData = $request->validate([
            'model_name' => ['required', 'string', 'max:255', 'unique:model_of_cars,name'],
            'description' => ['required'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'status_available' => ['required'],
            'mode_type' => ['required'],
            'order' => ['required'],
            'data_sheet' => ['required', 'string', 'max:255'],
        ]);

        $vehicle = new ModelOfCar();
        $vehicle->name = $validatedData['model_name'];
        $vehicle->description = $validatedData['description'];
        $vehicle->type_id = $validatedData['mode_type'];
        $vehicle->slug = Str::slug($validatedData['model_name'], '-');
        $vehicle->data_sheet = $validatedData['data_sheet'];
        $vehicle->online_reservation = $request->sale_online ? '1' : '0';
        $vehicle->order = $validatedData['order'];
        $vehicle->status = $validatedData['status_available'] ? '1' : '0';

        if ($request->hasFile('avatar')) {

            $originalImage = $request->file('avatar');
            $thumbnailImage = Image::make($originalImage);

            $thumbnailImage->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $storagePathOriginal = storage_path('public/vehicles/'.$vehicle->slug."/");
            $originalImage->save($storagePathOriginal . time() . '_' . $originalImage->getClientOriginalName());

            $storagePath = storage_path('public/vehicles/'.$vehicle->slug."/thumbnail/");
            $thumbnailImage->save($storagePath . time() . '_' . $originalImage->getClientOriginalName());
            $vehicle->image = '/storage/vehicles/'.$vehicle->slug . "/" . time() . '_' . $originalImage->getClientOriginalName();
        }

        $vehicle->save();

        return response()->json([
            'success' => true,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(ModelOfCar $modelOfCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelOfCar $modelOfCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelOfCar $modelOfCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelOfCar $modelOfCar)
    {
        //
    }
}
