<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin; // <-- INI BARIS YANG DIPERLUKAN

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin NORD', 
            'email' => 'admin@nord.com', 
            'password' => Hash::make('admin123'), 
        ]);
    }
}