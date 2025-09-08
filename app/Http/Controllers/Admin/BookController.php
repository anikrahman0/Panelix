<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\BooksCrudService;
use App\Http\Requests\BooksValidationRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = BooksCrudService::listBooks();
        return view('layouts.admin.dashboard.books.index', $books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = BooksCrudService::createBook();
        return view('layouts.admin.dashboard.books.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BooksValidationRequest $request)
    {
        $data = BooksCrudService::storeBook($request);
        return to_route('admin.books.index')->with('success', $data['message']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = BooksCrudService::editBook($id);
        return view('layouts.admin.dashboard.books.edit', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BooksValidationRequest $request, $id)
    {
        $data = BooksCrudService::updateBook($request, $id);
        return redirect()->route('admin.books.index')->with('success', $data['message']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = BooksCrudService::deleteBook($id);
        return back()->with('success', $data['message']);
    }

    public function get(Request $request)
    {
        $data = BooksCrudService::getBooks($request);

        return response()->json($data);
    }
}
