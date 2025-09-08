@extends('layouts.admin.base.app')
@section('title', 'Update State')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
        padding: 5px;
        height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
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
                                <x-page-title header="Update State" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.states.index') }}" label="States" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.states.edit', $id) }}" label="Update State" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.states.update', $id) }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{-- <x-form-fields.text-common inputType="text" inputName="name" inputValue="{{old('name') ?? $state->name}}" inputRequired="true" labelText="State Name" pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="name" 
                                                inputValue="{{ old('name') ?? $state->name }}" 
                                                inputValidationID="name"
                                                inputRequired="required" 
                                                inputClass="form-control name"
                                                labelText="State Name" 
                                                disabled="" 
                                                maxlength="">
                                                <label for="name" class="form-label required">State Name <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                            {{-- <x-form-fields.text-common inputType="text" inputName="abbreviation" inputValue="{{old('abbreviation') ?? $state->abbreviation}}" inputRequired="true" labelText="Abbreviation" pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="abbreviation" 
                                                inputValue="{{ old('abbreviation') ?? $state->abbreviation }}" 
                                                inputValidationID="abbreviation"
                                                inputRequired="required" 
                                                inputClass="form-control abbreviation"
                                                labelText="Abbreviation" 
                                                disabled="" 
                                                maxlength="">
                                                <label for="abbreviation" class="form-label required">Abbreviation <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                            {{-- <x-form-fields.select2-single inputName="country_id" inputValue="{{old('country_id', $state->country->id)}}" inputRequired="true" :options="$countries" optionValueKey="id" optionLabelKey="country_name" labelText="Country" /> --}}
                                            <x-form-fields.advanced.select2-single
                                                inputName="country_id"
                                                inputClass="form-control country_id"
                                                inputValidationID="country_id"
                                                hideValue=""
                                                inputValue="{{ old('country_id', $state->country->id) }}" 
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
@endpush