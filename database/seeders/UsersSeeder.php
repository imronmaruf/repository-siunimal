<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Imron Maruf Fajaruddin',
            'email' => 'imronfajar@gmail.com',
            'role' => 'admin',
            'status' => 'aktif',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'role' => 'mahasiswa',
            'status' => 'pending',
            'password' => bcrypt('password'),
        ]);
    }
}
