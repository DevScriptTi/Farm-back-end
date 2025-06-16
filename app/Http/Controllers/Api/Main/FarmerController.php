<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\User\Farmer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FarmerController extends Controller
{
    public function index()
    {
        $farmers = Farmer::with(['farm.mechta.baladiya.wilaya', 'key.user', 'picture'])->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'Farmers retrieved successfully',
            'data' => $farmers
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'farm_name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mechta_id' => 'required|exists:mechtas,id',
        ]);

        try {
            DB::beginTransaction();
            $farmer = Farmer::create([
                'name' => $validate['name'],
                'username' => $validate['name'] . '-' . $validate['last'] . '-' . Str::random(5),
                'last' => $validate['last'],
                'phone' => $validate['phone'],
                'date_of_birth' => $validate['date_of_birth'],
            ]);
            $farmer->farm()->create([
                'name' => $request->farm_name,
                'mechta_id' => $request->mechta_id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create farmer: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Farmer created successfully',
            'data' => $farmer->load(['farm.mechta.baladiya.wilaya', 'key.user', 'picture'])
        ], 201);
    }

    public function show(Farmer $farmer)
    {
        return response()->json([
            'status' => true,
            'message' => 'Farmer retrieved successfully',
            'data' => $farmer->load(['farms.mechta.baladiya.wilaya', 'key.user', 'picture'])
        ], 200);
    }

    public function update(Request $request, Farmer $farmer)
    {
        $validate = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'farm_name' => 'sometimes|required|string|max:255',
            'last' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:255',
            'date_of_birth' => 'sometimes|required|date',
            'mechta_id' => 'sometimes|required|exists:mechtas,id',
        ]);

        try {
            DB::beginTransaction();
            $farmer->update([
                'name' => $validate['name'],
                'username' => $validate['name'] . '-' . $validate['last'] . '-' . Str::random(5),
                'last' => $validate['last'],
                'phone' => $validate['phone'],
                'date_of_birth' => $validate['date_of_birth'],
            ]);
            $farmer->farm()->update([
                'name' => $request->farm_name,
                'mechta_id' => $request->mechta_id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create farmer: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Farmer updated successfully',
            'data' => $farmer->load(['farm.mechta.baladiya.wilaya', 'key.user', 'picture'])
        ], 200);
    }

    public function addPicture(Request $request, Farmer $farmer)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pictureName = $farmer->username . '.' . $request->file('picture')->getClientOriginalExtension();
        $picturePath = $request->file('picture')->storeAs('pictures', $pictureName, 'public');

        $farmer->picture()->create([
            'path' => $picturePath,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Picture added successfully',
            'data' => $farmer->load(['farm.mechta.baladiya.wilaya', 'key.user', 'picture'])
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
            'data' => $farmer->load(['farm.mechta.baladiya.wilaya', 'key.user', 'picture'])
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

    public function addKey(Farmer $farmer)
    {
        $farmer->key()->create([
            'value' => Str::random(10),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Key added successfully',
            'data' => $farmer->load(['farm.mechta.baladiya.wilaya', 'key.user', 'picture'])
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
