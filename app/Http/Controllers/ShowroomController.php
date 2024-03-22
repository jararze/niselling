<?php

namespace App\Http\Controllers;

use App\Models\backend\Configuration\City;
use App\Models\backend\Configuration\Showroom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShowroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        $values = Showroom::withCount('agents')
            ->orderBy('name', 'ASC')
            ->get();

        return view('backend.configuration.showroom.index', [
            'values' => $values,
            'cities' => $cities,
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
            'name' => ['required', 'string', 'max:255', 'unique:showrooms,name'],
        ]);

        $city = new Showroom();
        $city->name = $validatedData['name'];
        $city->city_id = $request->city_id;
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
    public function show(Showroom $showroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $values = Showroom::findOrFail($id);
        $cities = City::where('status', 1)
            ->where(function($query){
                $query->whereNull('deleted_at')
                    ->orWhere('deleted_at', '');
            })
            ->orderBy('name', 'ASC')
            ->get();
        return view('backend.configuration.showroom.view', [
            'data' => $values,
            'cities' => $cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Showroom $showroom)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => 'required|boolean',
        ]);
        $showroom = Showroom::findOrFail($request->id);
        $showroom->fill([
            'name' => $validatedData['name'],
            'city_id' => $request->city,
            'status' => $validatedData['status'],
        ]);

        $isSaved = $showroom->save();

        return response()->json([
            'success' => $isSaved,
            'form' => $showroom->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request):JsonResponse
    {
        $ids = $request->input('ids');
        $deleted = Showroom::destroy($ids);

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
