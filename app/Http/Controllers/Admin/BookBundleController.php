<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\BookBundleCrudService;
use App\Http\Requests\BookBundleValidationRequest;

class BookBundleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookBundles = BookBundleCrudService::listBookBundles();
        return view('layouts.admin.dashboard.book-bundles.index', $bookBundles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = BookBundleCrudService::createBookBundle();
        return view('layouts.admin.dashboard.book-bundles.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookBundleValidationRequest $request)
    {
        $data = BookBundleCrudService::storeBookBundle($request);
        return to_route('admin.book.bundles.index')->with('success', $data['message']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bookBundle = BookBundleCrudService::editBookBundle($id);
        return view('layouts.admin.dashboard.book-bundles.edit', $bookBundle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookBundleValidationRequest $request, $id)
    {
        $data = BookBundleCrudService::updateBookBundle($request, $id);
        return to_route('admin.book.bundles.index')->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BookBundleCrudService::deleteBookBundle($id);
        return back()->with('success', $data['message']);
    }
}
