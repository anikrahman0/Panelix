<?php
namespace App\Services\Admin;

use App\Models\Payment;

class PaymentCrudService
{
    public static function getPaymentList()
    {
        $data['payments'] = Payment::paginate(10);
        return $data;
    }
    public static function changePaymentStatus($status, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update(['status' => $status]);

        return [
            'success' => true,
            'message' => 'Payment Method Status Changed Successfully'
        ];
    }

}