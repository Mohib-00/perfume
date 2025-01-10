<?php

namespace App\Providers;

use App\Models\NotificationOrder;
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

        $notificationCount = NotificationOrder::count();

        view()->share([
            'settings' => $settings,
            'notificationCount' => $notificationCount,
        ]);
    }
}
