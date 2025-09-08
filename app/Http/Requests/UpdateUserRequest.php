<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or implement your own authorization logic
    }

    public function rules(): array
    {
        $userId = Auth::id();

        return [
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:15|unique:users,phone,' . $userId . ',id',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip_code' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:200',
        ];
    }
}
