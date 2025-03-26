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
        $admins = [
            ['username' => 'admin1'],
            ['username' => 'admin2'],
            ['username' => 'admin3'],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
