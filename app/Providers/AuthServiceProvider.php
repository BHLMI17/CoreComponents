<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Gate for admin (also allows super admins)
        Gate::define('admin-only', function (User $user) {
            return in_array($user->role, ['admin', 'super_admin']);
        });

        // Gate for super admin only
        Gate::define('super-admin-only', function (User $user) {
            return $user->role === 'super_admin';
        });
    }
}