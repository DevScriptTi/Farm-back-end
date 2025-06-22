<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\User\Veterinary;
use Illuminate\Http\Request;

class VeterinariesController extends Controller
{
    public function index()
    {
        $farmers = Veterinary::with(['baladiya.wilaya', 'key.user', 'photo'])->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'Farmers retrieved successfully',
            'data' => $farmers
        ], 200);
    }

    public function allVeterinaries(){
        $veterinaries = Veterinary::with(['baladiya.wilaya', 'photo'])->paginate(15);
        return response()->json([
            'status' => true,
            'message' => 'Veterinaries retrieved successfully',
            'data' => $veterinaries
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:veterinaries,username',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:veterinaries,email',
            'academic_degree' => 'required|string|max:255',
            'license_number' => 'required|string|max:255|unique:veterinaries,license_number',
            'clinic_location' => 'required|string|max:255',
            'baladiya_id' => 'required|exists:baladiyas,id',
        ]);

        $veterinary = Veterinary::create([
            'name' => $validate['name'],
            'last' => $validate['last'],
            'username' => $validate['username'],
            'phone' => $validate['phone'],
            'email' => $validate['email'],
            'academic_degree' => $validate['academic_degree'],
            'license_number' => $validate['license_number'],
            'clinic_location' => $validate['clinic_location'],
            'baladiya_id' => $validate['baladiya_id'],
        ]);

        // Load relationships
        $veterinary->load(['baladiya.wilaya', 'key.user']);

        return response()->json([
            'status' => true,
            'message' => 'Veterinary created successfully',
            'data' => $veterinary
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $veterinary = Veterinary::findOrFail($id);

        $validate = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'last' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255|unique:veterinaries,username,' . $veterinary->id,
            'phone' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:veterinaries,email,' . $veterinary->id,
            'academic_degree' => 'sometimes|required|string|max:255',
            'license_number' => 'sometimes|required|string|max:255|unique:veterinaries,license_number,' . $veterinary->id,
            'clinic_location' => 'sometimes|required|string|max:255',
            'baladiya_id' => 'sometimes|required|exists:baladiyas,id',
        ]);

        $veterinary->update([
            'name' => $validate['name'],
            'last' => $validate['last'],
            'username' => $validate['username'],
            'phone' => $validate['phone'],
            'email' => $validate['email'],
            'academic_degree' => $validate['academic_degree'],
            'license_number' => $validate['license_number'],
            'clinic_location' => $validate['clinic_location'],
            'baladiya_id' => $validate['baladiya_id'],
        ]);

        $veterinary->load(['baladiya.wilaya', 'key.user']);

        return response()->json([
            'status' => true,
            'message' => 'Veterinary updated successfully',
            'data' => $veterinary
        ], 200);
    }
}
