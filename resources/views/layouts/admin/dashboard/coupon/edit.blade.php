@extends('layouts.admin.base.app')
@section('title', 'Update Coupon')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Update Coupon" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.coupon.index') }}" label="Coupon" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.coupon.edit', $coupon->id) }}" label="Update" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.coupon.update', $coupon->id) }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="coupon_code" 
                                                inputValue="{{ old('coupon_code') ?? $coupon->coupon_code }}" 
                                                inputValidationID="coupon_code"
                                                inputRequired="required" 
                                                inputClass="form-control coupon_code"
                                                labelText="Coupon Code"
                                                disabled=""
                                                maxlength="">
                                                <label for="coupon_code" class="form-label required">Coupon Code <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="javascript:void(0)" class="btn add-variant mt-4" id="generateCoupon">Generate</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" id="couponUsage">
                                            <x-form-fields.advanced.select2-single
                                                inputName="coupon_usage"
                                                inputClass="form-control coupon_usage"
                                                inputValidationID="coupon_usage"
                                                hideValue=""
                                                inputValue="{{ old('coupon_usage') ?? $coupon->coupon_usage }}" 
                                                inputRequired="required" 
                                                :options="$usages" 
                                                hasChildren="false"
                                                optionValueKey="id" 
                                                optionLabelKey="title" 
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="Coupon Usage">
                                                <label for="coupon_usage" class="form-label required">Coupon Usage <span>*</span></label>
                                            </x-form-fields.advanced.select2-single>
                                        </div>
                                        <div class="form-group col-sm-6" id="usageLimit" style="display: none;">
                                            <x-form-fields.advanced.number 
                                                inputName="usage_limit" 
                                                inputValidationID="usage_limit"
                                                inputClass="form-control usage_limit"
                                                inputValue="{{ old('usage_limit') ?? $coupon->usage_limit }}" 
                                                inputRequired="required" 
                                                labelText="Usage Limit" 
                                                minimumValue="0" 
                                                maximumValue="100" 
                                                steps="1">
                                                <label for="usage_limit" class="form-label required">Usage Limit <span>*</span></label>
                                            </x-form-fields.advanced.number>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-4" id="couponType">
                                            <x-form-fields.advanced.select2-single 
                                                inputName="coupon_type"
                                                inputClass="form-control coupon_type"
                                                inputValidationID="coupon_type"
                                                hideValue=""
                                                inputValue="{{ old('coupon_type') ?? $coupon->coupon_type }}" 
                                                inputRequired="required" 
                                                :options="$couponTypes" 
                                                hasChildren="false"
                                                optionValueKey="id" 
                                                optionLabelKey="title" 
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="Coupon Type">
                                                <label for="coupon_type" class="form-label required">Coupon Type <span>*</span></label>
                                            </x-form-fields.advanced.select2-single>
                                        </div>
                                        <div class="form-group col-sm-4" id="discountAmount">
                                            <x-form-fields.number 
                                                inputType="number" 
                                                inputName="amount" 
                                                inputValue="{{ old('amount') ?? $coupon->amount }}" 
                                                inputRequired="true" 
                                                labelText="Discount" 
                                                placeHolder="Enter amount" 
                                                minimumValue="0" 
                                                maximumValue="" 
                                                steps="1" />
                                        </div>
                                        <div class="form-group col-sm-4" id="applyFor">
                                            <x-form-fields.advanced.select2-single
                                                inputName="apply_for"
                                                inputClass="form-control apply_for"
                                                inputValidationID="apply_for"
                                                hideValue=""
                                                inputValue="{{ old('apply_for') ?? $coupon->apply_for }}" 
                                                inputRequired="required" 
                                                :options="$applyForTypes" 
                                                hasChildren="false"
                                                optionValueKey="id" 
                                                optionLabelKey="title" 
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="Apply For">
                                                <label for="apply_for" class="form-label required">Apply For <span>*</span></label>
                                            </x-form-fields.advanced.select2-single>
                                        </div>
                                        <div class="form-group col-sm-6" id="freeShippingAmount" style="display: none">
                                            <x-form-fields.number 
                                                inputType="number" 
                                                inputName="free_shipping_min" 
                                                inputValue="{{ old('free_shipping_min') ?? $coupon->free_shipping_min }}" 
                                                inputRequired="true" 
                                                labelText="Amount" 
                                                placeHolder="When purchase more than" 
                                                minimumValue="0" 
                                                maximumValue="" 
                                                steps="1" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="dynamicField">
                                                @if(!empty($coupon->order_from_amount))
                                                <x-form-fields.number 
                                                    inputType="number" 
                                                    inputName="order_from_amount" 
                                                    inputValue="{{ old('order_from_amount') ?? $coupon->order_from_amount }}" 
                                                    inputRequired="true" 
                                                    labelText="Minimum Order Amount" 
                                                    placeHolder="Enter Amount" 
                                                    minimumValue="0" 
                                                    maximumValue="" 
                                                    steps="1" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12" id="maxAmount">
                                            <x-form-fields.advanced.number
                                                inputName="max_amount" 
                                                inputValidationID="max_amount"
                                                inputClass="form-control max_amount"
                                                inputValue="{{ old('max_amount') ?? $coupon->max_amount }}"
                                                inputRequired="" 
                                                labelText="Max Discount Amount"
                                                minimumValue="0" 
                                                maximumValue="" 
                                                steps="1" >
                                                <label for="max_amount" class="form-label">Maximum Discount Amount</label>
                                            </x-form-fields.advanced.number>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <x-form-fields.advanced.date 
                                                inputName="start_date" 
                                                inputValidationID="start_date"
                                                inputClass="form-control start_date"
                                                inputValue="{{ old('start_date') ?? \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') }}" 
                                                inputRequired="required" 
                                                labelText="Start Date" 
                                                minValue="" 
                                                maxValue="">
                                                <label for="start_date" class="form-label required">Start Date <span>*</span></label>
                                            </x-form-fields.advanced.date>
                                        </div>
                                        <div class="col-sm-6">
                                            <x-form-fields.date 
                                                inputName="expire_date" 
                                                inputValue="{{ old('expire_date') ?? ($coupon->expire_date ? \Carbon\Carbon::parse($coupon->expire_date)->format('Y-m-d') : '') }}" 
                                                inputRequired="false" 
                                                labelText="End Date" 
                                                minValue="" 
                                                maxValue="" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="form-label required">Status <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3 status1" 
                                                            inputValidationID="status1"
                                                            isChecked="{{ old('status', $coupon->status) == 1 ? 'checked' : '' }}" 
                                                            inputType="radio" 
                                                            inputName="status" 
                                                            inputValue="1" 
                                                            inputRequired="" 
                                                            labelText="Active">
                                                            <label for="status1" class="">Active</label>
                                                        </x-form-fields.advanced.radio-checkbox>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3 status2" 
                                                            inputValidationID="status2"
                                                            isChecked="{{ old('status', $coupon->status) == 2 ? 'checked' : '' }}" 
                                                            inputType="radio" 
                                                            inputName="status" 
                                                            inputValue="2" 
                                                            inputRequired="" 
                                                            labelText="Inactive">
                                                            <label for="status2" class="">Inactive</label>
                                                        </x-form-fields.advanced.radio-checkbox>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mx-auto">
                        <x-submission-card cardLabel="Publish" submitLabel="Update" discardLabel="Discard" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // generate coupon code start
    function generateRandomString(length = 12) {
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    $(document).ready(function () {
        $('#generateCoupon').on('click', function () {
            let couponCode = generateRandomString(12);
            $('#coupon_code').val(couponCode);
        });
    });
    // generate coupon code end

    // toggle Usage Limit & free shipping start
    $(document).ready(function() {
        function toggleUsageLimit() {
            const showUsageLimit = $('.coupon_usage').val() == 1;
            $('#usageLimit').toggle(showUsageLimit);
            $('#couponUsage').toggleClass('col-sm-6', showUsageLimit).toggleClass('col-sm-12', !showUsageLimit);
            $('#usage_limit').prop('disabled', !showUsageLimit).attr('required', showUsageLimit || false);
        }
        toggleUsageLimit();
        $('.coupon_usage').on('change', toggleUsageLimit);

        function toggleFreeShipping() {
            const isFreeShipping = $('.coupon_type').val() == 3;
            $('#couponType').toggleClass('col-sm-6', isFreeShipping).toggleClass('col-sm-4', !isFreeShipping);
            $('#freeShippingAmount').toggle(isFreeShipping);
            $('#discountAmount, #applyFor, #dynamicField').toggle(!isFreeShipping);
            
            $('#free_shipping_min').prop('disabled', !isFreeShipping).attr('required', isFreeShipping);
            $('#amount, .apply_for').prop('disabled', isFreeShipping).attr('required', !isFreeShipping);
        }
        toggleFreeShipping();
        $('.coupon_type').on('change', toggleFreeShipping);
    });
    // toggle Usage Limit & free shipping end

    $(document).ready(function() {
        // Append input field on selected Apply for start
        $('.apply_for').on('change', function() {
            var selectedValue = $(this).val();
            var dynamicField = $('#dynamicField');
            dynamicField.empty();

            if (selectedValue == 2) {
                dynamicField.append(`
                    <x-form-fields.number 
                        inputType="number" 
                        inputName="order_from_amount" 
                        inputValue="{{ old('order_from_amount') }}" 
                        inputRequired="true" 
                        labelText="Minimum Order Amount" 
                        placeHolder="Enter Amount" 
                        minimumValue="0" 
                        maximumValue="" 
                        steps="1" />                
                `);
            } 
        });
    });

</script>
@endpush