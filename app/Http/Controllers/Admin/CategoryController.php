<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryCrudService;
use App\Http\Requests\CategoryValidationRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CategoryCrudService::listCategory();
        return view('layouts.admin.dashboard.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = CategoryCrudService::createCategory();
        return view('layouts.admin.dashboard.categories.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryValidationRequest $request)
    {
        $data = CategoryCrudService::storeCategory($request);
        return to_route('admin.categories.index')->with('success', $data['message']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = CategoryCrudService::editCategory($id);
        return view('layouts.admin.dashboard.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryValidationRequest $request, $id)
    {
        $data = CategoryCrudService::updateCategory($request, $id);

        return to_route('admin.categories.index', ['page' => $data['page']])
            ->with('success', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = CategoryCrudService::deleteCategory($id);

        return back()->with('success', $data['message']);
    }

    public function indexSubcategory()
    {
        $data = CategoryCrudService::listSubCategory();
        return view('layouts.admin.dashboard.categories.sub-categories.index', $data);
    }

    public function createSubcategory()
    {
        $data = CategoryCrudService::createSubCategory();
        return view('layouts.admin.dashboard.categories.sub-categories.add', $data);
    }

    public function editSubcategory($id)
    {
        $data = CategoryCrudService::editSubCategory($id);
        return view('layouts.admin.dashboard.categories.sub-categories.edit', $data);
    }

    public function storeSubcategory(CategoryValidationRequest $request)
    {
        $data = CategoryCrudService::storeSubCategory($request);
        return to_route('admin.subcategories.index')->with('success', $data['message']);
    }

    public function updateSubcategory(CategoryValidationRequest $request, $id)
    {
        $data = CategoryCrudService::updateSubCategory($request, $id);

        return to_route('admin.subcategories.index', ['page' => $data['page']])
            ->with('success', $data['message']);
    }

    public function getCategory(Request $request)
    {
        $data = CategoryCrudService::getCategory($request);
        return ['results' => $data['categories']];
    }

    public function sort(Request $request)
    {
        $data = CategoryCrudService::sortCategory($request);

        return response()->json($data);
    }
}
