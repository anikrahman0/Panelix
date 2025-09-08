<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Order;
use App\Models\Bundle;
use App\Models\AdminUser;
use App\Models\OrderDetail;
use App\Models\BookStockHistory;
use Illuminate\Support\Facades\DB;
use App\Models\OrderShippingAddress;
use App\Notifications\NewOrderPlaced;

class OrderService
{
    protected $bookService;
    protected $couponService;
    protected $shippingService;
    public  function __construct(BookService $bookService, CouponService $couponService, ShippingService $shippingService)
    {
        $this->bookService = $bookService;
        $this->couponService = $couponService;
        $this->shippingService = $shippingService;
    }

    // generate unique order number
    public function generateOrderNumber()
    {
        $datetime = date('ymdHis');
        $random = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
        return "ORD-{$datetime}{$random}";
    }

    // create order address
    public  function createOrderAddress($request, $order){
        return OrderShippingAddress::create([
            'name'     => $request->shipping_name,
            'phone'    => $request->shipping_phone,
            'email'    => $request->shipping_email,
            'state_id' => $request->shipping_state_id,
            'city_id'  => $request->shipping_city_id,
            'zip_code' => $request->shipping_zip_code,
            'address'  => $request->shipping_address,
            'order_id' => $order->id
        ]);
    }

    // generate an order
    public function orderGenerate($orderData)
    {
        return Order::create([
            'invoice_no'      => $orderData['invoice_no'],
            'user_id'           => $orderData['user_id'],
            'coupon_id'         => $orderData['coupon_id'],
            'coupon_code'         => $orderData['coupon_code'] ,
            'coupon_type'         => $orderData['coupon_type'] ,
            'coupon_amount'         => $orderData['coupon_amount'],
            'subtotal'          => $orderData['subtotal'],
            'shipping_cost'     => $orderData['shipping_cost'],
            'total'      => $orderData['total'],
            'payment_method'    => $orderData['payment_method'],
            'transaction_id'    => $orderData['transaction_id'],
        ]);
    }

    // ssl commerz payload
    public function sslCommerzPayload($totalAmount, $transactionId,  array $optional = []): array
    {
        return [
            'total_amount'      => $totalAmount,
            'currency'          => 'BDT',
            'tran_id'           => $transactionId,

            'cus_name'          => $optional['cus_name'] ?? 'Customer Name',
            'cus_email'         => $optional['cus_email'] ?? 'customer@mail.com',
            'cus_add1'          => $optional['cus_add1'] ?? 'Customer Address',
            'cus_add2'          => $optional['cus_add2'] ?? '',
            'cus_city'          => $optional['cus_city'] ?? '',
            'cus_state'         => $optional['cus_state'] ?? '',
            'cus_postcode'      => $optional['cus_postcode'] ?? '',
            'cus_country'       => $optional['cus_country'] ?? 'Bangladesh',
            'cus_phone'         => $optional['cus_phone'] ?? '8801XXXXXXXXX',
            'cus_fax'           => $optional['cus_fax'] ?? '',

            'ship_name'         => $optional['ship_name'] ?? 'Store Test',
            'ship_add1'         => $optional['ship_add1'] ?? 'Dhaka',
            'ship_add2'         => $optional['ship_add2'] ?? 'Dhaka',
            'ship_city'         => $optional['ship_city'] ?? 'Dhaka',
            'ship_state'        => $optional['ship_state'] ?? 'Dhaka',
            'ship_postcode'     => $optional['ship_postcode'] ?? '1000',
            'ship_phone'        => $optional['ship_phone'] ?? '',
            'ship_country'      => $optional['ship_country'] ?? 'Bangladesh',

            'shipping_method'   => $optional['shipping_method'] ?? 'NO',
            'product_name'      => $optional['product_name'] ?? 'Computer',
            'product_category'  => $optional['product_category'] ?? 'Goods',
            'product_profile'   => $optional['product_profile'] ?? 'physical-goods',

            'value_a'           => $optional['value_a'] ?? 'ref001',
            'value_b'           => $optional['value_b'] ?? 'ref002',
            'value_c'           => $optional['value_c'] ?? 'ref003',
            'value_d'           => $optional['value_d'] ?? 'ref004',
        ];
    }

    // validate cart stock quantities
    public function validateCartStockQuantities($cart)
    {
        $requestedQuantities = [];
        foreach ($cart as $item) {
            $requestedQuantities[$item->id] = $item->quantity;
        }

        $stockIssues = $this->bookService->bookStockCheck($cart, $requestedQuantities);

        if (!empty($stockIssues)) {
            $failedRowIds = array_column($stockIssues, 'rowId');
            $messages = array_column($stockIssues, 'message');

            // Immediately redirect back and stop further code
            abort(
                redirect()
                    ->route('shopping.cart') // Replace with your cart route name
                    ->withErrors([
                        'stock_errors' => $messages,
                        'out_of_stock_ids' => $failedRowIds,
                    ])
            );
        }

        return $requestedQuantities;
    }

    // send order notification
    public function sendOrderNotification($order)
    {
        $admin = AdminUser::where('email', env('DEFAULT_EMAIL'))->first();
        if ($admin) {
            $admin->notify(new NewOrderPlaced($order));
        }
    }

    // update order details and stock
    public  function orderDetailStockUpdate($order, $cart)
    {
        $details = array();
        foreach ($cart as $row) {
            $details['order_id'] = $order->id;
            $details['book_id'] = $row->id;
            $details['quantity'] = $row->quantity;
            $details['book_title'] = $row->name;
            $details['price'] = $row->price;
            $details['regular_price'] = $row->attributes->regular_price;
            $details['sale_price'] = $row->attributes->sale_price;
            $details['total'] = $row->quantity * $row->price;
            OrderDetail::create($details);

            Book::where('id', $row->id)->update([
                'quantity' => DB::raw("quantity - {$row->quantity}")
            ]);

            BookStockHistory::create([
                'book_id' => $row->id,
                'type' => 'decrease',
                'quantity' => $row->quantity,
                'note' => "Quantity decreased by customer purchase: - $row->quantity order id $order->id",
            ]);
        }
    }

    // reset order status on payment termination
    public function resetOrderStatusOnTermination($tran_id, $orderStatus, $paymentStatus)
    {
        $order = Order::where('transaction_id', $tran_id)->firstOrFail();

        $updated = $order->update([
            'coupon_id'      => 0,
            'coupon_code'    => null,
            'coupon_type'    => null,
            'coupon_amount'  => 0,
            'order_status'   => $orderStatus,
            'payment_status' => $paymentStatus,
        ]);

        if ($updated) {
            OrderShippingAddress::where('order_id', $order->id)->delete();
        }
    }
}