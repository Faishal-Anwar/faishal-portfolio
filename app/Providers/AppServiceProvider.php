<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
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

        // Share all site settings with all views
        if (Schema::hasTable('settings')) {
            View::composer('*', function ($view) {
                $siteSettings = Cache::rememberForever('site.settings', function () {
                    return Setting::pluck('value', 'key');
                });
                $view->with('siteSettings', $siteSettings);
            });
        }
    }
}