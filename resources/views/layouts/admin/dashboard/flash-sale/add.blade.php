@extends('layouts.admin.base.app')
@section('title', 'Add Flash Sale')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Dropzone css-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
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
                                <x-page-title header="Add New Flash Sale" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.flash-sale.index') }}" label="Flash Sale" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.flash-sale.add') }}" label="Add" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.flash-sale.store') }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.dropify
                                                inputName="image_path"
                                                inputClass="form-control-file dropify image_path"
                                                inputValidationID="image_path"
                                                inputValue=""
                                                inputRequired=""
                                                height="80"
                                                maxSize="2M"
                                                extentions="jpeg jpg png gif webp svg"
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg"
                                                multiple="false">
                                                <label class="form-label" for="img">Banner Image</label>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.select2-multiple
                                                inputName="book_id[]"
                                                inputValidationID="book_id"
                                                inputValue="{{ implode(',' , $bookIDs) }}"
                                                hideValue=""
                                                inputRequired="required"
                                                inputTags="false"
                                                inputClass="form-control book_id"
                                                :options="$books"
                                                optionValueKey="id"
                                                optionLabelKey="title"
                                                hasChildren="false"
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData="true"
                                                ajaxRouteName="admin.book.get"
                                                ajaxInputLength="2"
                                                labelText="Select Books">
                                                <label for="book_id" class="form-label required">Books <span>*</span></label>
                                            </x-form-fields.advanced.select2-multiple>

                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="title" 
                                                inputValue="{{ old('title') }}"  
                                                inputRequired="required" 
                                                labelText="Title"
                                                inputValidationID="title"
                                                inputClass="form-control title"
                                                disabled="" 
                                                maxlength="">
                                                <label for="title" class="form-label required">Title <span>*</span></label>
                                            </x-form-fields.advanced.text-common>

                                            <x-form-fields.advanced.ckeditor
                                                inputName="description" 
                                                inputValidationID="description"
                                                inputClass="form-control description"
                                                inputValue="{{ old('description') }}" 
                                                inputRequired="" 
                                                labelText="Description" 
                                                maxlength="60000"
                                                imageUploadPath="media/uploads/flash-sales/inner">
                                                <label for="description" class="form-label">Description</label>
                                            </x-form-fields.advanced.ckeditor>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="offer_type" class="form-label required">Offer Type <span class="text-danger">*</span></label>
                                                    <div class="d-flex align-items-center mt-3">
                                                        <div class="form-check-inline">
                                                            <x-form-fields.radio-checkbox 
                                                                labelClass="" 
                                                                inputClass="form-check-input me-3" 
                                                                inputID="amount" 
                                                                isChecked="{{ old('offer_type') == 1 ? 'checked' : 'checked' }}" 
                                                                inputType="radio" 
                                                                inputName="offer_type" 
                                                                inputValue="1" 
                                                                inputRequired="false" 
                                                                labelText="Amount"/>
                                                        </div>
                                                        <div class="form-check-inline">
                                                            <x-form-fields.radio-checkbox 
                                                                labelClass="" 
                                                                inputClass="form-check-input me-3" 
                                                                inputID="percentage" 
                                                                isChecked="{{ old('offer_type') == 2 ? 'checked' : '' }}" 
                                                                inputType="radio" 
                                                                inputName="offer_type" 
                                                                inputValue="2" 
                                                                inputRequired="false" 
                                                                labelText="Percentage"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <x-form-fields.number 
                                                inputType="number" 
                                                inputName="offer_amount" 
                                                inputValue="{{ old('offer_amount') }}" 
                                                inputRequired="true" 
                                                labelText="Offer Amount" 
                                                minimumValue="0" 
                                                maximumValue="100" 
                                                steps="1" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="status" class="form-label required">Status <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="form-check-inline">
                                                        <x-form-fields.radio-checkbox 
                                                            labelClass="" 
                                                            inputClass="form-check-input me-3" 
                                                            inputID="active" 
                                                            isChecked="{{ old('status') == 1 ? 'checked' : 'checked' }}" 
                                                            inputType="radio" 
                                                            inputName="status" 
                                                            inputValue="1" 
                                                            inputRequired="false" 
                                                            labelText="Active"/>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <x-form-fields.radio-checkbox 
                                                            labelClass="" 
                                                            inputClass="form-check-input me-3" 
                                                            inputID="inactive" 
                                                            isChecked="{{ old('status') == 2 ? 'checked' : '' }}" 
                                                            inputType="radio" 
                                                            inputName="status" 
                                                            inputValue="2" 
                                                            inputRequired="false" 
                                                            labelText="Inactive"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <x-form-fields.date 
                                                inputType="date" 
                                                inputName="end_time" 
                                                inputValue="{{ old('end_time') }}" 
                                                inputRequired="true" 
                                                labelText="End Time" 
                                                minValue="" 
                                                maxValue="" />
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endpush