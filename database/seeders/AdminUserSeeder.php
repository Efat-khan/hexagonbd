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
            'name' => 'Admin',
            'email' => 'admin@hexagonbd.com',  // Replace with the desired admin email
            'password' => Hash::make('G7k!p2Zr#9Qw'),  // Replace with the desired password G7k!p2Zr#9Qw
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
