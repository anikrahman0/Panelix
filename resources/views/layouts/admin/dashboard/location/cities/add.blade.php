@extends('layouts.admin.base.app')
@section('title', 'Add City')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection {
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
        padding: 5px;
        height: 40px;
    }

    .select2-container--default .select2-selection .select2-selection__arrow {
        height: 40px;
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
                                <x-page-title header="Add New City" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.cities.index') }}" label="Cities" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.cities.add') }}" label="Add New City" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.cities.store') }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="name" 
                                                inputValue="{{ old('name') }}" 
                                                inputValidationID="name"
                                                inputRequired="required" 
                                                inputClass="form-control name"
                                                labelText="City Name" 
                                                disabled="" 
                                                maxlength="">
                                                <label for="name" class="form-label required">City Name <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                            <x-form-fields.advanced.select2-single
                                                inputName="country_id"
                                                inputClass="form-control country_id"
                                                inputValidationID="country_id"
                                                hideValue=""
                                                inputValue="{{ old('country_id') }}" 
                                                inputRequired="required" 
                                                :options="$countries" 
                                                hasChildren="false"
                                                optionValueKey="id" 
                                                optionLabelKey="country_name" 
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="Country Name">
                                                <label for="country_id" class="form-label required">Country <span>*</span></label>
                                            </x-form-fields.advanced.select2-single>
                                            {{-- <x-form-fields.select2-single inputName="state_id" inputValue="{{old('state_id')}}" inputRequired="true" :options="[]" optionValueKey="id" optionLabelKey="name" labelText="State" /> --}}
                                            <x-form-fields.advanced.select2-single
                                                inputName="state_id"
                                                inputClass="form-control state_id"
                                                inputValidationID="state_id"
                                                hideValue=""
                                                inputValue="{{ old('state_id') }}" 
                                                inputRequired="required" 
                                                :options="[]" 
                                                hasChildren="false"
                                                optionValueKey="id" 
                                                optionLabelKey="name" 
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="State Name">
                                                <label for="state_id" class="form-label required">State <span>*</span></label>
                                            </x-form-fields.advanced.select2-single>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mx-auto">
                        <x-submission-card cardLabel="Publish" submitLabel="Save" discardLabel="Discard" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<!-- ckeditor js-->
{{-- <script src="{{asset('assets/js/admin/editor/ckeditor/ckeditor.js')}}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('change', '#country_id', function () {
            var selectedData = $(this).select2('data'); // Get an array of selected data items
            console.log(selectedData);
            $.ajax({
                url: "{{route('admin.cities.states')}}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    'country_id': selectedData[0].id
                },
                success: function (response) {
                    console.log(response);
                    let data = [{id: '', text: 'Select State'}];
                    (response.states).forEach(element => {
                        data.push({id: element.id, text: element.name})
                    });

                    $('#state_id').empty();
                    $('#state_id').select2({
                        data: data,
                        placeholder: 'Select State'
                    });
                }
            });
        });
    });
</script>
@endpush