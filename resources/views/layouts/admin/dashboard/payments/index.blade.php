@extends('layouts.admin.base.app')
@section('title', 'Payments')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Payments" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.payments.index') }}" label="Payments" />
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
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="basicTable">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Method Name</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($payments as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->method_name }}</td>
                                            <td>
                                                <select class="form-select change-payment-status p-2 w-50" data-payment-id="{{ $payment->id }}" name="change_status">
                                                    <option class="" value="1" {{ $payment->status == 1 ? 'selected': '' }}>Active</option>
                                                    <option class="" value="2" {{ $payment->status == 2 ? 'selected': '' }}>Inactive</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Payments Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $payments->appends(request()->query())->onEachSide(2)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('script')
    <script>
        // change payment status
        $(document).on('change', '.change-payment-status', function() {
            var status = $(this).val()
            var id = $(this).data('payment-id');
            $("a").attr("onclick", "return false;").css("opacity", "0.5");
            $('.change-payment-status').prop("disabled", true);
            $.ajax({
                url: "/admin/payment/" + status + "/" + id,
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