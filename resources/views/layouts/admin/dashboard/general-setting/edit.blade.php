@extends('layouts.admin.base.app')
@section('title', 'Update Setting')

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
        @include('layouts.admin.partials.success')
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Update Setting" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.general-setting.edit') }}" label="General Setting" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.general-setting.edit') }}" label="Update" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.general-setting.update') }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <x-form-fields.advanced.dropify
                                                inputName="logo" 
                                                inputID="logo"
                                                inputValidationID="logo"
                                                inputClass="banner-image-top"
                                                inputValue="{{ !empty($setting->logo) ? $cdn_url.'/'.$setting->logo : '' }}" 
                                                inputRequired="" 
                                                labelText="" 
                                                height="85" 
                                                maxSize="2M" 
                                                extentions="jpeg jpg png gif webp svg" 
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" 
                                                multiple="false" >
                                                <label for="logo" class="form-label pt-2">Site Logo</label>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                        <div class="col-sm-4">
                                            <x-form-fields.advanced.dropify
                                                inputName="fb_logo" 
                                                inputID="fb_logo"
                                                inputValidationID="fb_logo"
                                                inputClass="banner-image-top"
                                                inputValue="{{ !empty($setting->fb_logo) ? $cdn_url.'/'.$setting->fb_logo : '' }}" 
                                                inputRequired="" 
                                                labelText="" 
                                                height="85" 
                                                maxSize="2M" 
                                                extentions="jpeg jpg png gif webp svg" 
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" 
                                                multiple="false" >
                                                <label for="fb_logo" class="form-label pt-2">FB Logo</label>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                        <div class="col-sm-4">
                                            <x-form-fields.advanced.dropify
                                                inputName="favicon" 
                                                inputID="favicon"
                                                inputValidationID="favicon"
                                                inputClass="banner-image-top"
                                                inputValue="{{ !empty($setting->favicon) ? $cdn_url.'/'.$setting->favicon : '' }}" 
                                                inputRequired="" 
                                                labelText="" 
                                                height="85" 
                                                maxSize="2M" 
                                                extentions="jpeg jpg png gif webp svg ico" 
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg, .ico" 
                                                multiple="false" >
                                                <label for="favicon" class="form-label pt-2">Favicon</label>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="site_title" 
                                                inputValue="{{ old('site_title') ?? $setting->site_title }}"  
                                                inputRequired="" 
                                                labelText="Site Title"
                                                inputValidationID="site_title"
                                                inputClass="form-control site_title"
                                                disabled="" 
                                                maxlength="">
                                                <label for="site_title" class="form-label">Site Title</label>
                                            </x-form-fields.advanced.text-common>
                                            
                                            <x-form-fields.advanced.text-common
                                                inputType="url" 
                                                inputName="site_url" 
                                                inputValue="{{ old('site_url') ?? $setting->site_url }}"  
                                                inputRequired="" 
                                                labelText="Site URL"
                                                inputValidationID="site_url"
                                                inputClass="form-control site_url"
                                                disabled="" 
                                                maxlength="">
                                                <label for="site_url" class="form-label">Site URL</label>
                                            </x-form-fields.advanced.text-common>
                                            
                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="copyright_text" 
                                                inputValue="{{ old('copyright_text') ?? $setting->copyright_text }}"  
                                                inputRequired="" 
                                                labelText="Copyright Text"
                                                inputValidationID="copyright_text"
                                                inputClass="form-control copyright_text"
                                                disabled="" 
                                                maxlength="">
                                                <label for="copyright_text" class="form-label">Copyright Text</label>
                                            </x-form-fields.advanced.text-common>

                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="address" 
                                                inputValue="{{ old('address') ?? $setting->address }}"  
                                                inputRequired="" 
                                                labelText="Address"
                                                inputValidationID="address"
                                                inputClass="form-control address"
                                                disabled="" 
                                                maxlength="">
                                                <label for="address" class="form-label">Address</label>
                                            </x-form-fields.advanced.text-common>

                                            <x-form-fields.advanced.text-common
                                                inputType="email" 
                                                inputName="default_email" 
                                                inputValue="{{ old('default_email') ?? $setting->default_email }}"  
                                                inputRequired="" 
                                                labelText="Default Email"
                                                inputValidationID="default_email"
                                                inputClass="form-control default_email"
                                                disabled="" 
                                                maxlength="">
                                                <label for="default_email" class="form-label">Default Email</label>
                                            </x-form-fields.advanced.text-common>

                                            <x-form-fields.advanced.text-common
                                                inputType="phone" 
                                                inputName="default_phone" 
                                                inputValue="{{ old('default_phone') ?? $setting->default_phone }}"  
                                                inputRequired="" 
                                                labelText="Default Phone"
                                                inputValidationID="default_phone"
                                                inputClass="form-control default_phone"
                                                disabled="" 
                                                maxlength="">
                                                <label for="default_phone" class="form-label">Default Phone</label>
                                            </x-form-fields.advanced.text-common>

                                            <x-form-fields.advanced.ckeditor
                                                inputName="site_description" 
                                                inputValidationID="site_description"
                                                inputClass="form-control site_description"
                                                inputValue="{{ old('site_description', $setting->site_description) }}" 
                                                inputRequired="" 
                                                labelText="Site Description" 
                                                maxlength="10000">
                                                <label for="site_description" class="form-label">Site Description</label>
                                            </x-form-fields.ckeditor>

                                            <x-form-fields.advanced.ckeditor
                                                inputName="notice" 
                                                inputValidationID="notice"
                                                inputClass="form-control notice"
                                                inputValue="{{ old('notice', $setting->notice) }}" 
                                                inputRequired="" 
                                                labelText="Notice" 
                                                maxlength="10000">
                                                <label for="notice" class="form-label">Notice</label>
                                            </x-form-fields.ckeditor>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        // Initialize Dropify
        // Event delegation for dynamically bound Dropify clear button
        $(document).on('click', '.dropify-clear', function () {
            let $input = $(this).closest('.dropify-wrapper').find('input[type="file"]');
            console.log($input);
            console.log('Test');
            if ($input.length > 0) {
                let inputName = $input.attr('name'); // e.g., "logo"
                let hiddenInputName = inputName + '_remove';

                // Remove any previous hidden input with the same name
                $('input[name="' + hiddenInputName + '"]').remove();

                // Append hidden input to the form
                let $form = $input.closest('form');
                $('<input>').attr({
                    type: 'hidden',
                    name: hiddenInputName,
                    value: '1'
                }).appendTo($form);
            }
        });
    });
</script>

@endpush