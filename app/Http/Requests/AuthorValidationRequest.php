<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorValidationRequest extends FormRequest
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
        $emailRule = [
            'nullable',
            'email',
            'max:100',
        ];
        if (!empty($id)) {
            // update
            $emailRule[] = Rule::unique('authors', 'email')
                ->where(fn($query) => $query->where('status', 1))
                ->ignore($id, 'id');
        } else {
            $emailRule[] = Rule::unique('authors', 'email')
                ->where(fn($query) => $query->where('status', 1));
        }
        return [
            'name' => 'required|string|max:255',
            'en_name' => 'nullable|string|max:255',
            'email' => $emailRule,
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'bio' => 'nullable|string|max:1000',
            'social_link_fb' => 'nullable|string|max:255',
            'social_link_x' => 'nullable|string|max:255',
            'social_link_ig' => 'nullable|string|max:255',
            'position' => 'nullable|integer',
            'status' => 'required|integer',
        ];
    }
}
