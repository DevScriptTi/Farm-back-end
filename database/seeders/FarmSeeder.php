<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Mechta;
use App\Models\Api\Main\Farm;
use App\Models\Api\User\Farmer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farmers = Farmer::all();
        $mechtas = Mechta::all();

        $farms = [
            [
                'name' => 'Ferme Bouaziz',
                'mechta_id' => $mechtas->where('name', 'Mechta Ouled Ahmed')->first()->id,
                'farmer_id' => $farmers->random()->id,
            ],
            [
                'name' => 'Ferme Khelifi',
                'mechta_id' => $mechtas->where('name', 'Mechta Bouzid')->first()->id,
                'farmer_id' => $farmers->random()->id,
            ],
            [
                'name' => 'Ferme Zohra',
                'mechta_id' => $mechtas->where('name', 'Mechta Aït Ali')->first()->id,
                'farmer_id' => $farmers->random()->id,

            ],
        ];

        foreach ($farms as $farm) {
            Farm::create($farm);
        }
    }
}
