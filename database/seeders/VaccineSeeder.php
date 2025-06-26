<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sheeps = [
            ['name' => 'Enterotoxemia Vaccine'],
            ['name' => 'Foot and Mouth Disease Vaccine'],
            ['name' => 'Sheep Pox Vaccine'],
            ['name' => 'Anthrax Vaccine'],
            ['name' => 'Brucellosis Vaccine'],
            ['name' => 'Bluetongue Vaccine'],
            ['name' => 'Pasteurellosis Vaccine'],
            ['name' => 'Clostridial Vaccine'],
        ];

        foreach ($sheeps as $sheepVaccine) {
            Vaccine::create($sheepVaccine);
        }
    }
}
