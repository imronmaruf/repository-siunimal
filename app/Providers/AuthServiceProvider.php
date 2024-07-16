<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('all-access', function ($user) {
            return in_array($user->role, ['admin', 'mahasiswa']);
        });

        Gate::define('admin-only', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('mahasiswa-only', function ($user) {
            return $user->role === 'mahasiswa';
        });
    }
}
