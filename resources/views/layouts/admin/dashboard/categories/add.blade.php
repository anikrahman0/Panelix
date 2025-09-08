@extends('layouts.admin.base.app')
@section('title', 'Add New Category')

@push('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<!-- Dropzone css-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Add New Category" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.categories.index') }}" label="Category" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.categories.add') }}" label="Add" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.categories.store') }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <x-form-fields.advanced.dropify
                                                    inputName="img"
                                                    inputClass="form-control-file dropify img"
                                                    inputValidationID="img"
                                                    inputValue=""
                                                    inputRequired=""
                                                    labelText="Category Image"
                                                    height="200"
                                                    maxSize="2M"
                                                    extentions="jpeg jpg png gif webp svg"
                                                    accepts=".jpg, .jpeg, .gif, .png, .webp, .svg"
                                                    multiple="false">
                                                    <label class="form-label" for="img">Category Image</label>
                                                </x-form-fields.advanced.dropify>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="title"
                                                inputValidationID="title"
                                                inputValue="{{ old('title') }}"
                                                inputRequired="required"
                                                inputClass="form-control title"
                                                labelText="Category Name"
                                                disabled=""
                                                maxlength="">
                                                <label for="title" class="form-label required">Category Name <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="slug"
                                                inputValidationID="slug"
                                                inputValue="{{ old('slug') }}"
                                                inputRequired=""
                                                inputClass="form-control slug"
                                                labelText="Slug"
                                                disabled=""
                                                maxlength="">
                                                <label for="slug" class="form-label">Slug</label>
                                            </x-form-fields.advanced.text-common>
                                            <div class="form-group" id="defaultCommission" style="display: none;">
                                                <x-form-fields.number inputType="number" inputName="default_commission" inputValue="{{ old('default_commission', 0) }}" inputRequired="true" labelText="Commission Value Percentage (%)" minimumValue="0" maximumValue="100" steps="1" />
                                            </div>
                                            <div class="form-group" id="maxAllowedVariant" style="display: none;">
                                                <x-form-fields.number inputType="number" inputName="max_allowed_variant" inputValue="{{ old('max_allowed_variant', 0) }}" inputRequired="true" labelText="Max Allowed Variant" minimumValue="0" maximumValue="100" steps="1" />
                                            </div>
                                            {{-- <x-form-fields.text-area inputType="text" inputName="short_desc" inputValue="{{ old('short_desc') }}" inputRequired="false" labelText="Short Description" rows="4" cols="" maxlength="1000" /> --}}
                                            <x-form-fields.advanced.text-area
                                                inputName="short_desc"
                                                inputClass="form-control short_desc"
                                                inputValidationID="short_desc"
                                                inputValue="{{ old('short_desc') }}"
                                                inputRequired=""
                                                labelText="Short Description"
                                                rows="4"
                                                cols=""
                                                maxlength="1000">
                                                <label for="short_desc" class="form-label">Short Description</label>
                                            </x-form-fields.advanced.text-area>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 form-group">
                                            <label for="status" class="form-label required">Status <span class="text-danger">*</span></label>
                                            <div class="d-flex align-items-center">
                                                <div class="form-check-inline">
                                                    <x-form-fields.radio-checkbox labelClass="" inputClass="form-check-input me-3" inputID="active" isChecked="{{ old('status') == 1 || empty(old('status')) ? 'checked' : '' }}" inputType="radio" inputName="status" inputValue="1" inputRequired="false" labelText="Active"/>
                                                </div>
                                                <div class="form-check-inline">
                                                    <x-form-fields.radio-checkbox labelClass="" inputClass="form-check-input me-3" inputID="inactive" isChecked="{{ old('status') == 2 ? 'checked' : '' }}" inputType="radio" inputName="status" inputValue="2" inputRequired="false" labelText="Inactive"/>
                                                </div>
                                            </div>
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
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
@endpush