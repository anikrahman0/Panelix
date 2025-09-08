

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>invoice</title>
</head>
<body>
  <section>
<div class="invoice-page-area" style="width:100%;margin:30px 0">
    <div class="invoice-page-wrapper" style="width:600px;background: #fff9f6;margin:auto;">
      <div class="invoice-page-top-content" style="background: #ffece2; padding: 20px;margin-bottom: 30px;">
        <div class="invoice-top-wrap" style="display: flex; justify-content: space-between;align-items: center;">
              <div class="invoice-top" style="text-align: start;display: block;">
                <a href="#">
                  <img style="width: 75px;"  class="img-fluid" src="{{ $settings->logo ? config('app.default_site_url') . '/storage/' . $settings->logo : config('app.logo_full_path') }}" alt="" title="">
                </a>
              </div>
            <div class="invoice-top">
                <h2 style="font-size: 40px; font-weight: 500; font-family: Inter, sans-serif; text-transform: uppercase; color: #111;margin:0;" >Invoice</h2>
            </div>
        </div>
        <div class="date-no-group" style="  display: flex; gap: 20px;justify-content: end; margin-top: -16px;width:100%" >
            <p style="font-size: 16px; line-height: 26px; color: #424242;margin:0px;" >Invoice No: <b style="color: #111;" > #{{$order->invoice_no}}</b></p>
            <p style="font-size: 16px; line-height: 26px; color: #424242;margin:0px;">Date: <b style="color: #111;"> {{ date('F d, Y', strtotime($order->created_at)) }}</b></p>
        </div>
      </div>
      <div class="table-contentAll" style="padding: 0 20px;">
        <div class="address-content-middle" style="display: flex; justify-content: space-between;align-items: center;margin-bottom: 30px;">
            <div class="address-content">
                <h4 style="font-size: 16px; color: #111;margin:0 0 10px 0;" >Bill From:</h4>
                <address style="font-size: 16px;line-height: 20px; vertical-align: top; color: #424242;font-style: normal;">{{ config('translatebn.jhingephul') }}<br> 
                {{-- 34 North Brook Hall Road,<br>
                3rd Floor, Dhaka, Bangladesh<br>  --}}
                {{ $settings->address ?? config('app.default_address') }}<br> 
                Phone: {{ $settings->phone ?? config('app.default_phone') }}<br> 
                Email: {{ $settings->email ?? config('app.default_email') }} </address>
            </div>
            <div class="address-content" style="text-align:end;">
                <h4 style="font-size: 16px; color: #111;margin:0 0 10px 0;">Invoice To:</h4>
                @if($order->orderShippingAddress)
                  <address style="font-size: 16px;line-height: 20px;vertical-align: top; color: #424242; font-style: normal;">
                    {{ $order->orderShippingAddress?->name }} <br>
                    {{ $order->orderShippingAddress?->state->name }}, 
                    {{ $order->orderShippingAddress?->city->name }}, 
                    {{ $order->orderShippingAddress?->address }}, 
                    {{ $order->orderShippingAddress?->zip_code }}<br>
                    Phone: {{ $order->orderShippingAddress?->phone }}<br> 
                    Email: {{ $order->orderShippingAddress?->email }} </address>
                @endif
            </div>
        </div>
        <div class="invoice-table-price">
          <table class="fullTable" style="width: 100%;border-collapse: collapse;">
            <thead>
              <tr>
                  <th style="font-size: 16px; font-weight: 700;text-transform: uppercase;text-align: left;height: 50px;border-bottom: 1px solid #A4A4A4;">Product</th>
                  <th style="font-size: 16px; font-weight: 700;text-transform: uppercase;text-align: right;height: 50px;border-bottom: 1px solid #A4A4A4;">Price</th>
                  <th style="font-size: 16px; font-weight: 700;text-transform: uppercase;text-align: right;height: 50px;border-bottom: 1px solid #A4A4A4;">Qty</th>
                  <th style="font-size: 16px; font-weight: 700;text-transform: uppercase;text-align: right;height: 50px;border-bottom: 1px solid #A4A4A4;">Total</th>
                </tr>
              </thead>
            <tbody class="table-head-area" style="border-bottom:1px solid #000;">
              @foreach ($order->items as  $item)
                <tr style="--bs-table-accent-bg: #fff;">
                  <td style="text-align: start;border-bottom: 1px solid #eee; height: 50px; color: #424242;font-size: 16px;">{{$item->book_title ?? ''}}</td>
                  <td style="text-align: end;border-bottom: 1px solid #eee; height: 50px; color: #424242;font-size: 16px;">{{config('app.currency_symbol')}} {{$item->price ?? 0}}</td>
                  <td style="text-align: end;border-bottom: 1px solid #eee; height: 50px; color: #424242;font-size: 16px;">{{$item->quantity ?? 0}}</td>
                  <td style="text-align: end;border-bottom: 1px solid #eee; height: 50px; color: #424242;font-size: 16px;">{{config('app.currency_symbol')}} {{$item->price * $item->quantity ?? 0}}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td style="padding: 12px 0;text-align: start;">
                        <div class="address-content">
                            <h4 style="font-size: 16px; color: #111;margin:0 0 10px 0;">Payment info:</h4>
                            <address style="font-size: 16px; color: #424242;font-style: normal;" >{{ $order->payment_method }} <br> 
                            Amount:  {{config('app.currency_symbol')}} {{$order->total}}</address>
                        </div>
                    </td>
                    <td colspan="3">
                        <table style="width: 100%;">
                            <tbody>
                                <tr >
                                    <th style="text-align: start; color: #424242;height: 50px;font-size: 16px;">
                                        Subtotal</th>
                                    <td style="text-align: end; color: #424242;height: 50px;font-size: 16px;">
                                      {{config('app.currency_symbol')}} {{$order->subtotal}}</td>
                                </tr>
                                @if(!empty($order->coupon_amount))
                                <tr class="discount-offer">
                                    <th style="text-align: start; color: #F9904A;height: 50px;font-size: 16px;">
                                      Discount</th>
                                    <td style="text-align: end;height: 50px; color:#F9904A;font-size: 16px;">
                                        -{{config('app.currency_symbol')}} {{$order->coupon_amount}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th style="text-align: start; color:#424242;height: 50px;font-size: 16px;">
                                        Shipping Cost</th>
                                    <td style="text-align: end; color: #424242;height: 50px;font-size: 16px;">
                                        {{config('app.currency_symbol')}} {{$order->shipping_cost}}</td>
                                </tr>
                            </tbody>
                            <tfoot class="invoice-subtotal">
                                <tr>
                                    <th style="padding: 15px 0 15px 0;text-align: start;border-top:1px solid #D7DAE0;height: 50px;font-size: 16px; font-weight: 900; color: #000;">
                                        Grand Total</th>
                                    <th style="padding: 15px 0 15px 0;text-align: end;border-top:1px solid #D7DAE0;height: 50px;font-size: 16px; font-weight: 900; color: #000;">
                                        {{config('app.currency_symbol')}} {{$order->total}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</div>
</section>
</body>
</html>
