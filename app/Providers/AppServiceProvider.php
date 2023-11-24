<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        Gate::define('isSuperadmin', function ($user) {
            return $user->role == 'superadmin';
        });

        Gate::define('isPengelola', function ($user) {
            return $user->role == 'pengelola';
        });

        Gate::define('isCustomer', function ($user) {
            return $user->role == 'customer';
        });
    }
}
