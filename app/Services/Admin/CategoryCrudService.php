<?php
namespace App\Services\Admin;


use App\Models\Category;
use App\Library\CacheHelper;
use Illuminate\Http\Request;
use App\Library\CommonFunctions;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CategoryValidationRequest;

class CategoryCrudService
{
    public static $category, $data = array();

    public static function listCategory()
    {
        // For the dropdown (show all categories regardless of selected one)
        $data['all_categories'] = Category::where('parent_id', 0)
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();

        // For the paginated list (with filters applied)
        $data['categories'] = Category::filter(request(['filter_category']))
            ->where('parent_id', 0)
            ->where('status', 1)
            ->orderBy('position', 'ASC')
            ->paginate(20);

        Session::put('category_page_session', request()->query('page', 1));

        return $data;
    }
    public static function createCategory()
    {
        $data['categories'] = Category::select('id', 'title', 'parent_id')
        ->where('status', 1)
        ->orderBy('id', 'ASC')
        ->get();

        return $data;
    }
    
    public static function editCategory($id)
    {
        $category = Category::where('id', $id)->where('status', 1)->first();

        if (!$category) {
            abort(404);
        }

        $data['category'] = $category;
        $data['categories'] = Category::select('id', 'title', 'parent_id')
            ->where('id', '!=', $id)
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();
        $data['id'] = $id;

        return $data;
    }

    public static function storeCategory(CategoryValidationRequest $request)
    {
        $validated = $request->validated();

        // Generate unique slug
        $modelName = 'App\Models\Category';
        $slugColumn = 'slug';
        $slugSource = !empty($validated['slug']) ? $validated['slug'] : $validated['title'];
        $validated['slug'] = CommonFunctions::generate_unique_slug($slugSource, $modelName, $slugColumn);

        // Handle image upload
        if ($request->hasFile('img')) {
            $validated['img'] = CommonFunctions::imageUpload($request->file('img'), 'media/uploads/category');
        }

        // Create category
        $category = Category::create($validated);

        // Store in $data
        $data['category'] = $category;
        $data['message'] = 'Category added successfully';
        self::categoryCacheRemove();
        return $data;
    }

    public static function updateCategory(CategoryValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $category = Category::where('id', $id)->where('status', 1)->first();
        if (!$category) {
            abort(404);
        }

        $modelName = Category::class;
        $slugColumn = 'slug';
        $idColumnName = 'id';

        $slugSource = $validated['slug'] ?? $validated['title'];
        $validated['slug'] = CommonFunctions::generate_unique_slug_update($id, $idColumnName, $slugSource, $modelName, $slugColumn);

        // Image upload (optional)
        if ($request->hasFile('img')) {
            $validated['img'] = CommonFunctions::imageUpload($request->file('img'), 'media/uploads/category');
        }

        // Update category
        $category->update($validated);

        // Store result in static $data array
        $data['category'] = $category;
        $data['page'] = Session::pull('category_page_session', 1);
        $data['message'] = 'Category updated successfully';
        self::categoryCacheRemove();
        return $data;
    }

    public static function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'status' => 2
        ]);

        $data['message'] = 'Category deleted successfully';
        self::categoryCacheRemove();
        return $data;
    }

    public static function listSubCategory()
    {
        $data['all_subcategories'] = Category::where('parent_id', '!=', 0)
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();
        
        $data['subcategories'] = Category::filter(request(['filter_category']))
        ->with('parent.parent.parent')
        ->where('parent_id', '!=', 0)
        ->where('status', 1)
        ->orderBy('id', 'ASC')
        ->paginate(20);

        Session::put('subcat_page_session', request()->query('page', 1));

        return $data;
    }

    public static function createSubCategory()
    {
        $data['subcategories'] = Category::select('id', 'title', 'parent_id')
        ->with('parent.parent.parent')
        ->where('status', 1)
        ->orderBy('id', 'ASC')
        ->get();

        return $data;
    }

    public static function storeSubCategory(CategoryValidationRequest $request)
    {
        $validated = $request->validated();

        // Generate unique slug
        $modelName = 'App\Models\Category';
        $slugColumn = 'slug';
        $slugSource = !empty($validated['slug']) ? $validated['slug'] : $validated['title'];
        $validated['slug'] = CommonFunctions::generate_unique_slug($slugSource, $modelName, $slugColumn);

        // Handle image upload
        if ($request->hasFile('img')) {
            $validated['img'] = CommonFunctions::imageUpload($request->file('img'), 'media/uploads/category');
        }

        // Create subcategory
        $subcategory = Category::create($validated);

        // Store in $data
        $data['subcategory'] = $subcategory;
        $data['message'] = 'Subcategory added successfully';
        self::categoryCacheRemove();
        return $data;
    }

    public static function editSubCategory($id)
    {
        $subcategory = Category::where('id', $id)->with('parent.parent.parent')->where('status', 1)->first();

        if (!$subcategory) {
            abort(404);
        }

        $data['subcategory'] = $subcategory;
        $data['categories'] = Category::select('id', 'title', 'parent_id')
            ->where('parent_id', 0)
            ->where('id', '!=', $id)
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();
        $data['id'] = $id;

        return $data;
    }

    public static function updateSubCategory(CategoryValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $subcategory = Category::where('id', $id)->with('parent.parent.parent')->where('status', 1)->first();
        if (!$subcategory) {
            abort(404);
        }

        $modelName = Category::class;
        $slugColumn = 'slug';
        $idColumnName = 'id';

        $slugSource = $validated['slug'] ?? $validated['title'];
        $validated['slug'] = CommonFunctions::generate_unique_slug_update($id, $idColumnName, $slugSource, $modelName, $slugColumn);

        // Image upload (optional)
        if ($request->hasFile('img')) {
            $validated['img'] = CommonFunctions::imageUpload($request->file('img'), 'media/uploads/category');
        }

        // Update subcategory
        $subcategory->update($validated);

        // Store result in static $data array
        $data['subcategory'] = $subcategory;
        $data['page'] = Session::pull('subcat_page_session', 1);
        $data['message'] = 'Subcategory updated successfully';
        self::categoryCacheRemove();
        return $data;
    }

    public static function getCategory(Request $request)
    {
        $data['categories'] = Category::where('status', 1)
            ->where('title', 'like', '%' . $request->input('term', '') . '%')
            ->where('parent_id', 0) // Assuming you want only top-level categories
            ->get(['id as id', 'title as text']);
        return $data;
    }

    public static function sortCategory(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Category::where('id', $id)->update([
                'position' => $index + 1
            ]);
        }

        return ['success' => true];
    }

    public static function categoryCacheRemove()
    {
        CacheHelper::forget('home_category_books');
        CacheHelper::forget('home_latest_categories');
        CacheHelper::forget('nav_categories');
        CacheHelper::forget('search_result_categories');
        CacheHelper::forget('bundle_details_categories');
    }
}
