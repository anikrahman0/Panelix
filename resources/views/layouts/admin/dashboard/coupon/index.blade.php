@extends('layouts.admin.base.app')
@section('title', 'Coupons')

@push('css')
<!-- Datatables css-->
<link rel="stylesheet" type="text/css" href={{asset("assets/css/vendors/datatables.css")}}>
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
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Coupons" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.coupon.index') }}" label="Coupons" />
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
                            <a href="{{ route('admin.coupon.add') }}" class="btn btn-primary mt-md-0 mt-2"> <i class="fas fa-plus"></i> Add New Coupon</a>
                        </div>
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="basicTable">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Coupon Code</th>
                                        <th>Coupon Type</th>
                                        <th>Coupon Usage</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $coupon->coupon_code  }}</td>
                                        <td>
                                            {{ $coupon->coupon_type == 1 ? 'Fixed Amount' :'' }}
                                            {{ $coupon->coupon_type == 2 ? 'Percentage' :'' }}
                                            {{ $coupon->coupon_type == 3 ? 'Free Shipping' :'' }}
                                        </td>
                                        <td>
                                            {{ $coupon->coupon_usage == 1 ? 'Multiple' : '' }}
                                            {{ $coupon->coupon_usage == 2 ? 'Unlimited' : '' }}
                                        </td>
                                        <td>{{ $coupon->start_date ?? '' }}</td>
                                        <td>{{ $coupon->expire_date ?? '' }}</td>
                                        <td>{{ $coupon->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <x-action-buttons.edit
                                                :url="route('admin.coupon.edit', $coupon->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                permission="coupon-update"
                                            />
                                            <!-- Example usage in a Blade view -->
                                            <x-action-buttons.delete
                                                :url="route('admin.coupon.delete', $coupon->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                confirmationMessage="Do you really want to delete this coupon?"
                                                permission="coupon-delete"
                                            />
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Coupons Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('script')
    <!-- Datatable js-->
    <script src={{asset("assets/js/admin/datatables/jquery.dataTables.min.js")}}></script>
    {{-- <script src={{asset("assets/js/admin/datatables/custom-basic.js")}}></script> --}}
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#basicTable').DataTable( {
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: [0,-1] },
                    { responsivePriority: 2, targets: [2] },
                ]
            });
        });
    </script>
@endpush