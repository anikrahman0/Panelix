@extends('layouts.admin.base.app')
@section('title', 'Update Bundle')

@push('css')
<!-- Dropzone css-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
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
                                <x-page-title header="Update Bundle" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.book.bundles.index') }}" label="Bundles" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.book.bundles.edit', $bookBundle->id) }}" label="Update" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.book.bundles.update', $bookBundle->id) }}" class="digital-add needs-validation" enctype="multipart/form-data">
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
                                                inputID="image_path"
                                                inputValidationID="image_path"
                                                inputClass="image_path"
                                                inputValue="{{ !empty($bookBundle->image_path) ? $cdn_url.'/'.$bookBundle->image_path : '' }}" 
                                                inputRequired="" 
                                                labelText="" 
                                                height="80" 
                                                maxSize="2M" 
                                                extentions="jpeg jpg png gif webp svg" 
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" 
                                                multiple="false" >
                                                <label for="image_path" class="form-label">Image</label>
                                                @if(!empty($bookBundle->image_path))
                                                    <div class="img-container">
                                                        <img src="{{ !empty($bookBundle->image_path) ? $cdn_url.'/'.$bookBundle->image_path : '' }}" class="img-fluid rounded my-2" width="100" height="80" />
                                                    </div>
                                                    <input type="hidden" name="old_image_path" value="{{ $bookBundle->image_path }}">
                                                @endif
                                            </x-form-fields.advanced.dropify>
                                            {{-- <input type="hidden" name="hidden_image" value="{{ $bookBundle->image ?? '' }}" /> --}}

                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="title" 
                                                inputValue="{{ old('title') ?? $bookBundle->title }}" 
                                                inputRequired="" 
                                                labelText="Title"
                                                inputValidationID="title"
                                                inputClass="form-control title"
                                                disabled="" 
                                                maxlength="">
                                                <label for="title" class="form-label">Title</label>
                                            </x-form-fields.advanced.text-common>

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
                                                <label for="book_id" class="form-label">Books <span>*</span></label>
                                            </x-form-fields.advanced.select2-multiple>

                                            <x-form-fields.advanced.text-common
                                                inputType="url"
                                                inputName="url" 
                                                inputValue="{{ old('url') ?? $bookBundle->url }}" 
                                                inputRequired="" 
                                                labelText="URL"
                                                inputValidationID="url"
                                                inputClass="form-control url"
                                                disabled=""
                                                maxlength="">
                                                <label for="url" class="form-label">URL</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="status" class="form-label required">Status <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3 status1" 
                                                            inputValidationID="status1"
                                                            isChecked="{{ $bookBundle->status == 1 ? 'checked' : ''}}" 
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
                                                            isChecked="{{ $bookBundle->status == 2 ? 'checked' : ''}}" 
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endpush