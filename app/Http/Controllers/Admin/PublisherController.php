<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PublisherCrudService;
use App\Http\Requests\PublisherValidationRequest;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = PublisherCrudService::listPublisher();

        return view('layouts.admin.dashboard.publisher.index', $publishers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = PublisherCrudService::createPublisher();

        return view('layouts.admin.dashboard.publisher.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublisherValidationRequest $request)
    {
        $data = PublisherCrudService::storePublisher($request);

        return to_route('admin.publisher.index')->with('success', $data['message']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $publisher = PublisherCrudService::editPublisher($id);
        return view('layouts.admin.dashboard.publisher.edit', $publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherValidationRequest $request, $id)
    {
        $data = PublisherCrudService::updatePublisher($request, $id);

        return to_route('admin.publisher.index')->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = PublisherCrudService::deletePublisher($id);

        return back()->with('success', $data['message']);
    }

    public function get(Request $request)
    {
        $data = PublisherCrudService::getPublishers($request);

        return response()->json($data);
    }

}
