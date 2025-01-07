<?php

namespace App\Providers;

use App\Models\Setting;
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
        $settings = Setting::first() ?? new Setting([
            'email' => '',
            'number' => '',
            'image' => '',
            'facebook' => '',
            'twitter' => '',
            'instagram' => '',
            'youtube' => '',
            'tiktok' => '',
        ]);

        view()->share('settings', $settings);
    }
}
