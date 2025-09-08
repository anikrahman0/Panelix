<?php
namespace App\Services\Admin;


use App\Models\Author;
use App\Library\CacheHelper;
use Illuminate\Http\Request;
use App\Library\CommonFunctions;
use App\Http\Requests\AuthorValidationRequest;

class AuthorCrudService
{
    public static $author, $data = array();

    public static function listAuthor()
    {
        $data['authors'] = Author::filter(request(['search']))->where('status', 1)->orderBy('position', 'asc')->paginate(40);

        return $data;
    }
    public static function createAuthor()
    {
        $data = [];

        return $data;
    }
    public static function editAuthor($id)
    {
       $author = Author::where('id', $id)->where('status', 1)->first();
        if (!$author) {
            abort(404);
        }
        $data['author'] = $author;

        return $data;
    }

    public static function storeAuthor(AuthorValidationRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = CommonFunctions::imageUpload($request->file('image_path'), 'media/uploads/authors');
        }

        // Create author
        $author = Author::create($validated);

        // Prepare data to return
        $data['author'] = $author;
        $data['message'] = 'Author added successfully';
        self::authorCacheRemove();
        return $data;
    }
    
    public static function updateAuthor(AuthorValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $author = Author::where('id', $id)->where('status', 1)->first();
        if (!$author) {
            abort(404);
        }

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = CommonFunctions::imageUpload(
                $request->file('image_path'),
                'media/uploads/authors'
            );
        }

        // Update author
        $author->update($validated);

        // Prepare return data
        $data['author'] = $author;
        $data['message'] = 'Author updated successfully';
        self::authorCacheRemove();
        return $data;
    }
    public static function deleteAuthor($id)
    {
        $author = Author::findOrFail($id);
        $author->update([
            'status' => 2
        ]);
        $data['author'] = $author;
        $data['message'] = 'Author deleted successfully';
        self::authorCacheRemove();
        return $data;
    }

    public static function getAuthors(Request $request)
    {
        $term = $request->input('term', '');

        $authors = Author::where('status', 1)
            ->where('name', 'like', '%' . $term . '%')
            ->orWhere('en_name', 'like', '%' . $term . '%')
            ->get(['id', 'name', 'en_name']);

        $data['results'] = $authors->map(function ($author) {
            return [
                'id' => $author->id,
                'text' => $author->name,
            ];
        });

        return $data;
    }

    public static function sortAuthors(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Author::where('id', $id)->update([
                'position' => $index + 1
            ]);
        }

        return ['success' => true];
    }

    public static function authorCacheRemove(){
        CacheHelper::forget('home_authors');
        CacheHelper::forget('nav_authors');
        CacheHelper::forget('author_page_categories');
        CacheHelper::forget('category_page_authors');
        CacheHelper::forget('search_result_authors');
        CacheHelper::forget('bundle_details_authors');
    } 
}
