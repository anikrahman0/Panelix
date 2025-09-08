<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\LocationCrudService;
use App\Http\Requests\CityValidationRequest;
use App\Http\Requests\StateValidationRequest;
use App\Http\Requests\CountryValidationRequest;

class LocationController extends Controller {
    public function countries()
    {
        $data = LocationCrudService::listCountry();
        return view('layouts.admin.dashboard.location.countries.index', $data);
    }

    public function addCountry(){
        return view('layouts.admin.dashboard.location.countries.add');
    }

    public function storeCountry(CountryValidationRequest $request)
    {
        $data = LocationCrudService::storeCountry($request);

        return to_route('admin.countries.index')->with('success', $data['message']);
    }

    public function editCountry($id)
    {
        $data = LocationCrudService::editCountry($id);

        return view('layouts.admin.dashboard.location.countries.edit', $data);
    }

    public function updateCountry(CountryValidationRequest $request, $id)
    {
        $data = LocationCrudService::updateCountry($request, $id);

        return to_route('admin.countries.index')->with('success', $data['message']);
    }

    public function deleteCountry($id)
    {
        $data = LocationCrudService::deleteCountry($id);

        return back()->with('success', $data['message']);
    }

    public function states()
    {
        $data = LocationCrudService::listStates();

        return view('layouts.admin.dashboard.location.states.index', $data);
    }

    public function addState()
    {
        $data = LocationCrudService::addState();

        return view('layouts.admin.dashboard.location.states.add', $data);
    }

    public function storeState(StateValidationRequest $request)
    {
        $data = LocationCrudService::storeState($request);

        return to_route('admin.states.index')->with('success', $data['message']);
    }

    public function editState($id)
    {
        $data = LocationCrudService::editState($id);

        return view('layouts.admin.dashboard.location.states.edit', $data);
    }

    public function updateState(StateValidationRequest $request, $id)
    {
        $data = LocationCrudService::updateState($request, $id);

        return to_route('admin.states.index')->with('success', $data['message']);
    }

    public function deleteState($id)
    {
        $data = LocationCrudService::deleteState($id);

        return back()->with('success', $data['message']);
    }

    public function cities()
    {
        $data = LocationCrudService::listCities();

        return view('layouts.admin.dashboard.location.cities.index', $data);
    }

    public function addCity()
    {
        $data = LocationCrudService::addCity();

        return view('layouts.admin.dashboard.location.cities.add', $data);
    }

    public function storeCity(CityValidationRequest $request)
    {
        $data = LocationCrudService::storeCity($request);

        return to_route('admin.cities.index')->with('success', $data['message']);
    }

    public function editCity($id)
    {
        $data = LocationCrudService::editCity($id);

        return view('layouts.admin.dashboard.location.cities.edit', $data);
    }

    public function updateCity(CityValidationRequest $request, $id)
    {
        $data = LocationCrudService::updateCity($request, $id);

        return to_route('admin.cities.index')->with('success', $data['message']);
    }

    public function deleteCity($id)
    {
        $data = LocationCrudService::deleteCity($id);

        return back()->with('success', $data['message']);
    }

    public function getStatesAjax(Request $request)
    {
        $data = LocationCrudService::getStatesByCountry($request);
        return response()->json($data);
    }

    public function getCitiesAjax(Request $request)
    {
        $data = LocationCrudService::getCitiesByState($request);
        return response()->json($data);
    }
}
