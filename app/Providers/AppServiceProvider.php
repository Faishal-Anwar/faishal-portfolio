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
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            \Illuminate\Support\Facades\URL::forceRootUrl('https://faishal-portfolio-blue.vercel.app');
        }

        if (!app()->runningInConsole()) {
            \Illuminate\Support\Facades\View::share('profile', Profile::first() ?? new Profile([
                'name' => 'Faishal Anwar',
                'title' => 'ML Engineer',
                'email' => 'anwarfaishal86@gmail.com'
            ]));
        }
    }
}
