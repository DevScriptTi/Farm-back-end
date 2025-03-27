<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\User\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = Farmer::with(['farms.mechta.baladiya.wilaya', 'key.user','picture'])->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'Farmers retrieved successfully',
            'data' => $farmers
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ]);

        $farmer = Farmer::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Farmer created successfully',
            'data' => $farmer->load(['farms.mechta.baladiya.wilaya', 'key.user','picture'])
        ], 201);
    }

    public function show(Farmer $farmer)
    {
        return response()->json([
            'status' => true,
            'message' => 'Farmer retrieved successfully',
            'data' => $farmer->load(['farms.mechta.baladiya.wilaya', 'key.user','picture'])
        ], 200);
    }

    public function update(Request $request, Farmer $farmer)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'last' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'date_of_birth' => 'sometimes|required|date',
        ]);

        $farmer->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Farmer updated successfully',
            'data' => $farmer->load(['farms.mechta.baladiya.wilaya', 'key.user','picture'])
        ], 200);
    }

    public function addPicture(Request $request , Farmer $farmer){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pictureName = $farmer->username. '.' . $request->file('picture')->getClientOriginalExtension();
        $picturePath = $request->file('picture')->storeAs('pictures', $pictureName, 'public');

        $farmer->picture()->create([
            'path' => $picturePath,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Picture added successfully',
            'data' => $farmer->load(['farms.mechta.baladiya.wilaya', 'key.user','picture'])
        ], 201);
    }

    public function changePicture(Request $request, Farmer $farmer)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Delete the old picture if exists
        if ($farmer->picture) {
            Storage::disk('public')->delete($farmer->picture->path);
            $farmer->picture()->delete();
        }

        $pictureName = $farmer->username . '.' . $request->file('picture')->getClientOriginalExtension();
        $picturePath = $request->file('picture')->storeAs('pictures', $pictureName, 'public');

        $farmer->picture()->create([
            'path' => $picturePath,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Picture changed successfully',
            'data' => $farmer->load(['farms.mechta.baladiya.wilaya', 'key.user', 'picture'])
        ], 200);
    }

    public function deletePicture(Farmer $farmer)
    {
        if ($farmer->picture) {
            Storage::disk('public')->delete($farmer->picture->path);
            $farmer->picture()->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Picture deleted successfully',
        ], 200);
    }

    public function addKey( Farmer $farmer)
    {
        $farmer->key()->create([
            'value' => Str::random(10),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Key added successfully',
            'data' => $farmer->load(['farms.mechta.baladiya.wilaya', 'key.user', 'picture'])
        ], 201);
    }

    public function destroy(Farmer $farmer)
    {
        $farmer->farms()->delete();
        $farmer->picture()->delete();
        $farmer->key()->delete();
        $farmer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Farmer deleted successfully',
        ], 200);
    }

}
