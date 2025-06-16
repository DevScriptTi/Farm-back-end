<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Api\User\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\KeySeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\FarmSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\AnimalSeeder;
use Database\Seeders\FarmerSeeder;
use Database\Seeders\MechtaSeeder;
use Database\Seeders\QRCodeSeeder;
use Database\Seeders\WilayaSeeder;
use Database\Seeders\IllnessSeeder;
use Database\Seeders\PictureSeeder;
use Database\Seeders\VaccineSeeder;
use Database\Seeders\BaladiyaSeeder;
use Database\Seeders\AnimalTypeSeeder;
use Database\Seeders\AnimalIllnessSeeder;
use Database\Seeders\AnimalVaccineSeeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Admin::create(['username' => 'Developer-1234', 'name' => 'Fouzi', 'last' => "Ali", 'is_super' => 'yes']);
        $key = $admin->key;
        $key->user()->create(['email' => 'admin@gmail.com', 'phone' => '0666675488', 'password' => 'password']);

        $this->call([
            WilayaSeeder::class,
            BaladiyaSeeder::class,
            MechtaSeeder::class,
            AdminSeeder::class,
            FarmerSeeder::class,
            FarmSeeder::class,
            AnimalTypeSeeder::class,
            AnimalSeeder::class,
            IllnessSeeder::class,
            VaccineSeeder::class,
            AnimalIllnessSeeder::class,
            AnimalVaccineSeeder::class,
            PictureSeeder::class,
            QRCodeSeeder::class,
            KeySeeder::class,
            VeterinarySeeder::class,
        ]);
    }
}
