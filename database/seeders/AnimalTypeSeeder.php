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
            ['name' => 'Cow', 'slug' => Str::slug('Cow')],
            ['name' => 'Goat', 'slug' => Str::slug('Goat')],
            ['name' => 'Sheep', 'slug' => Str::slug('Sheep')],
            ['name' => 'Horse', 'slug' => Str::slug('Horse')],
        ];

        foreach ($types as $type) {
            AnimalType::create($type);
        }
    }
}
