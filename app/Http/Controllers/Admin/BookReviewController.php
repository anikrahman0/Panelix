<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\BookReviewService;

class BookReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = BookReviewService::getAllReviewsPaginated();
        return view('layouts.admin.dashboard.rating-review.index', $reviews);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = BookReviewService::createReview();
        return view('layouts.admin.dashboard.rating-review.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        BookReviewService::storeReview($request->all());
        return redirect()->route('admin.review.index')->with('success', 'Review created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = BookReviewService::editReview($id);
        return view('layouts.admin.dashboard.rating-review.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        BookReviewService::updateReview($request->all(), $id);
        return redirect()->route('admin.review.index')->with('success', 'Review updated successfully.');
    }

    public function approve($id)
    {
        BookReviewService::approveReview($id);
        return back()->with('success', 'Review approved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        BookReviewService::deleteReview($id);
        return back()->with('success', 'Review deleted successfully.');
    }
}
