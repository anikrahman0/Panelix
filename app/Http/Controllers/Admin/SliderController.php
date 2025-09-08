<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\SliderCrudService;
use App\Http\Requests\SliderValidationRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = SliderCrudService::listSlider();
        return view('layouts.admin.dashboard.sliders.index', $sliders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = SliderCrudService::createSlider();
        return view('layouts.admin.dashboard.sliders.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderValidationRequest $request)
    {
        $data = SliderCrudService::storeSlider($request);
    
        return to_route('admin.sliders.index')->with('success', $data['message']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SliderCrudService::editSlider($id);
        return view('layouts.admin.dashboard.sliders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderValidationRequest $request, $id)
    {
        $data = SliderCrudService::updateSlider($request, $id);
        return to_route('admin.sliders.index')->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = SliderCrudService::deleteSlider($id);
        // Use the returned data (e.g., success message, deleted slider)
        return back()->with('success', $data['message']);
    }
}
