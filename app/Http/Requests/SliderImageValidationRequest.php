<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderImageValidationRequest extends FormRequest
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
        $id = $this->route('id');
        $categoryRule = [];
        $productRule = [];
        $urlRule = [];

        if(request()->cat_id){
            $categoryRule = [
                'required',
                'integer',
            ];
        }
        if(request()->product_id){
            $productRule = [
                'required',
                'integer',
            ];
        }
        if(request()->url){
            $urlRule = [
                'required',
                'url',
                'max:255',
            ];
        }
        if (!empty($id)) {
            // update
            $imgRule='nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        } else {
            // insert
            $imgRule='required|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        }
        return [
            'title' => 'required|string|max:255',
            'slider_description' => 'nullable|string|max:1000',
            'slider_type' => 'required|integer',
            'slider_id' => 'required|integer',
            'cat_id' => $categoryRule,
            // 'subcat_id' => 'required|integer',
            'product_id' => $productRule,
            'link_type' => 'required|in:1,2,3,4',
            'slider_top_head' => 'nullable|string|max:255',
            'slider_sub_head' => 'nullable|string|max:255',
            'url' => $urlRule,
            'position' => 'required|numeric|min:0',
            'img_bg' => $imgRule,
            'img_sm' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'status' => 'required|integer',
        ];
    }
}
