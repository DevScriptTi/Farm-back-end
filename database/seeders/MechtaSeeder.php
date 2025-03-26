<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Baladiya;
use App\Models\Api\Extra\Mechta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MechtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baladiyas = Baladiya::all();

        $mechtas = [
            ['name' => 'Mechta Ouled Ahmed', 'baladiya_id' => $baladiyas->where('name', 'Tizi Ouzou')->first()->id],
            ['name' => 'Mechta Bouzid', 'baladiya_id' => $baladiyas->where('name', 'Tizi Ouzou')->first()->id],
            ['name' => 'Mechta Aït Ali', 'baladiya_id' => $baladiyas->where('name', 'Bouzeguene')->first()->id],
            ['name' => 'Mechta Ouled Brahim', 'baladiya_id' => $baladiyas->where('name', 'Azeffoun')->first()->id],
            ['name' => 'Mechta Beni Yala', 'baladiya_id' => $baladiyas->where('name', 'Béjaïa')->first()->id],
            ['name' => 'Mechta Ouled Sidi Saïd', 'baladiya_id' => $baladiyas->where('name', 'Amizour')->first()->id],
            ['name' => 'Mechta Aïn El Hammam', 'baladiya_id' => $baladiyas->where('name', 'Kherrata')->first()->id],
        ];

        foreach ($mechtas as $mechta) {
            Mechta::create($mechta);
        }
    }
}
