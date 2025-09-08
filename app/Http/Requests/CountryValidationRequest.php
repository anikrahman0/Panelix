<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryValidationRequest extends FormRequest
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

        $countryCodeRule = [
            'required',
            'string',
            'max:10',
            'regex:/^[a-zA-Z0-9\-]+$/',
        ];

        $phoneCodeRule = [
            'nullable',
            'string',
            'max:10',
        ];
        $countryFlagRule = '';

        if (!empty($id)) {
            // update
            array_push($countryCodeRule,
                Rule::unique('countries', 'country_code')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id, 'id')
            );
            array_push($phoneCodeRule,
                Rule::unique('countries', 'phone_code')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id, 'id')
            );
            $countryFlagRule = 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        }else{
            // insert
            array_push($countryCodeRule,
                Rule::unique('countries', 'country_code')->where(function ($query) {
                    return $query->where('status', 1);
                })
            );
            array_push($phoneCodeRule,
                Rule::unique('countries', 'phone_code')->where(function ($query) {
                    return $query->where('status', 1);
                })
            );
            $countryFlagRule = 'required|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048';
        }

        return [
            'country_name' => 'required|string|max:255',
            'country_code' => $countryCodeRule,
            'phone_code' => $phoneCodeRule,
            'language' => 'nullable|string|max:100',
            'language_code' => 'nullable|string|max:10',
            'country_flag' => $countryFlagRule,
        ];
    }
}
