<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\OrderCrudService;

class OrderController extends Controller
{
    public function orderDetails($id)
    {
        $order = OrderCrudService::getOrderDetailsData($id);
        return view('common.order-invoice', $order);
    }

    public function orders()
    {
        $data = OrderCrudService::getOrderList();
        return view('layouts.admin.dashboard.orders.index', $data);
    }

    public function changeOrderStatus($status, $id)
    {
        $response = OrderCrudService::changeOrderStatus($status, $id);
        return response()->json(['success' => $response['message']]);
    }
    public function changeOrderPaymentStatus($status, $id)
    {
        $response = OrderCrudService::changeOrderPaymentStatus($status, $id);
        return response()->json(['success' => $response['message']]);
    }
}
