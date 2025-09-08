@extends('layouts.admin.base.app')
@section('title', 'Update Publisher')

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
                                <x-page-title header="Edit Publisher" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.publisher.index') }}" label="Publishers" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.publisher.edit', $publisher->id) }}" label="Edit Publisher" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.publisher.update', $publisher->id) }}" class="digital-add needs-validation" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
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
                                                <label class="form-label" for="image_path">Publisher Image</label>
                                                @if(!empty($publisher->image_path))
                                                    <div class="img-container">
                                                        <img src="{{ !empty($publisher->image_path) ? $cdn_url.'/'.$publisher->image_path : '' }}" class="img-fluid rounded my-2" width="100" height="80" />
                                                    </div>
                                                @endif
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="title" 
                                                inputValue="{{ old('title') ?? $publisher->title }}"  
                                                inputRequired="required" 
                                                labelText="Title"
                                                inputValidationID="title"
                                                inputClass="form-control title"
                                                disabled="" 
                                                maxlength="">
                                                <label for="title" class="form-label required">Title <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text" 
                                                inputName="email" 
                                                inputValue="{{ old('email') ?? $publisher->email }}"  
                                                inputRequired="" 
                                                labelText="Publisher Email"
                                                inputValidationID="email"
                                                inputClass="form-control email"
                                                disabled="" 
                                                maxlength="">
                                                <label for="email" class="form-label">Email</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.ckeditor
                                                inputName="description" 
                                                inputValidationID="description"
                                                inputClass="form-control description"
                                                inputValue="{{ old('description') ?? $publisher->description }} " 
                                                inputRequired="" 
                                                labelText="Publisher Description" 
                                                maxlength="60000"
                                                imageUploadPath="media/uploads/publishers/inner">
                                                <label for="description" class="form-label">Description</label>
                                            </x-form-fields.advanced.ckeditor>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="form-label required">Status <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3 status1" 
                                                            inputValidationID="status1"
                                                            isChecked="{{ (old('status', $publisher->status) == 1) ? 'checked' : '' }}" 
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
                                                            isChecked="{{ (old('status', $publisher->status) == 2) ? 'checked' : '' }}" 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@endpush