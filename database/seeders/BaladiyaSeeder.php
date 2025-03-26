<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Baladiya;
use App\Models\Api\Extra\Wilaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaladiyaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayas = Wilaya::all();
        $baladiyas = [
            // Algiers
            ['name' => 'Alger Centre', 'wilaya_id' => $wilayas->where('name', 'Alger')->first()->id],
            ['name' => 'Sidi M\'Hamed', 'wilaya_id' => $wilayas->where('name', 'Alger')->first()->id],
            ['name' => 'El Madania', 'wilaya_id' => $wilayas->where('name', 'Alger')->first()->id],

            // Oran
            ['name' => 'Oran', 'wilaya_id' => $wilayas->where('name', 'Oran')->first()->id],
            ['name' => 'Bir El Djir', 'wilaya_id' => $wilayas->where('name', 'Oran')->first()->id],
            ['name' => 'Es Senia', 'wilaya_id' => $wilayas->where('name', 'Oran')->first()->id],

            // Constantine
            ['name' => 'Constantine', 'wilaya_id' => $wilayas->where('name', 'Constantine')->first()->id],
            ['name' => 'El Khroub', 'wilaya_id' => $wilayas->where('name', 'Constantine')->first()->id],
            ['name' => 'Aïn Smara', 'wilaya_id' => $wilayas->where('name', 'Constantine')->first()->id],

            // Tizi Ouzou
            ['name' => 'Tizi Ouzou', 'wilaya_id' => $wilayas->where('name', 'Tizi Ouzou')->first()->id],
            ['name' => 'Bouzeguene', 'wilaya_id' => $wilayas->where('name', 'Tizi Ouzou')->first()->id],
            ['name' => 'Azeffoun', 'wilaya_id' => $wilayas->where('name', 'Tizi Ouzou')->first()->id],

            // Béjaïa
            ['name' => 'Béjaïa', 'wilaya_id' => $wilayas->where('name', 'Béjaïa')->first()->id],
            ['name' => 'Amizour', 'wilaya_id' => $wilayas->where('name', 'Béjaïa')->first()->id],
            ['name' => 'Kherrata', 'wilaya_id' => $wilayas->where('name', 'Béjaïa')->first()->id],
        ];

        foreach ($baladiyas as $baladiya) {
            Baladiya::create($baladiya);
        }
    }
}
