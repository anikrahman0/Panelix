<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryValidationRequest extends FormRequest
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
        $slugRule = [
            'nullable',
            'string',
            'max:255',
        ];
        if (!empty($id)) {
            // update
            array_push($slugRule,
                Rule::unique('categories', 'slug')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id, 'id')
            );
        } else {
            // insert
            array_push($slugRule,
                Rule::unique('categories', 'slug')->where(function ($query) {
                    return $query->where('status', 1);
                })
            );
        }
        return [
            'parent_id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'slug' => $slugRule,
            'img' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'short_desc' => 'nullable|string|max:1000',
            'status' => 'required|integer',
        ];
    }
    // public function messages()
    // {
    //     return [
    //     ];
    // }
}
