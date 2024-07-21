<?php
// EventServiceProvider.php
namespace App\Providers;

use App\Events\DosenMahasiswaUpdated;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Events\UsersMahasiswaRegistered;
use App\Listeners\AddUserToMahasiswaTable;
use App\Listeners\UpdateKerjaPraktekAndTugasAkhir;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UsersMahasiswaRegistered::class => [
            AddUserToMahasiswaTable::class,
        ],
        DosenMahasiswaUpdated::class => [
            UpdateKerjaPraktekAndTugasAkhir::class,
        ],
    ];

    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
