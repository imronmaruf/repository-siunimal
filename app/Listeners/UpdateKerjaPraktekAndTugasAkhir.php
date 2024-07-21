<?php

namespace App\Listeners;

use App\Events\DosenMahasiswaUpdated;
use App\Models\KerjaPraktek;
use App\Models\TugasAkhir;

class UpdateKerjaPraktekAndTugasAkhir
{
    /**
     * Handle the event.
     *
     * @param  DosenMahasiswaUpdated  $event
     * @return void
     */
    public function handle(DosenMahasiswaUpdated $event): void
    {
        $mahasiswa = $event->mahasiswa;

        // Update Kerja Praktek
        foreach ($mahasiswa->kerjaPraktek as $kp) {
            $kp->mahasiswa_id = $mahasiswa->user_id;
            $kp->dosen_pembimbing = $mahasiswa->dosen_pembimbing_kp;
            // Pastikan untuk mengisi nilai-nilai lainnya yang sesuai
            $kp->save();
        }

        // Update Tugas Akhir
        foreach ($mahasiswa->tugasAkhir as $tga) {
            $tga->mahasiswa_id = $mahasiswa->user_id;
            $tga->dosen_pembimbing_1 = $mahasiswa->dosen_pembimbing_tga_1;
            $tga->dosen_pembimbing_2 = $mahasiswa->dosen_pembimbing_tga_2;
            // Pastikan untuk mengisi nilai-nilai lainnya yang sesuai
            $tga->save();
        }
    }
}
