<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Wilaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayas = [
            ['name' => 'Adrar'],
            ['name' => 'Chlef'],
            ['name' => 'Laghouat'],
            ['name' => 'Oum El Bouaghi'],
            ['name' => 'Batna'],
            ['name' => 'Béjaïa'],
            ['name' => 'Biskra'],
            ['name' => 'Béchar'],
            ['name' => 'Blida'],
            ['name' => 'Bouira'],
            ['name' => 'Tamanrasset'],
            ['name' => 'Tébessa'],
            ['name' => 'Tlemcen'],
            ['name' => 'Tiaret'],
            ['name' => 'Tizi Ouzou'],
            ['name' => 'Alger'],
            ['name' => 'Djelfa'],
            ['name' => 'Jijel'],
            ['name' => 'Sétif'],
            ['name' => 'Saïda'],
            ['name' => 'Skikda'],
            ['name' => 'Sidi Bel Abbès'],
            ['name' => 'Annaba'],
            ['name' => 'Guelma'],
            ['name' => 'Constantine'],
            ['name' => 'Médéa'],
            ['name' => 'Mostaganem'],
            ['name' => 'M\'Sila'],
            ['name' => 'Mascara'],
            ['name' => 'Ouargla'],
            ['name' => 'Oran'],
            ['name' => 'El Bayadh'],
            ['name' => 'Illizi'],
            ['name' => 'Bordj Bou Arréridj'],
            ['name' => 'Boumerdès'],
            ['name' => 'El Tarf'],
            ['name' => 'Tindouf'],
            ['name' => 'Tissemsilt'],
            ['name' => 'El Oued'],
            ['name' => 'Khenchela'],
            ['name' => 'Souk Ahras'],
            ['name' => 'Tipaza'],
            ['name' => 'Mila'],
            ['name' => 'Aïn Defla'],
            ['name' => 'Naâma'],
            ['name' => 'Aïn Témouchent'],
            ['name' => 'Ghardaïa'],
            ['name' => 'Relizane'],
        ];

        foreach ($wilayas as $wilaya) {
            Wilaya::create($wilaya);
        }
    }
}
