<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Share the profile photo URL with all views
        if (Schema::hasTable('users')) {
            View::composer('*', function ($view) {
                $adminUser = User::first(); // Assuming the first user is the admin
                $view->with('profilePhotoUrl', $adminUser->profile_photo_url ?? null);
            });
        }
    }
}