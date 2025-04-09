<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{

    public function index()
    {
        $animal = Animal::with(['farm.farmer','animalType' ,'qrCode'])->paginate(10);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $animal
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'gender' => 'required|string|in:male,female',
            'weight' => 'required|numeric|min:0',
            'date_of_birth' => 'required|date',
            'farm_id' => 'required|exists:farms,id',
            'animal_type_id' => 'required|exists:animal_types,id',
        ]);

        $animal = Animal::create([
            'gender' => $request->gender,
            'weight' => $request->weight,
            'date_of_birth' => $request->date_of_birth,
            'farm_id' => $request->farm_id,
            'animal_type_id' => $request->animal_type_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Animal created successfully',
            'data' => $animal->load(['farm.farmer','animalType' ,'qrCode'])
        ], 201);

    }


    public function show(Animal $animal)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $animal->load(['farm.farmer','animalType' ,'qrCode'])
        ]);
    }



    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'gender' => 'sometimes|string|in:male,female',
            'weight' => 'sometimes|numeric|min:0',
            'date_of_birth' => 'sometimes|date',
            'farm_id' => 'sometimes|exists:farms,id',
            'animal_type_id' => 'sometimes|exists:animal_types,id',
        ]);

        $animal->update($request->only([
            'gender',
            'weight',
            'date_of_birth',
            'farm_id',
            'animal_type_id',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Animal updated successfully',
            'data' => $animal->load(['farm.farmer','animalType' ,'qrCode'])
        ]);
    }


    public function destroy(Animal $animal)
    {
        $animal->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Animal deleted successfully'
        ]);
    }
}

