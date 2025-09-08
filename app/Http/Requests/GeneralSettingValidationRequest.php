<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingValidationRequest extends FormRequest
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
        return [
            'site_title' => 'nullable|string|max:255',
            'site_url' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:10000',
            'copyright_text' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'default_email' => 'nullable|email|max:100',
            'default_phone' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'fb_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'favicon' => 'nullable|mimes:jpg,jpeg,png,gif,webp,svg,ico|max:2048',
            'banner_image_first' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'banner_image_second' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            
            // 'logo_remove' => 'nullable',
            // 'fb_logo_remove' => 'nullable',
            // 'favicon_remove' => 'nullable',
            // 'banner_image_first_remove' => 'nullable',
            // 'banner_image_second_remove' => 'nullable',
            // 'banner_image_bottom' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            // 'default_currency' => 'required|integer',
            'notice' => 'nullable|string|max:10000',
            // 'status' => 'required|integer',
        ];
    }
}
