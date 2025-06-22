<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Api\Main\Farm;
use Illuminate\Support\Carbon;
use App\Models\Api\Main\Animal;
use Illuminate\Database\Seeder;
use App\Models\Api\Extra\AnimalType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farms = Farm::all();
        $types = AnimalType::all();

        $animals = [
            [
                'slug' => Str::slug('Vache-1'),
                'gender' => 'female',
                'price' => mt_rand(15000, 100000) + mt_rand() / mt_getrandmax(),
                'weight' => 450.5,
                'date_of_birth' => Carbon::parse('2018-03-15'),
                'farm_id' => $farms->first()->id,
                'animal_type_id' => $types->where('name', 'Vache')->first()->id,
            ],
            [
                'slug' => Str::slug('Mouton-1'),
                'gender' => 'male',
                'price' => mt_rand(15000, 100000) + mt_rand() / mt_getrandmax(),
                'weight' => 65.2,
                'date_of_birth' => Carbon::parse('2020-05-20'),
                'farm_id' => $farms->first()->id,
                'animal_type_id' => $types->where('name', 'Mouton')->first()->id,
            ],
            [
                'slug' => Str::slug('Chèvre-1'),
                'gender' => 'female',
                'price' => mt_rand(15000, 100000) + mt_rand() / mt_getrandmax(),
                'weight' => 42.3,
                'date_of_birth' => Carbon::parse('2019-07-10'),
                'farm_id' => $farms->get(1)->id,
                'animal_type_id' => $types->where('name', 'Chèvre')->first()->id,
            ],
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }
}
