<?php

namespace App\Services;

use Cart;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CouponService {
    // apply coupon
    public function applyCoupon($request)
    {
        if (Session::has('coupon_code')) {
            return ['success' => false, 'message' => 'You can apply only one coupon at a time'];
        }

        if (!Auth::check()) {
            return ['success' => false, 'message' => 'Please login to continue', 'status' => 401];
        }

        $coupon = Coupon::where('coupon_code', $request->coupon_code)->where('status', 1)->first();

        if (!$coupon) {
            return ['success' => false, 'message' => 'Coupon is invalid'];
        }

        $today = now()->format('Y-m-d');
        $start = Carbon::parse($coupon->start_date)->format('Y-m-d');
        $expire = $coupon->expire_date ? Carbon::parse($coupon->expire_date)->format('Y-m-d') : null;

        if ($expire && $today > $expire) {
            return ['success' => false, 'message' => 'Coupon is expired'];
        }

        if ($today < $start) {
            return ['success' => false, 'message' => 'Coupon is not active yet'];
        }

        if ($coupon->coupon_usage === 1 && $coupon->usage_limit && $coupon->usage_limit <= $coupon->used) {
            return ['success' => false, 'message' => 'Coupon usage limit reached'];
        }

        $result = $this->couponAmountByType($coupon);
        if ($result['coupon-error']) {
            return ['success' => false, 'message' => $result['message']];
        }

        Session::put('coupon_code', $request->coupon_code);

        return [
            'success' => true,
            'coupon_id' => $coupon->id,
            'coupon_code' => $coupon->coupon_code,
            'coupon_amount' => Session::get('coupon_amount'),
            'coupon_type' => $coupon->coupon_type,
            'message' => 'Coupon applied successfully.'
        ];
    }

    // refresh coupon and validate
    public function refreshCouponAndValidate(float $newSubtotal)
    {
        if (!Session::has('coupon_id')) {
            return ['success' => false, 'message' => 'No coupon applied'];
        }

        $couponId = Session::get('coupon_id');

        $coupon = Coupon::where('id', $couponId)->where('status', 1)->first();

        if (!$coupon) {
            Session::forget(['coupon_id', 'coupon_code', 'coupon_amount', 'coupon_type']);
            return ['success' => false, 'message' => 'Coupon no longer exists'];
        }

        $today = now()->format('Y-m-d');
        $start = Carbon::parse($coupon->start_date)->format('Y-m-d');
        $expire = $coupon->expire_date ? Carbon::parse($coupon->expire_date)->format('Y-m-d') : null;

        if ($expire && $today > $expire) {
            Session::forget(['coupon_id', 'coupon_code', 'coupon_amount', 'coupon_type']);
            return ['success' => false, 'message' => 'Coupon is expired'];
        }

        if ($today < $start) {
            Session::forget(['coupon_id', 'coupon_code', 'coupon_amount', 'coupon_type']);
            return ['success' => false, 'message' => 'Coupon is not active yet'];
        }

        if ($coupon->coupon_usage === 1 && $coupon->usage_limit && $coupon->usage_limit <= $coupon->used) {
            Session::forget(['coupon_id', 'coupon_code', 'coupon_amount', 'coupon_type']);
            return ['success' => false, 'message' => 'Coupon usage limit reached'];
        }

        // Recalculate coupon discount amount according to new subtotal
        $discountAmount = 0;
        if ($coupon->coupon_type === 1) { // fixed amount
            $discountAmount = min($coupon->amount, $newSubtotal);
        } elseif ($coupon->coupon_type === 2) { // percentage
            $discountAmount = ($newSubtotal * $coupon->amount) / 100;
            if ($coupon->max_amount > 0 && $discountAmount > $coupon->max_amount) {
                $discountAmount = $coupon->max_amount;
            }
        }

        // Update session with recalculated values
        Session::put('coupon_amount', $discountAmount);
        Session::put('coupon_type', $coupon->coupon_type);
        Session::put('coupon_code', $coupon->coupon_code);
        Session::put('coupon_id', $coupon->id);

        return [
            'success' => true,
            'coupon_amount' => $discountAmount,
            'coupon_code' => $coupon->coupon_code,
            'coupon_type' => $coupon->coupon_type,
            'message' => 'Coupon refreshed successfully',
        ];
    }

    // increment coupon usage if exists
    public function incrementUsageIfExists($couponId)
    {
        if (!empty($couponId) && ($coupon = Coupon::find($couponId))) {
            $coupon->increment('used');
        }
    }

    // calculate coupon amount by type
    public  function couponAmountByType($coupon)
    {
        $cartSubTotal = Cart::getSubTotal();
        $couponDiscountAmount = 0;
        // check coupon type
        // fixed amount in bdt
        if ($coupon->coupon_type === 1) {
            $couponDiscountAmount = $coupon->amount;

            if ($coupon->max_amount > 0 && $couponDiscountAmount > $coupon->max_amount) {
                $couponDiscountAmount = $coupon->max_amount;
            }
            return $this->couponApplyFor($coupon, $cartSubTotal, $couponDiscountAmount);
        }
        // amount in percentage(%)
        elseif ($coupon->coupon_type === 2) {
            $couponDiscountAmount = ($cartSubTotal * $coupon->amount) / 100;
            if ($coupon->max_amount > 0 && $couponDiscountAmount > $coupon->max_amount) {
                $couponDiscountAmount = $coupon->max_amount;
            }
            return $this->couponApplyFor($coupon, $cartSubTotal, $couponDiscountAmount);
        } // free shipping
        elseif ($coupon->coupon_type === 3) {
            if ($cartSubTotal < $coupon->free_shipping_min) {
                return [
                    'coupon-error' => true,
                    'message' => 'Minimum order amount should be ' . $coupon->free_shipping_min . ' to apply this coupon',
                ];
            } else {
                return $this->storeCouponInSession($coupon, $couponDiscountAmount);
            }
        }
    }
    // check coupon apply for
    public  function couponApplyFor($coupon, $cartSubTotal, $couponDiscountAmount)
    {
        if ($coupon->apply_for === 1) {
            if ($coupon->max_amount > 0 && $couponDiscountAmount > $coupon->max_amount) {
                $couponDiscountAmount = $coupon->max_amount;
            }
            return $this->storeCouponInSession($coupon, $couponDiscountAmount);
        } elseif ($coupon->apply_for === 2) {
            if ($coupon->order_from_amount > $cartSubTotal) {
                return [
                    'coupon-error' => true,
                    'message' => 'Coupon is valid for order amount ' . $coupon->order_from_amount . ' or more',
                ];
            } else {
                if ($coupon->max_amount > 0 && $couponDiscountAmount > $coupon->max_amount) {
                    $couponDiscountAmount = $coupon->max_amount;
                }
                return $this->storeCouponInSession($coupon, $couponDiscountAmount);
            }
        }
    }

    // store coupon in session
    public function storeCouponInSession($coupon, $couponDiscountAmount)
    {
        Session::put('coupon_id', $coupon->id);
        Session::put('coupon_code', $coupon->coupon_code);
        Session::put('coupon_amount', $couponDiscountAmount);
        Session::put('coupon_type', $coupon->coupon_type);
        return [
            'coupon-error' => false,
            'message' => 'Coupon applied successfully.',
        ];
    }

    // remove coupon from session
    public function removeCouponFromSession()
    {
        Session::forget([
            'coupon_id',
            'coupon_code',
            'coupon_amount',
            'coupon_type',
        ]);

        return [
            'success' => true,
            'message' => 'Coupon removed successfully.',
        ];
    }
}