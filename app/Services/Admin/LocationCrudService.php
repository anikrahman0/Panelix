<?php
namespace App\Services\Admin;


use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Library\CommonFunctions;
use App\Http\Requests\CityValidationRequest;
use App\Http\Requests\StateValidationRequest;
use App\Http\Requests\CountryValidationRequest;

class LocationCrudService
{
    public static function listCountry()
    {
        $data['countries'] = Country::orderBy('country_name', 'ASC')
            ->where('status', 1)
            ->get();

        return $data;
    }

    public static function storeCountry(CountryValidationRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('country_flag')) {
            $flagname = CommonFunctions::imageUpload($request->file('country_flag'), 'media/uploads/flags');
            $validated['country_flag'] = $flagname;
        }

        Country::create($validated);

        return [
            'success' => true,
            'message' => 'Country Added successfully',
        ];
    }

    public static function editCountry($id)
    {
        $country = Country::where('id', $id)->where('status', 1)->first();

        if (!$country) {
            abort(404);
        }

        $data['country'] = $country;
        $data['id'] = $id;

        return $data;
    }

    public static function updateCountry(CountryValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $country = Country::where('id', $id)->where('status', 1)->first();

        if (!$country) {
            abort(404);
        }

        if ($request->hasFile('country_flag')) {
            $flagname = CommonFunctions::imageUpload($request->file('country_flag'), 'media/uploads/flags');
            $validated['country_flag'] = $flagname;
        }

        $country->update($validated);

        return [
            'success' => true,
            'message' => 'Country Updated successfully',
        ];
    }

    public static function deleteCountry($id)
    {
        $country = Country::findOrFail($id);

        $country->status = 2;
        $country->update();

        return [
            'success' => true,
            'message' => 'Country deleted successfully',
        ];
    }

    public static function listStates()
    {
        $data['states'] = State::with('country')
            ->where('status', 1)
            ->orderBy('country_id', 'ASC')
            ->get();

        return $data;
    }

    public static function addState()
    {
        $data['countries'] = Country::where('status', 1)
            ->orderBy('country_name', 'ASC')
            ->get();

        return $data;
    }

    public static function storeState(StateValidationRequest $request)
    {
        $validated = $request->validated();

        State::create($validated);

        return [
            'success' => true,
            'message' => 'State Added successfully',
        ];
    }

    public static function editState($id)
    {
        $state = State::with('country')
            ->where('id', $id)
            ->where('status', 1)
            ->first();

        if (!$state) {
            abort(404);
        }

        $data['state'] = $state;
        $data['countries'] = Country::where('status', 1)
            ->orderBy('country_name', 'ASC')
            ->get();
        $data['id'] = $id;

        return $data;
    }

    public static function updateState(StateValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $state = State::where('id', $id)->where('status', 1)->first();

        if (!$state) {
            abort(404);
        }

        $state->update($validated);

        return [
            'success' => true,
            'message' => 'State Updated successfully',
        ];
    }

    public static function deleteState($id)
    {
        $state = State::findOrFail($id);

        $state->status = 2;
        $state->update();

        return [
            'success' => true,
            'message' => 'State deleted successfully',
        ];
    }

        public static function listCities()
    {
        $data['cities'] = City::with('state')
            ->where('status', 1)
            ->orderBy('state_id', 'ASC')
            ->get();

        return $data;
    }

    public static function addCity()
    {
        $data['countries'] = Country::where('status', 1)
            ->orderBy('country_name', 'ASC')
            ->get();

        return $data;
    }

    public static function storeCity(CityValidationRequest $request)
    {
        $validated = $request->validated();

        // Remove country_id as per your original logic
        unset($validated['country_id']);

        City::create($validated);

        return [
            'success' => true,
            'message' => 'City Added successfully',
        ];
    }

    public static function editCity($id)
    {
        $city = City::with('state')
            ->where('id', $id)
            ->where('status', 1)
            ->first();

        if (!$city) {
            abort(404);
        }

        $data['city'] = $city;
        $data['states'] = State::where('country_id', $city->state->country_id)
            ->where('status', 1)
            ->get();

        $data['countries'] = Country::where('status', 1)
            ->orderBy('country_name', 'ASC')
            ->get();

        $data['id'] = $id;

        return $data;
    }

    public static function updateCity(CityValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $city = City::where('id', $id)->where('status', 1)->first();

        if (!$city) {
            abort(404);
        }

        unset($validated['country_id']);

        $city->update($validated);

        return [
            'success' => true,
            'message' => 'City Updated successfully',
        ];
    }

    public static function deleteCity($id)
    {
        $city = City::findOrFail($id);

        $city->status = 2;
        $city->update();

        return [
            'success' => true,
            'message' => 'City deleted successfully',
        ];
    }

    public static function getStatesByCountry(Request $request)
    {
        if ($request->filled('country_id')) {
            $states = State::where('country_id', $request->country_id)
                ->where('status', 1)
                ->get();

            return ['status' => 'success', 'states' => $states];
        }

        return ['status' => 'error', 'states' => []];
    }

    public static function getCitiesByState(Request $request)
    {
        if ($request->filled('state_id')) {
            $cities = City::where('state_id', $request->state_id)
                ->where('status', 1)
                ->get();

            return ['status' => 'success', 'cities' => $cities];
        }

        return ['status' => 'error', 'cities' => []];
    }
}
