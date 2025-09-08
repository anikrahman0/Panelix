<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookBundleValidationRequest extends FormRequest
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
        // dd($this->all());
        $id = $this->route('id');
        if (!empty($id)) {
            // Update
            $imageRule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        } else {
            // Insert
            $imageRule = 'required|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        }
        return [
            'title' => 'nullable|string|max:255',
            'book_id' => 'required|array',
            'book_id.*' => 'integer|exists:books,id',
            'url' => 'nullable|string|max:255',
            'image_path' => $imageRule,
            'status' => 'required|integer',
        ];
    }
}
