<?php
namespace App\Services\Admin;


use App\Models\Coupon;
use App\Http\Requests\CouponValidationRequest;

class CouponCrudService
{
    public static function listCoupon()
    {
        $data['coupons'] = Coupon::where('status', 1)->orderBy('id', 'DESC')->get();

        return $data;
    }
    public static function createCoupon()
    {
        $data['usages'] = [['id' => 1, 'title' => 'Multiple'], ['id' => 2, 'title' => 'Unlimited']];
        $data['couponTypes'] = [['id' => 1, 'title' => 'Amount (BDT)'], ['id' => 2, 'title' => 'Percentage (%)'], ['id' => 3, 'title' => 'Free Shipping']];
        $data['applyForTypes'] = [['id' => 1, 'title' => 'All Orders'], ['id' => 2, 'title' => 'Order Amount From']];

        return $data;
    }

    public static function editCoupon($id)
    {
        $data['coupon'] = Coupon::where('id', $id)->where('status', 1)->first();

        if (!$data['coupon']) {
            return null;
        }

        $data['usages'] = [
            ['id' => 1, 'title' => 'Multiple'],
            ['id' => 2, 'title' => 'Unlimited'],
        ];

        $data['couponTypes'] = [
            ['id' => 1, 'title' => 'Amount (BDT)'],
            ['id' => 2, 'title' => 'Percentage (%)'],
            ['id' => 3, 'title' => 'Free Shipping'],
        ];

        $data['applyForTypes'] = [
            ['id' => 1, 'title' => 'All Orders'],
            ['id' => 2, 'title' => 'Order Amount From'],
        ];

        return $data;
    }

    public static function storeCoupon(CouponValidationRequest $request)
    {
        $validated = $request->validated();
        if (empty($validated['usage_limit'])) {
            unset($validated['usage_limit']);
        }
        if (!empty($validated['free_shipping_min'])) {
            $validated['apply_for'] = 1;
        } else {
            unset($validated['free_shipping_min']);
        }
        if (empty($validated['max_amount'])) {
            $validated['max_amount'] = 0.0;
        }
        $data['coupon'] = Coupon::create($validated);
        $data['message'] = 'Coupon added successfully.';

        return $data;
    }

    public static function updateCoupon(CouponValidationRequest $request, $id)
    {
        $validated = $request->validated();
        $coupon = Coupon::where('id', $id)->where('status', 1)->first();

        if (!empty($coupon)) {

            if ($validated['coupon_usage'] == 1) {
                if (empty($validated['usage_limit'])) {
                    $validated['usage_limit'] = 0;
                }
            }

            if ($validated['coupon_type'] == 3) {
                if (!empty($validated['free_shipping_min'])) {
                    $validated['apply_for'] = 1;
                }
            } else {
                $validated['free_shipping_min'] = 0.0;
            }

            if (empty($validated['amount'])) {
                $validated['amount'] = 0.0;
            }
            if (empty($validated['max_amount'])) {
                $validated['max_amount'] = 0.0;
            }

            if (isset($validated['apply_for']) && $validated['apply_for'] == 2) {
                if (empty($validated['order_from_amount'])) {
                    $validated['order_from_amount'] = 0.0;
                }
            }
            
            $data['coupon'] = $coupon->update($validated);
            $data['message'] = 'Coupon updated successfully.';

            return $data;
        }
    }

    public static function deleteCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['status' => 2]);

        $data['coupon'] = $coupon;
        $data['message'] = 'Coupon deleted successfully';

        return $data;
        
    }
}
