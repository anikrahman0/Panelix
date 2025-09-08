@extends('layouts.admin.base.app')
@section('title', 'Orders')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Datatables css-->
{{-- <link rel="stylesheet" type="text/css" href={{asset("assets/css/vendors/datatables.css")}}>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
<style>
    .dataTable tr.child ul li {
        display: block;
    }
    div.dataTables_wrapper div.dataTables_info {
        margin-top: 20px;
        padding-left: 10px;
        padding-top: 5px;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin-left: 0 !important;
    }
</style> --}}
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Orders" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.orders.index') }}" label="Orders" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            @include('layouts.admin.partials.success')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            
                        </div>
                        <div class="filter-section">
                            <form action="{{ route('admin.orders.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-4">
                                        <select name="filter_payment" class="form-select select2" onchange="this.form.submit()">
                                            <option value="">Filter by Payement</option>
                                            @foreach($payments as $payment)
                                                <option value="{{ $payment->method_slug }}" {{ request('filter_payment') == $payment->method_slug ? 'selected' : '' }}>
                                                    {{ $payment->method_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 d-flex">
                                        <input type="text" name="search" class="form-control post-wrapper dbcategory" value="{{ request('search') }}" placeholder="Search invoice" aria-describedby="button-addon2">
                                        <button type="submit" class="btn search-list-btn" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm reset-btn"><i class="fa-solid fa-rotate"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="basicTable">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date Purchased</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td><a href="{{ route('admin.order.details',$order->id) }}" class="fw-bold">{{ $order->invoice_no }}</a></td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</td>
                                            {{-- <td>May 21, 2024</td> --}}
                                            <td>৳{{ $order->total }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                @if($order->order_status==6)
                                                    <span class="badge bg-primary">Cancelled</span>
                                                @elseif($order->order_status==8)
                                                    <span class="badge bg-danger-custom">Failed</span>
                                                @else
                                                    <select class="form-select change-status p-1 custom-select-sm" data-order-id="{{ $order->id }}" name="change_status">
                                                        <option class="" value="1" {{ $order->order_status == 1 ? 'selected': '' }}>Pending
                                                        </option>
                                                        <option class="" value="2" {{ $order->order_status == 2 ? 'selected': '' }}>Processing
                                                        </option>
                                                        <option class="" value="3" {{ $order->order_status == 3 ? 'selected': '' }}>Shipped
                                                        </option>
                                                        <option class="" value="4" {{ $order->order_status == 4 ? 'selected': '' }}>Delivered
                                                        </option>
                                                        <option class="" value="5" {{ $order->order_status == 5 ? 'selected': '' }}>Completed
                                                        </option>
                                                        {{-- <option class="" value="6" {{ $order->order_status == 6 ? 'selected': '' }}>Cancelled --}}
                                                        </option>
                                                        <option class="" value="7" {{ $order->order_status == 7 ? 'selected': '' }}>Returned
                                                        </option>
                                                        {{-- <option class="" value="8" {{ $order->order_status == 8 ? 'selected': '' }}>Failed --}}
                                                        </option>
                                                    </select>
                                                @endif
                                            </td>
                                            <td>@if($order->payment_status==4)
                                                    <span class="badge bg-primary">Cancelled</span>
                                                @elseif($order->payment_status==5)
                                                    <span class="badge bg-danger-custom">Failed</span>
                                                @else
                                                    <select class="form-select change-payment-status p-1 custom-select-sm" data-order-id="{{ $order->id }}" name="change_payment_status">
                                                        <option class="" value="1" {{ $order->payment_status == 1 ? 'selected': '' }}>Unpaid
                                                        </option>
                                                        <option class="" value="2" {{ $order->payment_status == 2 ? 'selected': '' }}>Paid
                                                        </option>
                                                        <option class="" value="3" {{ $order->payment_status == 3 ? 'selected': '' }}>Refunded
                                                        </option>
                                                    </select>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!($order->payment_status == 4 || $order->payment_status == 5 || $order->order_status == 6 || $order->order_status == 8))
                                                    <div class="action-btn">
                                                        <x-action-buttons.view
                                                            :url="route('admin.order.details', $order->id)" 
                                                            :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                            permission="view-orders"
                                                        />
                                                    </div>
                                                @endif
                                            </td>
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
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        // change order status
        $(document).on('change', '.change-status', function() {
            var status = $(this).val()
            console.log(status)
            var id = $(this).data('order-id');
            $("a").attr("onclick", "return false;").css("opacity", "0.5");
            $('.change-status').prop("disabled", true);
            $.ajax({
                url: "/admin/order/" + status + "/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        $('#success-message').html('<div class="success-msg"> <div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fas fa-check-circle me-2"></i> <strong>'+data.success+'</strong> </div> </div>');
                        $("a").attr("onclick", "return true;").css("opacity", "1");
                        $('.change-status').prop("disabled", false);
                    }
                }
            });
        });

        // change payment status
        $(document).on('change', '.change-payment-status', function() {
            var status = $(this).val()
            var id = $(this).data('order-id');
            $("a").attr("onclick", "return false;").css("opacity", "0.5");
            $('.change-payment-status').prop("disabled", true);
            $.ajax({
                url: "/admin/order/payment/" + status + "/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        $('#success-message').html('<div class="success-msg"> <div class="alert alert-success alert-dismissible fade show" role="alert"> <i class="fas fa-check-circle me-2"></i> <strong>'+data.success+'</strong> </div> </div>');
                        $("a").attr("onclick", "return true;").css("opacity", "1");
                        $('.change-payment-status').prop("disabled", false);
                    }
                }
            });
        });
    </script>
@endpush