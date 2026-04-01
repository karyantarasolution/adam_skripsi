<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Tambahkan ini
use Illuminate\Support\Facades\Hash; // Tambahkan ini

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Super Admin (DLH)
        User::create([
            'name' => 'Super Admin DLH',
            'email' => 'admin@dlh.bjm.go.id',
            'password' => Hash::make('password123'), // Password default
            'role' => 'super_admin',
        ]);
    }
}