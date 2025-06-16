<?php

namespace Database\Seeders;

use App\Models\Api\User\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Array of Nigerian first names
        $names = ['Amine', 'Yasmine', 'Karim', 'Nadia', 'Rachid', 'Samir', 'Amina', 'Farid', 'Sofiane', 'Lina'];

        // Array of Algerian last names
        $lasts = ['Benkhaled', 'Boumediene', 'Zeroual', 'Belkacem', 'Meziane', 'Saadi', 'Bensalah', 'Guedj', 'Toumi', 'Mokhtari'];

        /**
         * Get a random Nigerian first name.
         *
         * @param array $names
         * @return string
         */
        function randomName(array $names): string
        {
            return $names[array_rand($names)];
        }

        /**
         * Get a random Nigerian last name.
         *
         * @param array $lasts
         * @return string
         */
        function randomLast(array $lasts): string
        {
            return $lasts[array_rand($lasts)];
        }

        for ($i = 0; $i < 6; $i++) {
            $name = $lasts[array_rand($lasts)];
            $last = $names[array_rand($names)];
            Admin::create([
                'username' => strtolower($last) . strtolower($name) . mt_rand(1000, 9999),
                'name' => $name,
                'last' => $last,
                'is_super' => rand(0, 1) ? 'yes' : 'no',
            ]);
        }

    }
}
