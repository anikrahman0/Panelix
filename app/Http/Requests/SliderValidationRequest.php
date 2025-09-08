<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd(request()->all());
        $id = $this->route('id');
        $imgItemRule = '';
        $imgRule = 'required|array';

        if (!empty($id)) {
            // Update
            $imgItemRule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
            $imgRule = 'nullable|array';
        }else{
            // Insert
            $imgItemRule = 'required|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        }
        // dd(request()->all());
        return [
            'title' => 'required|string|max:255',
            'slider_description' => 'nullable|string|max:1000',
            'slider_type' => 'required|integer',
            'slider_top_head' => 'nullable|array',
            'slider_top_head.*' => 'nullable|string|max:255',
            'slider_sub_head' => 'nullable|array',
            'slider_sub_head.*' => 'nullable|string|max:255',
            'url' => 'nullable|array',
            'url.*' => 'nullable|url|max:255',
            'position' => 'required|array',
            'position.*' => 'required|integer',
            'img_bg' => $imgRule,
            'img_bg.*' => $imgItemRule,
            'status' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'url.array' => 'The url should be an array.',
            'slider_top_head.max' => 'The slider top head should not be more than 255 characters.',
            'slider_top_head.array' => 'The slider top head should be an array.',
            'slider_top_head.*.string' => 'The slider top head should be a string.',
            'slider_sub_head.max' => 'The slider sub head should not be more than 255 characters.',
            'slider_sub_head.array' => 'The slider sub head should be an array.',
            'slider_sub_head.*.string' => 'The slider sub head should be a string.',
            'img_bg.required' => 'The image field is required.',
            'img_bg.array' => 'The image should be an array.',
            'img_bg.*.image' => 'The image field must be an image.',
            'img_bg.*.mimes' => 'The image must be type of jpg, jpeg, png, gif, webp, svg.',
            'img_bg.*.max' => 'The image size cannot be greater than 2MB.',
        ];
    }
}
