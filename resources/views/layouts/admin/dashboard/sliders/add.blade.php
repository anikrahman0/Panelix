@extends('layouts.admin.base.app')
@section('title', 'Add Slider Image')

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
@if($errors->any())
<span class="text-danger">
    {{ implode('', $errors->all(':message')) }}
</span>
@endif
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Add New Slider" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.sliders.index') }}" label="Slider" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.sliders.add') }}" label="Add" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.sliders.store') }}" class="digital-add needs-validation" enctype="multipart/form-data">
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
                                                inputName="title" 
                                                inputValue="{{ old('title') }}" 
                                                inputValidationID="title"
                                                inputRequired="required" 
                                                inputClass="form-control title"
                                                labelText="Slider Title" 
                                                disabled="" 
                                                maxlength="">
                                                <label for="title" class="form-label required">Slider Title <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <x-form-fields.advanced.text-area
                                                inputName="slider_description"
                                                inputClass="form-control slider_description"
                                                inputValidationID="slider_description"
                                                inputValue="{{ old('slider_description') }}"
                                                inputRequired=""
                                                labelText="Short Description"
                                                rows="4"
                                                cols=""
                                                maxlength="1000">
                                                <label for="slider_description" class="form-label">Short Description</label>
                                            </x-form-fields.advanced.text-area>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="slider_type" class="form-label required">Slider Type <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3 default" 
                                                            inputValidationID="default"
                                                            isChecked="{{ empty(old('slider_type')) || old('slider_type') == 1 ? 'checked' : '' }}" 
                                                            inputType="radio" 
                                                            inputName="slider_type" 
                                                            inputValue="1" 
                                                            inputRequired="" 
                                                            labelText="Active">
                                                            <label for="default" class="">Default</label>
                                                        </x-form-fields.advanced.radio-checkbox>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3 custom" 
                                                            inputValidationID="custom"
                                                            isChecked="{{ old('slider_type') == 2 ? 'checked' : '' }}" 
                                                            inputType="radio" 
                                                            inputName="slider_type" 
                                                            inputValue="2" 
                                                            inputRequired="" 
                                                            labelText="Inactive">
                                                            <label for="custom" class="">Custom</label>
                                                        </x-form-fields.advanced.radio-checkbox>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
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
                                    <div class="row mt-4">
                                        <div class="col-xl-12">
                                            <div class="social-header">
                                                <h4 class="me-3">Add Slider</h4>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="sliderImageSection" class="ui-sortable sortable">
                                                @if(!empty($oldSliderImages))
                                                    @foreach($oldSliderImages as $key => $sliderImage)
                                                    <div class="slider-row-append p-4" id="sliderCount_{{$key}}">
                                                        <input type="hidden" name="position[{{ $key }}]" class="position" value="{{ $key }}">
                                                        <div class="row image-row">
                                                            <div class="col-sm-11">
                                                                <x-form-fields.advanced.dropify
                                                                    inputName="img_bg[{{$key}}]" 
                                                                    inputID="img_bg"
                                                                    inputValidationID="img_bg.{{$key}}"
                                                                    inputClass="slider-image-bg"
                                                                    inputValue="" 
                                                                    inputRequired="required" 
                                                                    labelText="" 
                                                                    height="80" 
                                                                    maxSize="2M" 
                                                                    extentions="jpeg jpg png gif webp svg" 
                                                                    accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" 
                                                                    multiple="false" >
                                                                    <label for="img_bg_{{$key}}" class="form-label required pt-2">Slider Image <span>*</span></label>
                                                                </x-form-fields.advanced.dropify>
                                                            </div>
                                                            <div class="col-sm-1 mt-4">
                                                                <i class="fas fa-trash text-danger delete-slider-image mt-4 h5"></i>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <x-form-fields.advanced.text-common
                                                                    inputType="text"
                                                                    inputName="slider_top_head[{{$key}}]" 
                                                                    inputValue="{{ old('slider_top_head',[])[$key] }}" 
                                                                    inputValidationID="slider_top_head.{{$key}}"
                                                                    inputRequired="" 
                                                                    inputClass="form-control slider_top_head"
                                                                    labelText="Slider Top Head" 
                                                                    disabled="" 
                                                                    maxlength="">
                                                                    <label for="slider_top_head_{{$key}}" class="form-label">Slider Top Head</label>
                                                                </x-form-fields.advanced.text-common>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <x-form-fields.advanced.text-common
                                                                    inputType="text"
                                                                    inputName="slider_sub_head[{{$key}}]" 
                                                                    inputValue="{{ old('slider_sub_head',[])[$key] }}" 
                                                                    inputValidationID="slider_sub_head.{{$key}}"
                                                                    inputRequired="" 
                                                                    inputClass="form-control slider_sub_head"
                                                                    labelText="Slider Sub Head" 
                                                                    disabled="" 
                                                                    maxlength="">
                                                                    <label for="slider_sub_head_{{$key}}" class="form-label">Slider Sub Head</label>
                                                                </x-form-fields.advanced.text-common>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                @if(array_key_exists($key, $oldUrl))
                                                                    <x-form-fields.advanced.text-common
                                                                        inputType="url"
                                                                        inputName="url[{{$key}}]" 
                                                                        inputValue="{{ $oldUrl[$key] ?? '' }}" 
                                                                        inputValidationID="url.{{$key}}"
                                                                        inputRequired="" 
                                                                        inputClass="form-control url"
                                                                        labelText="URL" 
                                                                        disabled="" 
                                                                        maxlength="">
                                                                        <label for="url_{{$key}}" class="form-label">URL</label>
                                                                    </x-form-fields.advanced.text-common>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-sm-12 text-center">
                                            <a href="javascript:void(0)" class="btn btn-sm add-slider-image-btn" id="addSliderImage"><i class="fas fa-plus"></i> Add Image </a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $('.slider-image-bg').dropify()
        function initializeSelect2(selector, url, placeholder) {
            $(selector).select2({
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        };
                    },
                },
                minimumInputLength: 2,
                placeholder: placeholder
            });
        }
        $(document).on('click','.delete-slider-image', function(){
             $(this).closest('.slider-row-append').remove();
        });
        $('#addSliderImage').on('click', function(e) {
            e.preventDefault()
            var sliderCount = $('.slider-row-append').length
            var sliderImageSection =
            `<div class="slider-row-append p-4" id="sliderCount_${sliderCount}">
                <input type="hidden" name="position[${sliderCount}]" class="position" value="${sliderCount}">
                <div class="row image-row">
                    <div class="col-sm-11">
                        <x-form-fields.advanced.dropify
                            inputName="img_bg[${sliderCount}]" 
                            inputID="img_bg.${sliderCount}"
                            inputValidationID="img_bg.${sliderCount}"
                            inputClass="slider-image-bg"
                            inputValue="" 
                            inputRequired="required" 
                            labelText="" 
                            height="80" 
                            maxSize="2M" 
                            extentions="jpeg jpg png gif webp svg" 
                            accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" 
                            multiple="false" >
                            <label for="img_bg_${sliderCount}" class="form-label required pt-2">Slider Image <span>*</span></label>
                        </x-form-fields.advanced.dropify>
                    </div>
                    <div class="col-sm-1 mt-4">
                        <i class="fas fa-trash text-danger delete-slider-image mt-4 h5"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <x-form-fields.advanced.text-common
                            inputType="text"
                            inputName="slider_top_head[${sliderCount}]" 
                            inputValue="" 
                            inputValidationID="slider_top_head.${sliderCount}"
                            inputRequired="" 
                            inputClass="form-control slider_top_head"
                            labelText="Slider Top Head" 
                            disabled="" 
                            maxlength="">
                            <label for="slider_top_head_${sliderCount}" class="form-label">Slider Top Head</label>
                        </x-form-fields.advanced.text-common>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <x-form-fields.advanced.text-common
                            inputType="text"
                            inputName="slider_sub_head[${sliderCount}]" 
                            inputValue="" 
                            inputValidationID="slider_sub_head.${sliderCount}"
                            inputRequired="" 
                            inputClass="form-control slider_sub_head"
                            labelText="Slider Sub Head" 
                            disabled="" 
                            maxlength="">
                            <label for="slider_sub_head_${sliderCount}" class="form-label">Slider Sub Head</label>
                        </x-form-fields.advanced.text-common>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                         <x-form-fields.advanced.text-common
                            inputType="url"
                            inputName="url[${sliderCount}]" 
                            inputValue="" 
                            inputValidationID="url.${sliderCount}"
                            inputRequired="" 
                            inputClass="form-control url"
                            labelText="URL" 
                            disabled="" 
                            maxlength="">
                        <label for="url_${sliderCount}" class="form-label">URL</label>
                    </x-form-fields.advanced.text-common>
                    </div>
                </div>
            </div>`
            $('#sliderImageSection').append(sliderImageSection)
            sliderCount++
            $('.slider-image-bg').dropify()
        });
        
        $("#sliderImageSection").sortable({
            update: function(event, ui) {
                updatePositions();
            }
        });
        function updatePositions() {
            $("#sliderImageSection .slider-row-append").each(function(index) {
                $(this).find('.position').val(index + 1);
            });
        }
    });
</script>
@endpush