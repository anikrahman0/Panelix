<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponValidationRequest extends FormRequest
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
        // dd(request()->all());
        $orderFromAmountRule = [];
        $usageLimitRule = [];
        $freeShippingRule = [];

        if(request()->order_from_amount){
            $orderFromAmountRule = [
                'required',
                'numeric',
                'min:0',
            ];
        }
        if(request()->coupon_usage == 1){
            $usageLimitRule = [
                'required',
                'integer',
            ];
        }
        if(request()->coupon_type == 3){
            $freeShippingRule = [
                'required',
                'numeric',
                'min:0',
            ];
        }
        return [
            'order_from_amount' => $orderFromAmountRule,
            'coupon_code' => 'required|string|max:255',
            'coupon_usage' => 'required|integer',
            'coupon_type' => 'required|integer',
            'apply_for' => 'required_if:coupon_type,1,2|integer',
            'amount' => 'required_if:coupon_type,1,2|numeric',
            'max_amount' => 'nullable|numeric',
            'free_shipping_min' => $freeShippingRule,
            'usage_limit' => $usageLimitRule,
            'start_date' => 'required|date',
            'expire_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|integer',
        ];
    }
    public function messages()
   {
       return [
           'apply_for.required_unless' => 'The apply for field is required.',
           'amount.required_unless' => 'The amount field is required.',
           'order_from_amount.required' => 'The amount field is required.',
       ];
   }
}
