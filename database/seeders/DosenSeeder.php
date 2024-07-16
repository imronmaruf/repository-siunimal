<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'name' => 'Prof. Dr. Ir. Dahlan Abdullah, S.T., M.Kom, IPU., ASEAN Eng',
            'nip' => '197602282002121005',
        ]);
        Dosen::create([
            'name' => 'Rizky Putra Fhonna, S.T., M.Kom',
            'nip' => '199111192019031012',
        ]);
        Dosen::create([
            'name' => 'Dosen 3',
            'nip' => '123456779',
        ]);
        Dosen::create([
            'name' => 'Dosen 4',
            'nip' => '123456789',
        ]);
        Dosen::create([
            'name' => 'Dosen 5',
            'nip' => '123456789',
        ]);
    }
}
