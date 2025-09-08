<?php
namespace App\Services\Admin;

use App\Models\Slider;
use App\Models\SliderImage;
use App\Library\CacheHelper;
use App\Library\CommonFunctions;
use App\Http\Requests\SliderValidationRequest;


class SliderCrudService
{
    public static $slider, $data = array();

    public static function listSlider()
    {
        $data['sliders'] = Slider::all();

        return $data;
    }
    public static function createSlider()
    {
        $data['oldSliderImages'] = [];
        $data['oldUrl'] = [];
        return $data;
    }

    public static function editSlider($id)
    {
        // Fetch slider with images
        $slider = Slider::with('images')->where('id', $id)->where('status', 1)->first();

        if (!$slider) {
            abort(404);
        }

        // Fetch images ordered by position
        $images = $slider->images()->orderBy('position', 'asc')->get();

        // Prepare data array
        $data = [
            'slider' => $slider,
            'images' => $images,
            'oldSliderImages' => request()->old('img_bg', []),
            'oldUrl' => old('url', []),
        ];

        return $data;
    }

    public static function storeSlider(SliderValidationRequest $request)
    {
        $validated = $request->validated();

        // Create slider
        $slider = Slider::create([
            'title' => $validated['title'],
            'slider_description' => $validated['slider_description'],
            'slider_type' => $validated['slider_type'],
            'status' => $validated['status'],
        ]);

        $images = $request->file('img_bg');
        $sliderImages = [];

        if (!empty($images)) {
            if (!is_array($images)) {
                $images = [$images];
            }

            foreach ($images as $key => $image) {
                $imagename = CommonFunctions::imageUpload($image, 'media/uploads/sliders');
                $sliderImages[] = [
                    'slider_id' => $slider->id,
                    'img_bg' => $imagename,
                    'url' => $validated['url'][$key] ?? null,
                    'slider_top_head' => $validated['slider_top_head'][$key] ?? '',
                    'slider_sub_head' => $validated['slider_sub_head'][$key] ?? '',
                    'position' => $validated['position'][$key] ?? ($key + 1),
                    'status' => $validated['status'],
                ];
            }

            SliderImage::insert($sliderImages);
        }

        // Store in static::$data
        $data['slider'] = $slider;
        $data['sliderImages'] = $sliderImages;
        $data['message'] = 'Slider added successfully.';

        CacheHelper::forget('home_sliders');
        return $data;
    }

    public static function updateSlider(SliderValidationRequest $request, $id)
    {
        $slider = Slider::with('images')->where('id', $id)->where('status', 1)->firstOrFail();

        $validated = $request->validated();

        // Update slider info
        $slider->update([
            'title' => $validated['title'],
            'slider_description' => $validated['slider_description'],
            'slider_type' => $validated['slider_type'],
            'status' => $validated['status'],
        ]);

        // Process existing image IDs
        $requestedImageIds = array_filter($request->input('slider_image_id', []));
        $existingKeys = array_keys($requestedImageIds);
        $dbImageIds = $slider->images->pluck('id')->toArray();
        $idsToDelete = array_diff($dbImageIds, $requestedImageIds);

        // Delete removed images
        if (!empty($idsToDelete)) {
            SliderImage::whereIn('id', $idsToDelete)->delete();
        }

        // Update existing images
        foreach ($requestedImageIds as $key => $imageId) {
            $sliderImage = SliderImage::find($imageId);
            if (!$sliderImage) continue;

            $imageFile = $request->file("img_bg.$key");

            $data = [
                'url' => array_key_exists($key, $validated['url']) ? $validated['url'][$key] : null,
                'slider_top_head' => array_key_exists($key, $validated['slider_top_head']) ? $validated['slider_top_head'][$key] : null,
                'slider_sub_head' => array_key_exists($key, $validated['slider_sub_head']) ? $validated['slider_sub_head'][$key] : null,
                'position' => array_key_exists($key, $validated['position']) ? $validated['position'][$key] : $sliderImage->position,
                'status' => $validated['status'],
            ];

            if ($imageFile) {
                $data['img_bg'] = CommonFunctions::imageUpload($imageFile, 'media/uploads/sliders');
            }

            $sliderImage->update($data);
        }

        // Add new images
        $newImages = $request->file('img_bg');
        if (!empty($newImages)) {
            foreach ($newImages as $key => $file) {
                if (in_array($key, $existingKeys)) continue;
                if (!$file) continue;

                SliderImage::create([
                    'slider_id' => $slider->id,
                    'img_bg' => CommonFunctions::imageUpload($file, 'media/uploads/sliders'),
                    'url' => $validated['url'][$key] ?? null,
                    'slider_top_head' => $validated['slider_top_head'][$key] ?? null,
                    'slider_sub_head' => $validated['slider_sub_head'][$key] ?? null,
                    'position' => $validated['position'][$key] ?? ($key + 1),
                    'status' => $validated['status'],
                ]);
            }
        }

        // Refresh the slider with latest images
        $slider->load('images');

        // Store return data
        $data['slider'] = $slider;
        $data['message'] = 'Slider updated successfully.';
        CacheHelper::forget('home_sliders');
        return $data;
    }

    public static function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update(['status' => 2]);

        $data['slider'] = $slider;
        $data['message'] = 'Slider deleted successfully';
        CacheHelper::forget('home_sliders');
        return $data;
    }
}
