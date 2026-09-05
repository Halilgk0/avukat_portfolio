<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Share site settings with all views
        View::composer('*', function ($view) {
            $siteSettings = [
                'site_name' => Setting::get('site_name', 'Avukat Sitesi'),
                'site_logo' => Setting::get('site_logo'),
            ];
            
            $view->with('siteSettings', $siteSettings);
        });
    }
}
