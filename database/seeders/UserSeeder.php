<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Karyawan Tambahan
        User::create([
            'name' => 'Karyawan Dua',
            'email' => 'karyawan2@banmas.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // 2. Akun Teknisi
        User::create([
            'name' => 'Mas Teknisi',
            'email' => 'teknisi@banmas.com',
            'password' => Hash::make('password123'),
            'role' => 'teknisi',
        ]);

        // 3. Akun User / Karyawan Pelapor
        User::create([
            'name' => 'Karyawan Biasa',
            'email' => 'user@banmas.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}