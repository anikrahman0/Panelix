@extends('layouts.admin.base.app')
@section('title', 'Add Social Icon')

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
                                <x-page-title header="Add New Icon" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.social-icon.index') }}" label="Social Icons" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.social-icon.add') }}" label="Add New Icon" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.social-icon.store') }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <x-form-fields.dropify inputName="logo" inputValue="" inputRequired="true" labelText="Logo <small>(Square. Preferable 150x150)</small>" height="200" maxSize="2M" extentions="jpeg jpg png gif webp svg" accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" multiple="false" />
                                        </div>
                                        <div class="col-sm-8">
                                            {{-- <x-form-fields.text-common inputType="text" inputName="name" inputValue="{{old('name')}}" inputRequired="true" labelText="Name" pattern="" /> --}}
                                            <x-form-fields.advanced.text-common 
                                                inputType="text"
                                                inputName="name" 
                                                inputValue="{{ old('name') }}" 
                                                inputValidationID="name"
                                                inputRequired="required" 
                                                inputClass="form-control name"
                                                labelText="Name" 
                                                disabled="" 
                                                maxlength="">
                                                <label for="name" class="form-label required">Name <span>*</span></label>
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
      $('.logo').dropify();
    });
</script>
@endpush