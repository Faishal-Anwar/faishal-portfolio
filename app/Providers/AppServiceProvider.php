<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Support\Facades\URL;
=======
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
>>>>>>> 5986da8 (commit ke dua)
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
<<<<<<< HEAD
=======

        // Share the profile photo URL with all views
        if (Schema::hasTable('users')) {
            View::composer('*', function ($view) {
                $adminUser = User::first(); // Assuming the first user is the admin
                $view->with('profilePhotoUrl', $adminUser->profile_photo_url ?? null);
            });
        }
>>>>>>> 5986da8 (commit ke dua)
    }
}
