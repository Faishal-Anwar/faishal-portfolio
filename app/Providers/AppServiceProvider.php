<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Profile;

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
        if (!app()->runningInConsole()) {
            $defaultProfile = new Profile([
                'name' => 'Faishal Anwar',
                'title' => 'ML Engineer',
                'email' => 'anwarfaishal86@gmail.com'
            ]);

            try {
                $profile = Cache::remember('global.profile', 3600, function () use ($defaultProfile) {
                    return Profile::first() ?? $defaultProfile;
                });
            } catch (\Exception $e) {
                $profile = $defaultProfile;
            }
            View::share('profile', $profile);
        }
    }
}
