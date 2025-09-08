<?php
namespace App\Services\Admin;


use App\Models\Publisher;
use App\Library\CacheHelper;
use Illuminate\Http\Request;
use App\Library\CommonFunctions;
use App\Http\Requests\PublisherValidationRequest;

class PublisherCrudService
{
    // public static $publisher, $data = array();

    public static function listPublisher()
    {
        $data['publishers'] = Publisher::filter(request(['search']))->where('status', 1)->latest()->paginate(20);

        return $data;
    }
    public static function createPublisher()
    {
        $data = [];

        return $data;
    }
    public static function editPublisher($id)
    {
       $publisher = Publisher::where('id', $id)->where('status', 1)->first();
        if (!$publisher) {
            abort(404);
        }
        $data['publisher'] = $publisher;

        return $data;
    }

    public static function storePublisher(PublisherValidationRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = CommonFunctions::imageUpload($request->file('image_path'), 'media/uploads/publishers');
        }

        // Create publisher
        $publisher = Publisher::create($validated);

        // Prepare data to return
        $data['publisher'] = $publisher;
        $data['message'] = 'Publisher added successfully';
        self::publisherCacheRemove();
        return $data;
    }

    public static function updatePublisher(PublisherValidationRequest $request, $id)
    {
        $validated = $request->validated();

        $publisher = Publisher::where('id', $id)->where('status', 1)->first();
        if (!$publisher) {
            abort(404);
        }

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = CommonFunctions::imageUpload(
                $request->file('image_path'),
                'media/uploads/publishers'
            );
        }

        // Update publisher
        $publisher->update($validated);

        // Prepare return data
        $data['publisher'] = $publisher;
        $data['message'] = 'Publisher updated successfully';
        self::publisherCacheRemove();
        return $data;
    }
    public static function deletePublisher($id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->update([
            'status' => 2
        ]);
        $data['publisher'] = $publisher;
        $data['message'] = 'Publisher deleted successfully';
        self::publisherCacheRemove();
        return $data;
    }

    public static function getPublishers(Request $request)
    {
        $term = $request->input('term', '');

        $publishers = Publisher::where('status', 1)
            ->where('title', 'like', '%' . $term . '%')
            ->get(['id', 'title']);

        $data['results'] = $publishers->map(function ($publisher) {
            return [
                'id' => $publisher->id,
                'text' => $publisher->title,
            ];
        });

        return $data;
    }
    public static function publisherCacheRemove()
    {
        CacheHelper::forget('author_page_publishers');
        CacheHelper::forget('category_page_publishers');
        CacheHelper::forget('search_result_publishers');
        CacheHelper::forget('bundle_details_publishers');
    }
}
