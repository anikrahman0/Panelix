<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SocialIconValidationRequest extends FormRequest
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

        $nameRule = [
            'required',
            'string',
            'max:100',
            'regex:/^[a-zA-Z\-]+$/',
        ];

        $logoRule = '';

        if (!empty($id)) {
            // update
            array_push($nameRule,
                Rule::unique('social_platforms', 'name')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id, 'id')
            );
            $logoRule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        }else{
            // insert
            array_push($nameRule,
                Rule::unique('social_platforms', 'name')->where(function ($query) {
                    return $query->where('status', 1);
                })
            );
            $logoRule = 'required|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        }

        return [
            'name' => $nameRule,
            'logo' => $logoRule,
        ];
    }
}
