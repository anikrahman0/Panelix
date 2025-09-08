<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserValidationRequest extends FormRequest
{
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
        switch ($this->input('user_type')) {
            case 1:
                return $this->adminUserRules();
            case 2:
                return $this->generalUserRules();
            default:
                return [];
        }
    }

    /**
     * Get validation rules for admin user.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    private function adminUserRules(): array
    {
        $id = $this->route('id');

        $emailRule = [
            'required',
            'email',
            'max:100',
        ];
        $roleRule =[];

        $phoneRule = [
            'nullable',
            'string',
            'max:20',
        ];

        if (!empty($id)) {
            // update
            $statusRule = 'required|in:1,2';
            $emailRule[] = Rule::unique('admin_users', 'email')
                ->where(fn($query) => $query->where('status', 1))
                ->ignore($id, 'id');

            $phoneRule[] = Rule::unique('admin_users', 'phone')
                ->where(fn($query) => $query->where('status', 1))
                ->ignore($id, 'id');

            $passwordRule = '';
            $confirmPassRule = '';
        } else {
            // insert
            $statusRule ='';
            $emailRule[] = Rule::unique('admin_users', 'email')
                ->where(fn($query) => $query->where('status', 1));

            $phoneRule[] = Rule::unique('admin_users', 'phone')
                ->where(fn($query) => $query->where('status', 1));

            $passwordRule = 'required|string|min:8|max:50';
            $confirmPassRule = 'same:password';
            $roleRule = 'required_if:user_type,1';
        }

        return [
            'status' => $statusRule,
            'user_type' => 'required|in:1',
            'is_super' => 'nullable|in:1,2',
            'role_id' => $roleRule,
            'country_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'gender' => 'required|in:1,2,3',
            'phone' => $phoneRule,
            'address' => 'nullable|string|max:255',
            'password' => $passwordRule,
            'password_confirmation' => $confirmPassRule,
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
        ];
    }

    /**
     * Get validation rules for general user.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    private function generalUserRules(): array
    {
        // Define the validation rules for general user
        $id = $this->route('id');

        $emailRule = [
            'required',
            'email',
            'max:100',
        ];

        $phoneRule = [
            'nullable',
            'string',
            'max:20',
        ];

        if (!empty($id)) {
            // update
            $statusRule = 'required|in:1,2';
            $emailRule[] = Rule::unique('users', 'email')
                ->where(fn($query) => $query->where('status', 1))
                ->ignore($id, 'id');

            $phoneRule[] = Rule::unique('users', 'phone')
                ->where(fn($query) => $query->where('status', 1))
                ->ignore($id, 'id');

            $passwordRule = '';
            $confirmPassRule = '';
        } else {
            // insert
            $statusRule = '';
            $emailRule[] = Rule::unique('users', 'email')
                ->where(fn($query) => $query->where('status', 1));

            $phoneRule[] = Rule::unique('users', 'phone')
                ->where(fn($query) => $query->where('status', 1));

            $passwordRule = 'required|string|min:8|max:50';
            $confirmPassRule = 'same:password';
        }

        return [
            'status' => $statusRule,
            'user_type' => 'required|in:2',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip' => 'nullable|string|max:10',
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'gender' => 'required|in:1,2,3',
            'phone' => $phoneRule,
            'address' => 'nullable|string|max:255',
            'password' => $passwordRule,
            'password_confirmation' => $confirmPassRule,
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
        ];
    }

}
