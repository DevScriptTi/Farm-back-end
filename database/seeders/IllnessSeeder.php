<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Illness;
use Illuminate\Database\Seeder;

class IllnessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $illnesses = [
            // Sheep illnesses
            [
                "name" => "Scrapie",
                "description" => "A fatal, degenerative disease affecting the nervous systems of sheep and goats."
            ],
            [
                "name" => "Blue Tongue",
                "description" => "A viral disease of sheep causing swelling, hemorrhages, and lameness."
            ],
            [
                "name" => "Sheep Scab",
                "description" => "A highly contagious skin disease caused by mites."
            ],
            [
                "name" => "Enterotoxemia",
                "description" => "Also known as pulpy kidney, caused by Clostridium perfringens bacteria."
            ],
            [
                "name" => "Ovine Johne’s Disease",
                "description" => "A chronic wasting disease of sheep caused by Mycobacterium avium subspecies paratuberculosis."
            ],

            // Horse illnesses
            [
                "name" => "Colic",
                "description" => "A general term for abdominal pain in horses, often due to digestive issues."
            ],
            [
                "name" => "Equine Influenza",
                "description" => "A highly contagious viral respiratory disease in horses."
            ],
            [
                "name" => "Strangles",
                "description" => "A bacterial infection causing abscesses in the lymph nodes of horses."
            ],
            [
                "name" => "Laminitis",
                "description" => "A painful inflammatory condition of the tissues (laminae) bonding the hoof wall to the pedal bone."
            ],
            [
                "name" => "Equine Herpesvirus (EHV)",
                "description" => "A viral infection that can cause respiratory disease, abortion, and neurological disease in horses."
            ],
        ];

        foreach ($illnesses as $illness) {
            Illness::create($illness);
        }


    }
}
