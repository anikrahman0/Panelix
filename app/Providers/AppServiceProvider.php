<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Constants\CacheLifetime;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        Paginator::useBootstrap();
        $cdn_url = config('imagepath.cdn_url');
        if(Schema::hasTable('general_settings')) {
            $settings = cache()->remember('general_settings', CacheLifetime::ONE_DAY, function () {
                return GeneralSetting::where('status', 1)->first();
            });
            view()->share([
                'cdn_url' => $cdn_url,
                'settings' => $settings,
            ]);
        }
    }
}
