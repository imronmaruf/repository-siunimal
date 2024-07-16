<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UsersMahasiswaRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}

// AddUserToMahasiswaTable.php (Listener)
namespace App\Listeners;

use App\Models\Mahasiswa;
use App\Events\UsersMahasiswaRegistered;

class AddUserToMahasiswaTable
{
    public function handle(UsersMahasiswaRegistered $event)
    {
        if ($event->user->role === 'mahasiswa') {
            Mahasiswa::create([
                'user_id' => $event->user->id,
                'name' => $event->user->name,
                'foto' => 'default.jpg',
                'nim' => null,
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
