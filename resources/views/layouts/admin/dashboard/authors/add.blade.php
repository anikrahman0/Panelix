@extends('layouts.admin.base.app')
@section('title', 'Add New Author')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                <x-page-title header="Add New Author" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.author.index') }}" label="Authors" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.author.add') }}" label="Add New author" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.author.store') }}" class="digital-add needs-validation" enctype="multipart/form-data">
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
                                                <label class="form-label" for="image_path">Author Image</label>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="name" 
                                                inputValue="{{ old('name') }}"  
                                                inputRequired="required" 
                                                labelText="Author Name (Bangla)"
                                                inputValidationID="name"
                                                inputClass="form-control name"
                                                disabled="" 
                                                maxlength="">
                                                <label for="name" class="form-label required">Author Name (Bangla) <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="en_name" 
                                                inputValue="{{ old('en_name') }}"  
                                                inputRequired="" 
                                                labelText="Author Name (English)"
                                                inputValidationID="en_name"
                                                inputClass="form-control en_name"
                                                disabled="" 
                                                maxlength="">
                                                <label for="en_name" class="form-label">Author Name (English)</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="email" 
                                                inputValue="{{ old('email') }}"  
                                                inputRequired="" 
                                                labelText="Author Email"
                                                inputValidationID="email"
                                                inputClass="form-control email"
                                                disabled="" 
                                                maxlength="">
                                                <label for="email" class="form-label">Email</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.ckeditor
                                                inputName="bio" 
                                                inputValidationID="bio"
                                                inputClass="form-control bio"
                                                inputValue="{!! old('bio') !!} " 
                                                inputRequired="" 
                                                labelText="Author Bio" 
                                                maxlength="60000"
                                                imageUploadPath="media/uploads/authors/inner">
                                                <label for="bio" class="form-label">Bio</label>
                                            </x-form-fields.advanced.ckeditor>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="url"
                                                inputName="social_link_fb" 
                                                inputValue="{{ old('social_link_fb') }}" 
                                                inputRequired="" 
                                                labelText="Social Link (Facebook)"
                                                inputValidationID="social_link_fb"
                                                inputClass="form-control social_link_fb"
                                                disabled=""
                                                maxlength="">
                                                <label for="social_link_fb" class="form-label">Social Link (Facebook)</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="url"
                                                inputName="social_link_x" 
                                                inputValue="{{ old('social_link_x') }}" 
                                                inputRequired="" 
                                                labelText="Social Link (X)"
                                                inputValidationID="social_link_x"
                                                inputClass="form-control social_link_x"
                                                disabled=""
                                                maxlength="">
                                                <label for="social_link_x" class="form-label">Social Link (X)</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="url"
                                                inputName="social_link_ig" 
                                                inputValue="{{ old('social_link_ig') }}" 
                                                inputRequired="" 
                                                labelText="Social Link (Instagram)"
                                                inputValidationID="social_link_ig"
                                                inputClass="form-control social_link_ig"
                                                disabled=""
                                                maxlength="">
                                                <label for="social_link_ig" class="form-label">Social Link (Instagram)</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="form-label required">Status <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3 status1" 
                                                            inputValidationID="status1"
                                                            isChecked="{{ empty(old('status')) || old('status') == 1 ? 'checked' : '' }}" 
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
                                                            isChecked="{{ old('status') == 2 ? 'checked' : '' }}" 
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
                        <x-submission-card cardLabel="Publish" submitLabel="Save" discardLabel="Discard" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endpush