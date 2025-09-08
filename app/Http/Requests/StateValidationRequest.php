<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StateValidationRequest extends FormRequest
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

        $abbreviationRule = [
            'required',
            'string',
            'max:10',
            'regex:/^[a-zA-Z0-9\-]+$/',
        ];

        if (!empty($id)) {
            // update
            array_push($abbreviationRule,
                Rule::unique('states', 'abbreviation')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id, 'id')
            );
        }else{
            // insert
            array_push($abbreviationRule,
                Rule::unique('states', 'abbreviation')->where(function ($query) {
                    return $query->where('status', 1);
                })
            );
        }

        return [
            'name' => 'required|string|max:255',
            'abbreviation' => $abbreviationRule,
            'country_id' => 'required|integer'
        ];
    }
}
