<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Mechta;
use App\Models\Api\User\Farmer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $farmers = [
            [
                'username' => 'farmer1',
                'name' => 'Mohamed',
                'last' => 'Bouaziz',
                'phone' => '0550123456',
                'date_of_birth' => Carbon::parse('1980-05-15'),
            ],
            [
                'username' => 'farmer2',
                'name' => 'Ali',
                'last' => 'Khelifi',
                'phone' => '0551123456',
                'date_of_birth' => Carbon::parse('1975-08-22'),
            ],
            [
                'username' => 'farmer3',
                'name' => 'Fatima',
                'last' => 'Zohra',
                'phone' => '0552123456',
                'date_of_birth' => Carbon::parse('1985-03-10'),
            ],
            [
                'username' => 'farmer4',
                'name' => 'Karim',
                'last' => 'Bensaad',
                'phone' => '0553123456',
                'date_of_birth' => Carbon::parse('1978-11-30'),
            ],
        ];
        $mechtas = Mechta::all();


        foreach ($farmers as $farmer) {
            $farmer = Farmer::create($farmer);
            $farmer->farm()->create([
                'name' => $farmer->name . "'s farm",
                'mechta_id' => $mechtas->random()->id
            ]);
        }
    }
}
