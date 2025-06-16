<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Baladiya;
use App\Models\Api\User\Veterinary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VeterinarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            "Amine",
            "Yacine",
            "Nour",
            "Sofiane",
            "Amina",
            "Imane",
            "Rania",
            "Walid",
            "Samir",
            "Karim",
            "Nadia",
            "Lina",
            "Farid",
            "Hakim",
            "Meriem",
            "Salah",
            "Fouad",
            "Sabrina",
            "Khaled",
            "Nabil"
        ];

        $last = [
            "Benkhaled",
            "Boumediene",
            "Saadi",
            "Belkacem",
            "Zerrouki",
            "Bensalem",
            "Meziane",
            "Boukhalfa",
            "Djebbar",
            "Boudiaf",
            "Guedjati",
            "Belaid",
            "Toumi",
            "Benkheira",
            "Charef",
            "Boudjemaa",
            "Bensaid",
            "Bouzid",
            "Bendjebbour",
            "Boukadoum"
        ];

        function getRandomName(array $names): string
        {
            return $names[array_rand($names)];
        }

        function getRandomLastName(array $last): string
        {
            return $last[array_rand($last)];
        }

        $degrees = ['DVM', 'PhD', 'MVSc', 'BVM', 'MSc'];
        $locations = ['Algiers', 'Oran', 'Constantine', 'Annaba', 'Blida'];

        for ($i = 0; $i < 20; $i++) {
            $baladiyaId = Baladiya::inRandomOrder()->value('id');
            $firstName = getRandomName($names);
            $lastName = getRandomLastName($last);
            $username = strtolower($firstName . '.' . $lastName . rand(1, 99));
            $phone = '05' . rand(5, 9) . rand(1000000, 9999999);
            $email = strtolower($firstName . '.' . $lastName . $i . '@example.com');
            $degree = $degrees[array_rand($degrees)];
            $license = 'DZ-' . rand(10000, 99999);
            $clinic = $locations[array_rand($locations)];

            Veterinary::create([
                'name' => $firstName,
                'last' => $lastName,
                'username' => $username,
                'phone' => $phone,
                'email' => $email,
                'academic_degree' => $degree,
                'license_number' => $license,
                'clinic_location' => $clinic,
                'baladiya_id' => $baladiyaId,
            ]);
        }
    }
}
