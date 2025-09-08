<?php

namespace App\Services;

use App\Models\City;
use App\Models\State;

class LocationService
{
    public function getStatesByCountry($countryId)
    {
        if (!empty($countryId)) {
            return State::where('country_id', $countryId)
                ->where('status', 1)
                ->get();
        }

        return collect();
    }

    public function getCitiesByState($stateId)
    {
        if (!empty($stateId)) {
            return City::where('state_id', $stateId)
                ->where('status', 1)
                ->get();
        }

        return collect();
    }
}