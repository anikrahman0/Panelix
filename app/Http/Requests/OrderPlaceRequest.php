<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPlaceRequest extends FormRequest
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

        $rules = [
            'shipping_name' => 'required|string|max:100',
            'shipping_phone' => 'required|string|max:15',
            'shipping_email' => 'required|email|max:100',
            'shipping_state_id' => 'required|integer',
            'shipping_city_id' => 'required|integer',
            'shipping_zip_code' => 'nullable|string|max:15',
            'shipping_address' => 'required|string|max:200',
            'terms' => 'required|accepted',
            'payment' => 'required|in:cod,sslcommerz,aamarpay',
        ];
        return $rules;
    }
}
