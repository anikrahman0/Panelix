@extends('layouts.admin.base.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="danger-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="shopping-bag" class="font-warning"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Total Orders</span>
                                <h3 class="mb-0"> 
                                    <span class="counter">{{$total_orders}}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="warning-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="shopping-bag" class="font-warning"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Pending Orders</span>
                                <h3 class="mb-0"> 
                                    <span class="counter">{{$pending_orders}}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="secondary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="dollar-sign" class="font-secondary"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">Total Revenue</span>
                                <h3 class="mb-0">{{config('app.currency_symbol')}} <span class="counter">{{$total_revenue}}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="primary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center"><i data-feather="book"
                                        class="font-primary"></i></div>
                            </div>
                            <div class="media-body media-doller"><span class="m-0">Total Books</span>
                                <h3 class="mb-0"><span class="counter">{{$total_books}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Monthly Sales Report</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option" style="width: 230px;">
                        <li><i class="icofont icofont-error close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>                                    
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Latest Orders</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option" style="width: 230px;">
                        <li><i class="icofont icofont-error close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="user-status table-responsive latest-order-table">
                    <table class="table table-bordernone">
                        <thead>
                            <tr>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Order Total</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Order Status</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Date Purchased</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest_orders as $order)
                                <tr>
                                    <td>
                                        @if(!($order->payment_status == 4 || $order->payment_status == 5 || $order->order_status == 6 || $order->order_status == 8))
                                            <a href="{{ route('admin.order.details',$order->id) }}"><i class="fa fa-eye text-success"></i>
                                             {{ $order->invoice_no }} </a>
                                        @else
                                            {{ $order->invoice_no }}
                                        @endif
                                    </td>
                                    <td class="digits">৳ {{ $order->total }}</td>
                                    <td class="font-danger">{{ $order->payment_method }}</td>
                                    <td class="digits">
                                        @if ($order->order_status == 1)
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @elseif ($order->order_status == 2)
                                            <span class="badge badge-pill badge-info">Processing</span>
                                        @elseif ($order->order_status == 3)
                                            <span class="badge badge-pill badge-dark">Shipped</span>
                                        @elseif ($order->order_status == 4)
                                            <span class="badge badge-pill badge-success">Delivered</span>
                                        @elseif ($order->order_status == 5)
                                            <span class="badge badge-pill badge-success">Completed</span>
                                        @elseif ($order->order_status == 6)
                                            <span class="badge badge-pill badge-danger">Canceled</span>
                                        @elseif ($order->order_status == 7)
                                            <span class="badge badge-pill badge-danger">Returned</span>
                                        @elseif ($order->order_status == 8)
                                            <span class="badge badge-pill badge-danger">Failed</span>
                                        @endif
                                    </td>
                                    <td class="digits">
                                        @if ($order->payment_status == 1)
                                            <span class="font-warning">Unpaid</span>
                                        @elseif ($order->payment_status == 2)
                                            <span class="font-success">Paid</span>
                                        @elseif ($order->payment_status == 3)
                                            <span class="font-danger">Refunded</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mt-4">View All Orders</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        let monthlySales = @json($monthly_sales);
    
        var options = {
            chart: {
                height: 359,
                type: "bar",
                stacked: true,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "15%",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: "Monthly Sales",
                data: monthlySales
            }],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            },
            colors: ["#34c38f"],
            legend: {
                position: "bottom"
            },
            fill: {
                opacity: 1
            }
        };
    
        var chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options);
        chart.render();
    </script>
@endpush