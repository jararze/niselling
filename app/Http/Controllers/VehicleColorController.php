<?php

namespace App\Http\Controllers;

use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\VehicleColor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class VehicleColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = VehicleColor::orderBy('name', 'ASC')->get();
        return view('backend.vehicle.color.index', [
            'values' => $values,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = ModelOfCar::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('backend.vehicle.color.create', [
            'models' => $model,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:vehicle_colors,name'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'status_available' => ['required'],
            'mode_type' => ['required'],
            'order' => ['required'],
            'color_code' => ['required', 'string', 'max:255'],
        ]);

        $color = new VehicleColor();
        $color->name = $validatedData['name'];
        $color->model_of_cars_id = $validatedData['mode_type'];
        $color->color_code = $validatedData['color_code'];
        $color->order = $validatedData['order'];
        $color->status = $validatedData['status_available'] ? '1' : '0';

        $modelCar = ModelOfCar::find($validatedData['mode_type']);
        $modelCarSlug = $modelCar->slug;

        if ($request->hasFile('avatar')) {
            $originalImage = $request->file('avatar');
            $filename = time() . '_' . $originalImage->getClientOriginalName();

            // Define the paths
            $originalPath = 'public/vehicles/' . $modelCarSlug . '/';
            $thumbnailPath = 'public/vehicles/' . $modelCarSlug . '/thumbnail/';

            // Ensure the directories exist
            Storage::makeDirectory($originalPath);
            Storage::makeDirectory($thumbnailPath);

            // Create the image with Intervention Image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($originalImage);

            // Save the original image
            Storage::put($originalPath . $filename, (string)$image->encode());

            // Create and save the thumbnail image
            $thumbnailImage = $manager->read($originalImage);
            $thumbnailImage->scale(width: 300);

            Storage::put($thumbnailPath . $filename, (string)$thumbnailImage->encode());

            $color->image = $filename;

        }

        $color->save();

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleColor $vehicleColor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $color = VehicleColor::findOrFail($id);
        $model = ModelOfCar::where('status', 1)->orderBy('name', 'ASC')->get();

        return view('backend.vehicle.color.edit', [
            'data' => $color,
            'models' => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'status_available' => ['required'],
            'mode_type' => ['required'],
            'order' => ['required'],
            'color_code' => ['required', 'string', 'max:255'],
        ]);

        $color = VehicleColor::find($request->id);
        $oldModelCar = ModelOfCar::find($color->model_of_cars_id);

        $color->name = $validatedData['name'];
        $color->model_of_cars_id = $validatedData['mode_type'];
        $color->color_code = $validatedData['color_code'];
        $color->order = $validatedData['order'];
        $color->status = $validatedData['status_available'] ? '1' : '0';

        $modelCar = ModelOfCar::find($validatedData['mode_type']);

        if ($request->hasFile('avatar')) {

            Storage::deleteDirectory('public/vehicles/color/' . $oldModelCar->slug);


            $originalImage = $request->file('avatar');
            $filename = time() . '_' . $originalImage->getClientOriginalName();

            // Define the paths
            $originalPath = 'public/vehicles/color/' . $modelCar->slug . '/';
            $thumbnailPath = 'public/vehicles/color/' . $modelCar->slug . '/thumbnail/';

            // Ensure the directories exist
            Storage::makeDirectory($originalPath);
            Storage::makeDirectory($thumbnailPath);

            // Create the image with Intervention Image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($originalImage);

            // Save the original image
            Storage::put($originalPath . $filename, (string)$image->encode());

            // Create and save the thumbnail image
            $thumbnailImage = $manager->read($originalImage);
            $thumbnailImage->scale(width: 300);

            Storage::put($thumbnailPath . $filename, (string)$thumbnailImage->encode());

            $color->image = $filename;

        }

        $color->save();

        return response()->json([
            'message' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        json_decode($request->getContent(), true);
        $ids = $request->ids;

        $deleted = VehicleColor::destroy($ids);

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
