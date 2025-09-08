<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AuthorCrudService;
use App\Http\Requests\AuthorValidationRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = AuthorCrudService::listAuthor();

        return view('layouts.admin.dashboard.authors.index', $authors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = AuthorCrudService::createAuthor();

        return view('layouts.admin.dashboard.authors.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorValidationRequest $request)
    {
        $data = AuthorCrudService::storeAuthor($request);

        return to_route('admin.author.index')->with('success', $data['message']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $author = AuthorCrudService::editAuthor($id);
        return view('layouts.admin.dashboard.authors.edit', $author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorValidationRequest $request, $id)
    {
        $data = AuthorCrudService::updateAuthor($request, $id);

        return to_route('admin.author.index')->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = AuthorCrudService::deleteAuthor($id);

        return back()->with('success', $data['message']);
    }

    public function get(Request $request)
    {
        $data = AuthorCrudService::getAuthors($request);

        return response()->json($data);
    }
    public function sort(Request $request)
    {
        $data = AuthorCrudService::sortAuthors($request);

        return response()->json($data);
    }

}
