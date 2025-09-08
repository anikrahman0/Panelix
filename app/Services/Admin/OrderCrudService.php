<?php
namespace App\Services\Admin;

use App\Models\Order;
use App\Models\Payment;

class OrderCrudService
{
    public static function getOrderDetailsData($id)
    {
        $data['order'] = Order::with('orderShippingAddress', 'details')
            ->where('order_status', '!=', 8)
            ->where('order_status', '!=', 6)
            ->where('payment_status', '!=', 4)
            ->where('payment_status', '!=', 5)
            ->findOrFail($id);

        return $data;
    }
    public static function getOrderList()
    {
        $data['orders'] = Order::filter(request(['search', 'filter_payment']))->latest()->paginate(20);
        $data['payments'] = Payment::where('status', 1)->get();
        return $data;
    }

    public static function changeOrderStatus($status, $id)
    {
        $order = Order::with('details')->findOrFail($id);
        $order->update(['order_status' => $status]);

        return [
            'success' => true,
            'message' => 'Order Status Changed Successfully'
        ];
    }
    public static function changeOrderPaymentStatus($status, $id)
    {
        $payment = Order::with('details')->findOrFail($id);
        $payment->update(['payment_status' => $status]);

        return [
            'success' => true,
            'message' => 'Payment Status Changed Successfully'
        ];
    }

}