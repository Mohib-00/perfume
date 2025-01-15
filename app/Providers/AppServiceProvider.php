<?php

namespace App\Providers;

use App\Models\HeaderSettings;
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

        $headersettings = HeaderSettings::first() ?? new HeaderSettings([
            'image' => '',
            'heading1' => '',
            'heading2' => '',
            'heading3' => '',
            'heading4' => '',
            'heading5' => '',
        ]);

        $notificationCount = NotificationOrder::count();

        view()->share([
            'settings' => $settings,
            'headersettings' => $headersettings,
            'notificationCount' => $notificationCount,
        ]);
    }
}
