<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentValidationRequest extends FormRequest
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

        $id = $this->route('id'); // Payment ID

        // Common slug rule
        $slugRule = [
            'nullable',
            'string',
            'max:200',
            
        ];
       
        // Handle update case for slug
        if (!empty($id)) {
            $slugRule[] = Rule::unique('payments', 'method_slug')->ignore($id, 'id');
        }else{
            $slugRule[] = Rule::unique('payments', 'method_slug');
        }

        $keyNameRule = [];
        $keyValueRule = [];

        $keyNameRule = [
            'required',
            'string',
            'max:200',
        ];

        $keyValueRule = [
            'required',
            'string',
            'max:200'
        ];
        // Only process key_name and key_value if key_name is provided
        // if (!empty(request()->key_name)) {
        //     foreach (request()->key_name as $index => $keyName) {
        //         // Get corresponding method_detail_id for the key_name (use the same index)
        //         $methodDetailId = request()->method_detail_id[$index] ?? null;

        //         $keyNameRule["key_name.$index"] = [
        //             'required',
        //             'string',
        //             'max:200',
        //             Rule::unique('payment_details', 'key_name')
        //                 ->ignore($methodDetailId, 'id')
        //         ];

        //         $keyValueRule["key_value.$index"] = [
        //             'required',
        //             'string',
        //             'max:200'
        //         ];
        //     }
        // }

        return [
            'method_name' => 'required|string|max:200',
            'method_slug' => $slugRule,
            'status' => 'required|in:1,2',
            'key_name.*' => $keyNameRule,
            'key_value.*' => $keyValueRule
        ];
    }



    public function messages()
    {
        return [
            'key_name.*.required' => 'The key name is required.',
            'key_name.*.string' => 'The key name must be a valid string.',
            'key_name.*.max' => 'The key name may not be greater than 200 characters.',
            
            'key_value.*.required' => 'The key value is required.',
            'key_value.*.string' => 'The key value must be a valid string.',
            'key_value.*.max' => 'The key value may not be greater than 200 characters.',
        ];
    }

}
