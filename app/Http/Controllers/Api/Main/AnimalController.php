<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Api\Main\Animal;
use App\Models\Api\Main\Farm;
use App\Models\Api\User\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnimalController extends Controller
{

    public function index()
    {
        $animal = Animal::with(['farm' => ['farmer', 'mechta.baladiya.wilaya'], 'animalType', 'qrCode'])->paginate(10);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $animal
            ]
        );
    }

    public function allAnimals()
    {
        $animals = Animal::with(['farm' => ['farmer', 'mechta.baladiya.wilaya'], 'animalType'])->paginate(10);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $animals
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'gender' => 'required|string|in:male,female',
            'weight' => 'required|numeric|min:0',
            'price' => 'required',
            'date_of_birth' => 'required|date',
            'animal_type_id' => 'required|exists:animal_types,id',
        ]);

        $farmer = Farmer::find(Auth::user()->key->keyable->id);
        $validate['farm_id'] = $farmer->farm->id;
        $animal = Animal::create([
            'gender' => $request->gender,
            'weight' => $request->weight,
            'date_of_birth' => $request->date_of_birth,
            'farm_id' => $validate['farm_id'],
            'price' => $request->price,
            'animal_type_id' => $request->animal_type_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Animal created successfully',
            'data' => $animal->load(['farm' => ['farmer', 'mechta.baladiya.wilaya'], 'animalType', 'qrCode'])
        ], 201);

    }


    public function show($animal)
    {
        $animal = Animal::find($animal);
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $animal->load(['farm' => ['farmer', 'mechta.baladiya.wilaya'], 'animalType', 'qrCode'])
        ]);
    }



    public function update(Request $request, Animal $animal)
    {
        $request->validate([
            'gender' => 'sometimes|string|in:male,female',
            'weight' => 'sometimes|numeric|min:0',
            'price' => 'required',
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
            'data' => $animal->load(['farm' => ['farmer', 'mechta.baladiya.wilaya'], 'animalType', 'qrCode'])
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

