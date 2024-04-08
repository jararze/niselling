<?php

namespace App\Http\Controllers;

use App\Models\backend\Configuration\Agent;
use App\Models\backend\Configuration\City;
use App\Models\backend\Configuration\Showroom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $showrooms = Showroom::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();

        $agents = Agent::where('status', 1)
            ->withCount('quotes')
            ->orderBy('name', 'ASC')
            ->get();

        return view('backend.configuration.agent.index', [
            'showrooms' => $showrooms,
            'agents' => $agents,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $agent = new Agent();
        $agent->name = $validatedData['name'];
        $agent->phone = $request->phone;
        $agent->email = $request->email;
        $agent->showroom_id = $request->showroom;
        $agent->status = $request->available ? '1' : '0';

        $agent->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Type created successfully.',
            'data' => $agent
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $values = Agent::findOrFail($id);
        $showroom = Showroom::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();
        return view('backend.configuration.agent.view', [
            'data' => $values,
            'showrooms' => $showroom,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'email' => ['required'],
            'status' => 'required|boolean',
        ]);
        $agent = Agent::findOrFail($request->id);
        $agent->fill([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'showroom_id' => $request->showroom,
            'status' => $validatedData['status'],
        ]);

        $isSaved = $agent->save();

        return response()->json([
            'success' => $isSaved,
            'form' => $agent->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request):JsonResponse
    {
        $ids = $request->input('ids');
        $deleted = Agent::destroy($ids);
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Type deleted successfully.',
                'data' => $ids
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
