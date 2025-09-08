<?php

namespace App\Services;

use App\Models\GeneralSetting;
use App\Constants\CacheLifetime;

class SettingsService
{
    public function getHomeBanners(){
        return cache()->remember('home_banners', CacheLifetime::ONE_DAY, function () {
            return GeneralSetting::select('banner_image_first', 'banner_image_second')->first();
        });
    }
}