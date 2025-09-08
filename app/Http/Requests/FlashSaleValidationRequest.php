<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlashSaleValidationRequest extends FormRequest
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
            'book_id' => 'required|array',
            'book_id.*' => 'integer|exists:books,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'offer_amount' => 'required|integer',
            'end_time' => 'required|date|date_format:Y-m-d',
            'offer_type' => 'required|in:1,2',
            'status' => 'required|integer',
        ];
    }
}
