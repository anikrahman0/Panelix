@extends('layouts.admin.base.app')
@section('title', 'Add New Country')

@push('css')
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
                                <x-page-title header="Add New Country" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.countries.index') }}" label="Countries" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.countries.add') }}" label="Add New Country" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.countries.store') }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            {{-- <x-form-fields.dropify inputName="country_flag" inputValue="" inputRequired="true" labelText="Flag <small>(Square. Preferable 150x150)</small>" height="200" maxSize="2M" extentions="jpeg jpg png gif webp svg" accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" multiple="false" /> --}}
                                            <x-form-fields.advanced.dropify
                                                inputName="country_flag" 
                                                inputID="country_flag"
                                                inputValidationID="country_flag"
                                                inputClass="country_flag"
                                                inputValue="" 
                                                inputRequired="required" 
                                                labelText="" 
                                                height="200" 
                                                maxSize="2M" 
                                                extentions="jpeg jpg png gif webp svg" 
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" 
                                                multiple="false" >
                                                <label for="country_flag" class="form-label required">Flag <span>*</span> <small>(Square. Preferable 150x150)</small></label>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                        <div class="col-sm-8">
                                            {{-- <x-form-fields.text-common inputType="text" inputName="country_name" inputValue="{{old('country_name')}}" inputRequired="true" labelText="Country Name" pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="country_name" 
                                                inputValue="{{ old('country_name') }}" 
                                                inputValidationID="country_name"
                                                inputRequired="required" 
                                                inputClass="form-control country_name"
                                                labelText="Country Name" 
                                                disabled="" 
                                                maxlength="">
                                                <label for="country_name" class="form-label required">Country Name <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                            {{-- <x-form-fields.text-common inputType="text" inputName="country_code" inputValue="{{old('country_code')}}" inputRequired="true" labelText="Country ISO Code" placeHolder="ISO country code, uppercase. Ex: US." pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="country_code" 
                                                inputValue="{{ old('country_code') }}" 
                                                inputValidationID="country_code"
                                                inputRequired="required" 
                                                inputClass="form-control country_code"
                                                labelText="ISO country code, uppercase. Ex: US." 
                                                disabled="" 
                                                maxlength="">
                                                <label for="country_code" class="form-label required">Country ISO Code <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                            {{-- <x-form-fields.text-common inputType="text" inputName="phone_code" inputValue="{{old('phone_code')}}" inputRequired="false" labelText="Phone Code" placeHolder="Phone code. Ex: +1." pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="phone_code" 
                                                inputValue="{{ old('phone_code') }}" 
                                                inputValidationID="phone_code"
                                                inputRequired="" 
                                                inputClass="form-control phone_code"
                                                labelText="Phone code. Ex: +1." 
                                                disabled="" 
                                                maxlength="">
                                                <label for="phone_code" class="form-label">Phone Code</label>
                                            </x-form-fields.advanced.text-common>
                                            {{-- <x-form-fields.text-common inputType="text" inputName="language" inputValue="{{old('language')}}" inputRequired="false" labelText="Language" pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="language" 
                                                inputValue="{{ old('language') }}" 
                                                inputValidationID="language"
                                                inputRequired="" 
                                                inputClass="form-control language"
                                                labelText="Language" 
                                                disabled="" 
                                                maxlength="">
                                                <label for="language" class="form-label">Language</label>
                                            </x-form-fields.advanced.text-common>
                                            {{-- <x-form-fields.text-common inputType="text" inputName="language_code" inputValue="{{old('language_code')}}" inputRequired="false" labelText="Language Code" placeHolder="Language code, uppercase. Ex: ENG" pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="language_code" 
                                                inputValue="{{ old('language_code') }}" 
                                                inputValidationID="language_code"
                                                inputRequired="" 
                                                inputClass="form-control language_code"
                                                labelText="Language code, uppercase. Ex: ENG." 
                                                disabled="" 
                                                maxlength="">
                                                <label for="language_code" class="form-label">Language Code</label>
                                            </x-form-fields.advanced.text-common>
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
<script>
    $(document).ready(function() {
      // Initialize Dropify for thumbnail image
      $('.country_flag').dropify();
    });
</script>
@endpush