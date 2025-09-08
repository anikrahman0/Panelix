@extends('layouts.frontend.base.app')

@section('title', 'User Orders')

@push('css')
    
@endpush


@section('meta')
    
@endsection


@section('content')
<div class="dashboard-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4">
                @include('layouts.user.partials.sidebar')
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8">
                <div class="order-content">
                    <div class="dash-heading">
                        <h1>My Order</h1>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Invoice No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->invoice_no }}</th>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</td>
                                    <td>
                                        @switch($order->order_status)
                                            @case(1)
                                                <span class="badge bg-warning">Pending</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-info">Processing</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-warning">Shipped</span>
                                                @break
                                            @case(4)
                                                <span class="badge bg-primary">Delivered</span>
                                                @break
                                            @case(5)
                                                <span class="badge bg-success">Completed</span>
                                                @break
                                            @case(6)
                                                <span class="badge bg-danger">Cancelled</span>
                                                @break
                                            @case(7)
                                                <span class="badge bg-dark">Returned</span>
                                                @break
                                            @case(8)
                                                <span class="badge bg-danger">Failed</span>
                                                @break
                                            @default
                                        
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($order->payment_status)
                                            @case(1)
                                                <span class="text-warning">Unpaid</span>
                                                @break
                                            @case(2)
                                                <span class="text-success">Paid</span>
                                                @break
                                            @case(3)
                                                <span class="text-dark">Refunded</span>
                                                @break
                                            @default
                                        @endswitch
                                    </td>
                                    <td>৳ {{ $order->total }}</td>
                                    <td class="view-btn"><a href="{{ route('user.order.details', $order->id) }}"><i class="far fa-eye"></i> View</a></td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Order Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        {!! $orders->appends(request()->query())->onEachSide(2)->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection


@push('js')
    
@endpush
