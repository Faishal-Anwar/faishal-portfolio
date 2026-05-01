<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
            try {
                $profile = Profile::first() ?? new Profile([
                    'name' => 'Faishal Anwar',
                    'title' => 'ML Engineer',
                    'email' => 'anwarfaishal86@gmail.com'
                ]);
            } catch (\Exception $e) {
                $profile = new Profile([
                    'name' => 'Faishal Anwar',
                    'title' => 'ML Engineer',
                    'email' => 'anwarfaishal86@gmail.com'
                ]);
            }
            \Illuminate\Support\Facades\View::share('profile', $profile);
        }
    }
}
