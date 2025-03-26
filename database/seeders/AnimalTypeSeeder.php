<?php

namespace Database\Seeders;

use App\Models\Api\Extra\AnimalType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnimalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Vache', 'slug' => Str::slug('Vache')],
            ['name' => 'Mouton', 'slug' => Str::slug('Mouton')],
            ['name' => 'Chèvre', 'slug' => Str::slug('Chèvre')],
            ['name' => 'Poule', 'slug' => Str::slug('Poule')],
        ];

        foreach ($types as $type) {
            AnimalType::create($type);
        }
    }
}
