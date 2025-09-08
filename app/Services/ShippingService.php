<?php

namespace App\Services;

use App\Models\State;
use App\Models\GeneralSetting;

class ShippingService {
    protected $settings;

    public function __construct()
    {
        $this->settings = GeneralSetting::first(); // Can be cached if needed
    }

    public function calculate(int $state_id): float
    {
        $state = State::find($state_id);

        if (!$state) {
            throw new \InvalidArgumentException('Invalid state ID');
        }

        return $state->name === 'Dhaka'
            ? $this->settings->shipping_inside_dhaka
            : $this->settings->shipping_outside_dhaka;
    }
}