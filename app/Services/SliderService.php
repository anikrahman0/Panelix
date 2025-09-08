<?php

namespace App\Services;

use App\Models\Slider;
use App\Constants\CacheLifetime;

class SliderService {

    public  function getSliders()
    {
        return cache()->remember('home_sliders', CacheLifetime::ONE_DAY, function () {
            return Slider::with('images')->published()->where('slider_type', 1)->latest()->first();
        });
    }
}