<?php
namespace App\Services\Admin;

use App\Models\Book;
use App\Models\Bundle;
use App\Models\BookBundle;
use App\Library\CacheHelper;
use App\Library\ImageFunctions;
use App\Library\CommonFunctions;
use App\Http\Requests\BookBundleValidationRequest;

class BookBundleCrudService
{
    // public static $author;
    
    public static function listBookBundles()
    {

        $bookBundles = Bundle::filter(request(['search']))->with('books')->where('status', 1)->paginate(20);
        $data['bookBundles'] = $bookBundles;
        return $data;
    }

    public static function createBookBundle()
    {
        // Get active books
        $data['books'] = Book::select('id', 'title')
            ->where('status', 1)
            ->get();
        $oldBooks = request()->old('book_id', []);
        $data['bookIDs'] = $oldBooks;

        return $data;
    }

    public static function editBookBundle($id)
    {
        $bookBundle = Bundle::with('books')->where('id', $id)->where('status', 1)->firstOrFail();
        $data['bookBundle'] = $bookBundle;
        $data['books'] = Book::select('id', 'title')
        ->where('status', 1)
        ->get();
        $oldBooks = request()->old('book_id', $bookBundle->books->pluck('id')->toArray());
        $data['bookIDs'] = $oldBooks;

        return $data;
    }
    public static function storeBookBundle(BookBundleValidationRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image_path')) {
            // $validated['image_path'] = CommonFunctions::imageUpload($request->file('image_path'), 'media/uploads/book-bundles');
            $imagePaths = ImageFunctions::uploadAndResize(
                $request->file('image_path'),
                'media/uploads/book-bundles',
                [
                    'small' => ['width' => 909],
                    'thumb' => ['width' => 287],
                ]
            );

            $validated['image_path']       = $imagePaths['original'] ?? null;
            $validated['image_sm_path']    = $imagePaths['small'] ?? null;
            $validated['image_thumb_path'] = $imagePaths['thumb'] ?? null;
        }

        unset( $validated['book_id'], ); 

        // Create book bundle
        $bookBundle = Bundle::create($validated);

        if ($bookBundle) {
            if (!empty($request->book_id)) {
                // Normalize to an array
                $bookIds = is_array($request->book_id) ? $request->book_id : [$request->book_id];

                foreach ($bookIds as $bookId) {
                    BookBundle::create([
                        'book_id' => $bookId,
                        'bundle_id' => $bookBundle->id,
                    ]);
                }
            }
        }

        // Prepare data to return
        $data['bookBundle'] = $bookBundle;
        $data['message'] = 'Book Bundle added successfully';
        CacheHelper::forget('home_bundles');
        return $data;
    }
    public static function updateBookBundle(BookBundleValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $bookBundle = Bundle::with('books')->where('id', $id)->where('status', 1)->first();
        if (!$bookBundle) {
            abort(404);
        }

        // Handle image upload
        if ($request->hasFile('image_path')) {
            // $validated['image_path'] = CommonFunctions::imageUpload($request->file('image_path'), 'media/uploads/book-bundles');
            $imagePaths = ImageFunctions::uploadAndResize(
                $request->file('image_path'),
                'media/uploads/book-bundles',
                [
                    'small' => ['width' => 909],
                    'thumb' => ['width' => 287],
                ]
            );

            $validated['image_path'] = $imagePaths['original'] ?? null;
            $validated['image_sm_path'] = $imagePaths['small'] ?? null;
            $validated['image_thumb_path'] = $imagePaths['thumb'] ?? null;

        } else {
            $validated['image_path'] = $request->input('old_image_path');
            $validated['image_sm_path'] = $request->input('old_image_path');
            $validated['image_thumb_path'] = $request->input('old_image_path');
        }

        unset( $validated['book_id'], );

        // Update book bundle
        $bookBundle->update($validated);

        if($bookBundle){
            // Update books
            BookBundle::where('bundle_id', $bookBundle->id)->delete();
            if (!empty($request->book_id)) {
                $bookIds = is_array($request->book_id) ? $request->book_id : [$request->book_id];
                foreach ($bookIds as $bookId) {
                    BookBundle::create([
                        'book_id' => $bookId,
                        'bundle_id' => $bookBundle->id,
                    ]);
                }
            }
        }

        // Prepare data to return
        $data['bookBundle'] = $bookBundle;
        $data['message'] = 'Book Bundle updated successfully';
        CacheHelper::forget('home_bundles');
        return $data;
    }
    public static function deleteBookBundle($id)
    {
        $delete = Bundle::findOrFail($id);
        $delete->status = 2; // Assuming 2 means deleted or inactive
        $delete->update();

        $data['message'] = 'Book Bundle deleted successfully';
        CacheHelper::forget('home_bundles');
        return $data;
    }
}