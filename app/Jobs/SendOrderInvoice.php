<?php

namespace App\Jobs;

use App\Models\Order;
use App\Mail\OrderInvoiceMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOrderInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $email = $this->order->orderShippingAddress->email;

        if ($email) {
            Mail::to($email)->send(new OrderInvoiceMail($this->order));
        }
    }
}
