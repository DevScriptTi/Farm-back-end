<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farms = Farm::with(['farmer.picture', 'mechta.baladiya.wilaya'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Farms retrieved successfully',
            'data' => $farms
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mechta_id' => 'required|exists:mechtas,id',
        ]);
        if(Auth::user()->key->keyable_type === "admin"){
            $request->validate([
                'farmer_id' => 'required|exists:farmers,id',
            ]);
        }

        $farm = Farm::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Farm created successfully',
            'data' => $farm
        ]);

    }

    public function show(Farm $farm)
    {
        return response()->json([
            'status' => true,
            'message' => 'Farm retrieved successfully',
            'data' => $farm->load(['farmer.picture', 'mechta.baladiya.wilaya'])
        ]);
    }


    public function update(Request $request, Farm $farm)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'mechta_id' => 'sometimes|required|exists:mechtas,id',
        ]);

        if(Auth::user()->key->keyable_type === "admin"){
            $request->validate([
                'farmer_id' => 'required|exists:farmers,id',
            ]);
        }

        $farm->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Farm updated successfully',
            'data' => $farm->load(['farmer.picture', 'mechta.baladiya.wilaya'])
        ]);
    }

    public function destroy(Farm $farm)
    {
        $farm->animals()->delete();
        $farm->delete();

        return response()->json([
            'status' => true,
            'message' => 'Farm deleted successfully',
        ]);
    }

}
