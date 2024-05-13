<?php

namespace App\Http\Controllers;

use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\Type;
use App\Models\backend\vehicle\VehicleColor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        $types = Type::where('available', 1)->orderBy('name', 'ASC')->get();
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
            'color_name' => ['required'],
            'color_code' => ['required'],
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
            $filename = time() . '_' . $originalImage->getClientOriginalName();

            $originalPath = 'public/vehicles/' . $vehicle->slug . '/';
            $thumbnailPath = 'public/vehicles/' . $vehicle->slug . '/thumbnail/';

            Storage::makeDirectory($originalPath);
            chmod(storage_path('app/' . $originalPath), 0775);
            Storage::makeDirectory($thumbnailPath);
            chmod(storage_path('app/' . $thumbnailPath), 0775);

            $manager = new ImageManager(new Driver());
            $image = $manager->read($originalImage);

            Storage::put($originalPath . $filename, (string) $image->encode());

            $thumbnailImage = $manager->read($originalImage);
            $thumbnailImage->scale(width: 300);

            Storage::put($thumbnailPath . $filename, (string) $thumbnailImage->encode());

            $vehicle->image = $filename;

        }


        if ($vehicle->save()){

            $maxOrder = VehicleColor::where('model_of_cars_id', $vehicle->id)
                ->max('order');

            $color = new VehicleColor();
            $color->name = $validatedData['color_name'];
            $color->model_of_cars_id = $vehicle->id;
            $color->color_code = $validatedData['color_code'];
            $color->order = $maxOrder + 1;
            $color->status = $validatedData['status_available'] ? '1' : '0';
            $color->image = $filename;

            $color->save();

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
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
    public function edit($id)
    {
        $vehicles = ModelOfCar::findOrFail($id);
        $types = Type::where('available', 1)->orderBy('name', 'ASC')->get();

        return view('backend.vehicle.model.edit', [
            'data' => $vehicles,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'model_name' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'status_available' => ['required'],
            'mode_type' => ['required'],
            'order' => ['required'],
            'data_sheet' => ['required', 'string', 'max:255'],
        ]);

        $vehicle = ModelOfCar::findOrFail($request->id);
        $oldSlug = $vehicle->slug;

        $vehicle->name = $validatedData['model_name'];
        $vehicle->description = $validatedData['description'];
        $vehicle->type_id = $validatedData['mode_type'];
        $vehicle->slug = Str::slug($validatedData['model_name'], '-');
        $vehicle->data_sheet = $validatedData['data_sheet'];
        $vehicle->online_reservation = $request->sale_online ? '1' : '0';
        $vehicle->order = $validatedData['order'];
        $vehicle->status = $validatedData['status_available'] ? '1' : '0';

        if ($request->hasFile('avatar')) {

            Storage::deleteDirectory('public/vehicles/' . $oldSlug);

            $originalImage = $request->file('avatar');
            $filename = time() . '_' . $originalImage->getClientOriginalName();

            // Define the paths
            $originalPath = 'public/vehicles/' . $vehicle->slug . '/';
            $thumbnailPath = 'public/vehicles/' . $vehicle->slug . '/thumbnail/';

            // Ensure the directories exist
            Storage::makeDirectory($originalPath);
            chmod(storage_path('app/' . $originalPath), 0775);
            Storage::makeDirectory($thumbnailPath);
            chmod(storage_path('app/' . $thumbnailPath), 0775);

            // Create the image with Intervention Image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($originalImage);

            // Save the original image
            Storage::put($originalPath . $filename, (string) $image->encode());

            // Create and save the thumbnail image
            $thumbnailImage = $manager->read($originalImage);
            $thumbnailImage->scale(width: 300);

            Storage::put($thumbnailPath . $filename, (string) $thumbnailImage->encode());

            $vehicle->image = $filename;

        }

        $vehicle->save();

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        json_decode($request->getContent(), true);
        $ids = $request->ids;

        $deleted = ModelOfCar::destroy($ids);

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
