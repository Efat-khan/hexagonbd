<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Efat Khan',
            'email' => 'efatkhan.duet.cse@gmail.com',  // Replace with the desired admin email
            'password' => Hash::make('Efat1997@#'),  // Replace with the desired password
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
