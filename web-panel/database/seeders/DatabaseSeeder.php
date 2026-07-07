<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'pulsanolimit@gmail.com', // Ganti dengan email lu
            'password' => Hash::make('4dm1n123'), // Ganti dengan password yang lu mau
            'role' => 'admin',
        ]);
    }
}