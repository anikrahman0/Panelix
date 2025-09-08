<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // or add authorization logic if needed
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string|min:8|max:50',
            'new_password' => 'required|string|min:8|different:current_password',
            'confirm_password' => 'required|string|same:new_password',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.different' => 'New password must be different from the current password.',
            'confirm_password.same' => 'Confirm password must match with the new password.',
        ];
    }
}
