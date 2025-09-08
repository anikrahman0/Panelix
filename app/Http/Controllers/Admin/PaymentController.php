<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PaymentCrudService;

class PaymentController extends Controller
{
    public function payments()
    {
        $data = PaymentCrudService::getPaymentList();
        return view('layouts.admin.dashboard.payments.index', $data);
    }

    public function changePaymentStatus($status, $id)
    {
        $response = PaymentCrudService::changePaymentStatus($status, $id);
        return response()->json(['success' => $response['message']]);
    }
}
