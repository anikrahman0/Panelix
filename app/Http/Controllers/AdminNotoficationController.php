<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotoficationController extends Controller
{
    public function readNotification($id)
    {
        $notification = auth('admin')->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        $orderId = $notification->data['order_id'] ?? null;
        if ($orderId) {
            return redirect()->route('admin.order.details', $orderId);
        }
        return redirect()->back();
    }
}
