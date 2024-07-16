<?php

namespace App\Listeners;

use App\Models\Mahasiswa;
use App\Events\UsersMahasiswaRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddUserToMahasiswaTable
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UsersMahasiswaRegistered $event): void
    {
        // Hanya tambahkan user dengan role 'mahasiswa'
        if ($event->user->role === 'mahasiswa') {
            Mahasiswa::create([
                'user_id' => $event->user->id,
                'name' => $event->user->name,
                'foto' => 'default.jpg', // Misalnya default foto
                'nim' => null, // Atur sesuai kebutuhan
                'hp' => null,
                'dosen_pembimbing_kp' => null,
                'dosen_pembimbing_tga_1' => null,
                'dosen_pembimbing_tga_2' => null,
                'dosen_penguji_tga_1' => null,
                'dosen_penguji_tga_2' => null,
            ]);
        }
    }
}
