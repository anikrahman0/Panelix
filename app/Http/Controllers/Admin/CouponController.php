<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponValidationRequest;
use App\Services\Admin\CouponCrudService;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = CouponCrudService::listCoupon();
        return view('layouts.admin.dashboard.coupon.index', $coupons);
    }
    public function create()
    {
        $data = CouponCrudService::createCoupon();
        return view('layouts.admin.dashboard.coupon.add', $data);
    }
    public function store(CouponValidationRequest $request)
    {
        $data = CouponCrudService::storeCoupon($request);
        return to_route('admin.coupon.index')->with('success', $data['message']);
    }

    public function edit($id)
    {
            $data = CouponCrudService::editCoupon($id);
            if (!$data) {
                abort(404);
            }

            return view('layouts.admin.dashboard.coupon.edit', $data);
    }
    public function update(CouponValidationRequest $request, $id)
    {
        $data = CouponCrudService::updateCoupon($request, $id);
        return to_route('admin.coupon.index')->with('success', $data['message']);
    }
    public function destroy($id)
    {
        $data = CouponCrudService::deleteCoupon($id);
        return back()->with('success', $data['message']);
    }
}
