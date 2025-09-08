<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TagValidationRequest extends FormRequest
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
            'required',
            'string',
            'max:100',
        ];



        if (!empty($id)) {
            // update
            array_push($slugRule,
                Rule::unique('tags', 'slug')->where(function ($query) {
                    return $query->where('status', 1);
                })->ignore($id, 'id')
            );
        }else{
            // insert
            array_push($slugRule,
                Rule::unique('tags', 'slug')->where(function ($query) {
                    return $query->where('status', 1);
                })
            );
        }

        return [
            'name' => 'required|string|max:100',
            'slug' => $slugRule,
        ];
    }
}
