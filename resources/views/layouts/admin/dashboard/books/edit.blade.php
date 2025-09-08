@extends('layouts.admin.base.app')
@section('title', 'Edit Book')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* .select2-container--default .select2-selection--single {
        border-radius: 0.25rem;
        border: 1px solid #ced4da;
        padding: 5px;
        height: 40px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    } */

    .variant-appended-section .file-icon p {
        color: #b3a8a8;
        font-size: 14px;
        font-weight: 500;
    }
    .variant-appended-section .dropify-wrapper .dropify-message span.file-icon:before{
        line-height: .6em!important;
    }

    .variant-appended-section .dropify-wrapper .dropify-message span.file-icon {
        font-size: 30px!important;
        color: #b3a8a8!important;
        font-weight: 600!important;
    }

    .variant-appended-section .dropify-wrapper .dropify-message p {
        margin: 0!important;
    }

    .variant-appended-section .dropify-wrapper {
        color: #a7a3a3;
        background-color: #FFF;
        background-image: none;
        text-align: center;
        border: 2px solid #e4e4eb!important;
        border-radius: 7px;
        -webkit-transition: border-color .15s linear;
        transition: border-color .15s linear;
    }
    .variant-appended-section .dropify-wrapper .dropify-preview .dropify-render i {
        font-size: 56px;
    }
    .variant-appended-section .dropify-wrapper .dropify-preview .dropify-render .dropify-extension {
        font-size: 11px;
    }
</style>
@endpush
@section('content')
@if($errors->any())
<span class="text-danger">
    {!! implode("<br>", $errors->all(':message')) !!}
</span>
@endif
{{-- @dd(request()->all()) --}}
    <div class="container-fluid">
        @include('layouts.admin.partials.success')
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Edit Book" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.books.index') }}" label="Books" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.books.edit', $book->id) }}" label="Edit Book" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container-fluid">
            <div class="digital-add needs-validation">
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <x-form-fields.advanced.custom-multiple-category-select2
                                                    inputName="cat_id[]"
                                                    inputValidationID="cat_id"
                                                    inputValue="{{ implode(',' , $categoryIDs) }}"
                                                    inputRequired="required"
                                                    inputClass="cat_id"
                                                    :options="$categories"
                                                    optionValueKey="id"
                                                    optionLabelKey="title"
                                                    inputTags="false"
                                                    getAjaxData="false"
                                                    ajaxRouteName=""
                                                    ajaxInputLength="2"
                                                    labelText="Select Categories">
                                                    <label for="cat_id" class="form-label required">Category <span>*</span></label>
                                                </x-form-fields.advanced.custom-multiple-category-select2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="title" 
                                                inputValue="{!! old('title', $book->title) !!}" 
                                                inputValidationID="title"
                                                inputRequired="required" 
                                                inputClass="form-control title"
                                                labelText="Title" 
                                                disabled="" 
                                                maxlength="200">
                                                <label for="title" class="form-label required">Title <span>*</span></label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                {{-- <x-form-fields.advanced.select2-single
                                                    inputName="author_id"
                                                    inputValidationID="author_id"
                                                    inputValue="{{ old('author_id') ?? $book->author_id }}"
                                                    hideValue=""
                                                    inputRequired=""
                                                    inputClass="form-control author_id"
                                                    :options="$authors"
                                                    optionValueKey="id"
                                                    optionLabelKey="name"
                                                    hasChildren="false"
                                                    childname=""
                                                    childValueKey=""
                                                    childLabelKey=""
                                                    getAjaxData=""
                                                    ajaxRouteName=""
                                                    ajaxInputLength=""
                                                    labelText="Select Author">
                                                    <label for="author_id" class="form-label">Author</label>
                                                </x-form-fields.advanced.select2-single> --}}
                                                <x-form-fields.advanced.select2-multiple
                                                    inputName="author_id[]"
                                                    inputValidationID="author_id"
                                                    inputValue="{{ implode(',' , $authorIDs) }}"
                                                    hideValue=""
                                                    inputRequired=""
                                                    inputTags="false"
                                                    inputClass="form-control author_id"
                                                    :options="$authors"
                                                    optionValueKey="id"
                                                    optionLabelKey="name"
                                                    hasChildren="false"
                                                    childname=""
                                                    childValueKey=""
                                                    childLabelKey=""
                                                    getAjaxData="true"
                                                    ajaxRouteName="admin.author.get"
                                                    ajaxInputLength="2"
                                                    labelText="Select Authors">
                                                    <label for="author_id" class="form-label">Authors</label>
                                                </x-form-fields.advanced.select2-multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="show_en_name" class="form-label">Show Author Name in English:</label>
                                            <div class="d-flex align-items-center mt-3">
                                                <div class="form-check-inline">
                                                    <x-form-fields.advanced.radio-checkbox 
                                                        inputClass="form-check-input me-3" 
                                                        inputValidationID="show_en_name1" 
                                                        isChecked="{{ (old('show_en_name', $book->show_en_name) == 1) ? 'checked' : '' }}" 
                                                        inputType="radio" 
                                                        inputName="show_en_name" 
                                                        inputValue="1" 
                                                        inputRequired="" 
                                                        labelText="Yes">
                                                        <label for="show_en_name1" class="form-label">Yes</label>
                                                    </x-form-fields.advanced.radio-checkbox>
                                                </div>
                                                <div class="form-check-inline">
                                                    <x-form-fields.advanced.radio-checkbox 
                                                        inputClass="form-check-input me-3" 
                                                        inputValidationID="show_en_name2" 
                                                        isChecked="{{ (old('show_en_name', $book->show_en_name) == 2) ? 'checked' : '' }}" 
                                                        inputType="radio" 
                                                        inputName="show_en_name" 
                                                        inputValue="2" 
                                                        inputRequired="" 
                                                        labelText="No">
                                                        <label for="show_en_name2" class="form-label">No</label>
                                                    </x-form-fields.advanced.radio-checkbox>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="slug" 
                                                inputValue="{{ old('slug') ?? $book->slug }}" 
                                                inputValidationID="slug"
                                                inputRequired="" 
                                                inputClass="form-control slug"
                                                labelText="Slug" 
                                                disabled="" 
                                                maxlength="200">
                                                <label for="title" class="form-label">Slug</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <x-form-fields.advanced.select2-single
                                                inputName="publisher_id"
                                                inputValidationID="publisher_id"
                                                inputValue="{{ old('publisher_id') ?? $book->publisher_id }}"
                                                hideValue=""
                                                inputRequired=""
                                                inputClass="form-control publisher_id"
                                                :options="$publishers"
                                                optionValueKey="id"
                                                optionLabelKey="title"
                                                hasChildren="false"
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="Publisher">
                                                <label for="publisher_id" class="form-label">Publisher</label>
                                            </x-form-fields.advanced.select2-single>
                                        </div>
                                        <div class="col-xl-6">
                                            <x-form-fields.advanced.select2-single
                                                inputName="country_id"
                                                inputValidationID="country_id"
                                                inputValue="{{ old('country_id') ?? $book->country_id }}"
                                                hideValue=""
                                                inputRequired=""
                                                inputClass="form-control country_id"
                                                :options="$countries"
                                                optionValueKey="id"
                                                optionLabelKey="country_name"
                                                hasChildren="false"
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="Country">
                                                <label for="country_id" class="form-label">Country</label>
                                            </x-form-fields.advanced.select2-single>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="language" 
                                                inputValue="{{ old('language') ?? $book->language }}" 
                                                inputValidationID="language"
                                                inputRequired="" 
                                                inputClass="form-control language"
                                                labelText="Language" 
                                                disabled="" 
                                                maxlength="100">
                                                <label for="language" class="form-label">Language</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.dropify
                                                inputName="image_path[]"
                                                inputClass="form-control-file dropify image_path"
                                                inputValidationID="image_path"
                                                inputRequired="{{ empty($book->gallery) ? 'required' : '' }}"
                                                height="100"
                                                maxSize="2M"
                                                extentions="jpeg jpg png gif webp svg"
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg"
                                                multiple="true">
                                                <label class="form-label" for="image_path">Book Images @if(empty($book->gallery)) <span class="text-danger">*</span> @endif</label>
                                                <div class="row">
                                                    @if(!empty($book->gallery))
                                                        @foreach($book->gallery as $image)
                                                            <input type="checkbox" name="remove_book_images[]" value="{{ $image->id }}" id="delete-prod-img-{{ $image->id }}" hidden>
                                                            <div class="col-lg-1 col-sm-2 col-3 gallery_preview">
                                                                <div class="mb-2">
                                                                    <div class="upload-wrap pt-1">
                                                                        <div class="upload-images">
                                                                            <img alt="Gallery Image" class="img-fluid rounded" src="{{ $cdn_url.'/'.$image->img_path }}" width='100'>
                                                                            <a class="delete delete-product-images close" id="deleteGal-{{ $image->id }}" data-gal-img-id="{{ $image->id }}" href="#"> <i class="fas fa-times-circle delete-gal-img"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="edition" 
                                                inputValue="{{ old('edition') ?? $book->edition }}" 
                                                inputValidationID="edition"
                                                inputRequired="" 
                                                inputClass="form-control edition"
                                                labelText="Edition" 
                                                disabled="" 
                                                maxlength="100">
                                                <label for="edition" class="form-label">Edition</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-xl-6">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="page_no" 
                                                inputValue="{{ old('page_no') ?? $book->page_no }}" 
                                                inputValidationID="page_no"
                                                inputRequired="" 
                                                inputClass="form-control page_no"
                                                labelText="Number of Pages" 
                                                disabled="" 
                                                maxlength="100">
                                                <label for="page_no" class="form-label">Pages</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <x-form-fields.advanced.text-common
                                                inputType="text"
                                                inputName="isbn_no" 
                                                inputValue="{{ old('isbn_no') ?? $book->isbn_no }}" 
                                                inputValidationID="isbn_no"
                                                inputRequired="" 
                                                inputClass="form-control isbn_no"
                                                labelText="ISBN"
                                                disabled=""
                                                maxlength="100">
                                                <label for="isbn_no" class="form-label">ISBN</label>
                                            </x-form-fields.advanced.text-common>
                                        </div>
                                        <div class="col-xl-6">
                                            <x-form-fields.advanced.select2-single
                                                inputName="cover"
                                                inputValidationID="cover"
                                                inputValue="{{ old('cover') ?? $book->cover }}"
                                                hideValue=""
                                                inputRequired=""
                                                inputTags="false"
                                                inputClass="form-control cover"
                                                :options="$coverTypes"
                                                optionValueKey="id"
                                                optionLabelKey="title"
                                                hasChildren="false"
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData=""
                                                ajaxRouteName=""
                                                ajaxInputLength=""
                                                labelText="Cover Type">
                                                <label for="cover" class="form-label">Cover Type</label>
                                            </x-form-fields.advanced.select2-single>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.dropify
                                                inputName="pdf_file"
                                                inputClass="form-control-file dropify pdf_file"
                                                inputValidationID="pdf_file"
                                                inputRequired=""
                                                height="100"
                                                maxSize="5M"
                                                extentions="pdf"
                                                accepts=".pdf"
                                                multiple="false">
                                                <label class="form-label" for="img">PDF (Max: 5MB)</label>
                                                 @if(!empty($book->pdf_file))
                                                    <div class="img-container p-2 d-flex align-items-center">
                                                        <h2 class="text-danger p-1"><i class="fa-solid fa-file-pdf"></i></h2>
                                                        <span class="text-muted">{{ $book->title . '.pdf' }}</span>
                                                    </div>
                                                    <input type="hidden" name="old_pdf_file" value="{{ $book->pdf_file }}">
                                                @endif
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.dropify
                                                inputName="pdf_image_path[]"
                                                inputClass="form-control-file dropify pdf_image_path"
                                                inputValidationID="pdf_image_path"
                                                inputRequired=""
                                                height="100"
                                                maxSize="2M"
                                                extentions="jpeg jpg png gif webp svg"
                                                accepts=".jpg, .jpeg, .gif, .png, .webp, .svg"
                                                multiple="true">
                                                <label class="form-label" for="pdf_image_path">PDF Images</label>
                                                <div class="row">
                                                    @if(!empty($book->pdf_images))
                                                        @foreach($book->pdf_images as $imagePdf)
                                                            <input type="checkbox" name="remove_pdf_images[]" value="{{ $imagePdf->id }}" id="delete-pdf-img-{{ $imagePdf->id }}" hidden>
                                                            <div class="col-lg-1 col-sm-2 col-3 pdf_preview">
                                                                <div class="mb-2">
                                                                    <div class="upload-wrap pt-1">
                                                                        <div class="upload-images">
                                                                            <img alt="PDF Images" class="img-fluid rounded" src="{{ $cdn_url.'/'.$imagePdf->pdf_image_path }}" width='100'>
                                                                            <a class="delete delete-pdf-images close" id="deletePdf-{{ $imagePdf->id }}" data-pdf-img-id="{{ $imagePdf->id }}" href="#"> <i class="fas fa-times-circle delete-gal-img"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </x-form-fields.advanced.dropify>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.select2-multiple
                                                inputName="tag_id[]"
                                                inputValidationID="tag_id"
                                                inputValue="{{ implode(',' , $tagsValue) }}"
                                                hideValue=""
                                                inputRequired=""
                                                inputTags="true"
                                                inputClass="form-control tag_id"
                                                :options="$tagsOptions"
                                                optionValueKey="name"
                                                optionLabelKey="name"
                                                hasChildren="false"
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData="true"
                                                ajaxRouteName="admin.tags.get"
                                                ajaxInputLength="2"
                                                labelText="Select Tags">
                                                <label for="tag_id" class="form-label">Tags</label>
                                            </x-form-fields.advanced.select2-multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section id="product-price-stock-variant-sec" class="product-specification-sec mb-3 pt-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="social-header">
                                                    <h4 class="me-3">Price & Stock</h4>
                                                    <hr>
                                                    <div class="price-stock @error('regular_price') is-invalid @enderror">
                                                        <div class="form-group">
                                                            <div class="row mt-4 apply-to-all">
                                                                <div class="col-xl-4">
                                                                    <x-form-fields.advanced.number 
                                                                        inputName="sale_price" 
                                                                        inputValidationID="sale_price"
                                                                        inputClass="form-control sale_price"
                                                                        inputValue="{{ old('sale_price') ?? $book->sale_price }}" 
                                                                        inputRequired="required" 
                                                                        labelText="Sale Price" 
                                                                        minimumValue="0" 
                                                                        maximumValue="" 
                                                                        steps="1">
                                                                        <label for="sale_price" class="form-label required">Sale Price <span>*</span></label>
                                                                    </x-form-fields.advanced.number>
                                                                </div>
                                                                
                                                                <div class="col-xl-4">
                                                                    <x-form-fields.advanced.number 
                                                                        inputName="regular_price" 
                                                                        inputValidationID="regular_price"
                                                                        inputClass="form-control regular_price"
                                                                        inputValue="{{ old('regular_price') ?? $book->regular_price }}" 
                                                                        inputRequired="" 
                                                                        labelText="Regular Price" 
                                                                        minimumValue="0" 
                                                                        maximumValue="" 
                                                                        steps="1">
                                                                        <label for="regular_price" class="form-label">Regular Price</label>
                                                                    </x-form-fields.advanced.number>
                                                                </div>
                                                                
                                                                {{-- <div class="col-xl-2">
                                                                    <x-form-fields.advanced.text-common 
                                                                        inputType="text"
                                                                        inputName=""
                                                                        inputValidationID="sku"
                                                                        inputValue=""
                                                                        inputRequired=""  
                                                                        inputClass="form-control sku"
                                                                        labelText="Sku" 
                                                                        disabled="" 
                                                                        maxlength="100" 
                                                                    />
                                                                </div>  --}}
                                                                <div class="col-xl-4">
                                                                    <x-form-fields.advanced.number 
                                                                        inputName="quantity" 
                                                                        inputValidationID="quantity"
                                                                        inputClass="form-control quantity"
                                                                        inputValue="{{ old('quantity') ?? $book->quantity }}" 
                                                                        inputRequired="" 
                                                                        labelText="Quantity" 
                                                                        minimumValue="0" 
                                                                        maximumValue="" 
                                                                        steps="1">
                                                                        <label for="quantity" class="form-label">Quantity</label>
                                                                    </x-form-fields.advanced.number>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.text-area
                                                inputName="short_description"
                                                inputClass="form-control short_description"
                                                inputValidationID="short_description"
                                                inputValue="{{ old('short_description') ?? $book->short_description }}"
                                                inputRequired=""
                                                labelText="Why Read This Book?"
                                                rows="4"
                                                cols=""
                                                maxlength="1000">
                                                <label for="short_description" class="form-label">Why Read This Book?</label>
                                            </x-form-fields.advanced.text-area>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.ckeditor
                                                inputName="description" 
                                                inputValidationID="description"
                                                inputClass="form-control description"
                                                inputValue="{{ old('description') ?? $book->description }}" 
                                                inputRequired="" 
                                                labelText="Book Description" 
                                                maxlength="60000"
                                                imageUploadPath="media/uploads/books/inner">
                                                <label for="description" class="form-label">Book Description</label>
                                            </x-form-fields.advanced.ckeditor>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-xl-12">
                                            <x-form-fields.advanced.select2-multiple
                                                inputName="tag_id[]"
                                                inputValidationID="tag_id"
                                                inputValue="{{ implode(',' , $tagsValue) }}"
                                                hideValue=""
                                                inputRequired=""
                                                inputTags="true"
                                                inputClass="form-control tag_id"
                                                :options="$tagsOptions"
                                                optionValueKey="name"
                                                optionLabelKey="name"
                                                hasChildren="false"
                                                childname=""
                                                childValueKey=""
                                                childLabelKey=""
                                                getAjaxData="true"
                                                ajaxRouteName="admin.tags.get"
                                                ajaxInputLength="2"
                                                labelText="Select Tags">
                                                <label for="tag_id" class="form-label">Tags</label>
                                            </x-form-fields.advanced.select2-multiple>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="pre_order" class="form-label required">Pre-Order <span class="text-danger">*</span></label>
                                            <div class="d-flex align-items-center mt-3">
                                                <div class="form-check-inline">
                                                    <x-form-fields.advanced.radio-checkbox 
                                                        inputClass="form-check-input me-3" 
                                                        inputValidationID="pre_order1" 
                                                        isChecked="{{ (old('pre_order', $book->pre_order) == 1) ? 'checked' : '' }}" 
                                                        inputType="radio" 
                                                        inputName="pre_order" 
                                                        inputValue="1" 
                                                        inputRequired="" 
                                                        labelText="Yes">
                                                        <label for="pre_order1" class="form-label">Yes</label>
                                                    </x-form-fields.advanced.radio-checkbox>
                                                </div>
                                                <div class="form-check-inline">
                                                    <x-form-fields.advanced.radio-checkbox 
                                                        inputClass="form-check-input me-3" 
                                                        inputValidationID="pre_order2" 
                                                        isChecked="{{ (old('pre_order', $book->pre_order) == 2) ? 'checked' : '' }}" 
                                                        inputType="radio" 
                                                        inputName="pre_order" 
                                                        inputValue="2" 
                                                        inputRequired="" 
                                                        labelText="No">
                                                        <label for="pre_order2" class="form-label">No</label>
                                                    </x-form-fields.advanced.radio-checkbox>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="status" class="form-label required">Status <span class="text-danger">*</span></label>
                                            <div class="d-flex align-items-center mt-3">
                                                <div class="form-check-inline">
                                                    <x-form-fields.advanced.radio-checkbox 
                                                        inputClass="form-check-input me-3" 
                                                        inputValidationID="active" 
                                                        isChecked="{{ (old('status', $book->status) == 1) ? 'checked' : '' }}" 
                                                        inputType="radio" 
                                                        inputName="status" 
                                                        inputValue="1" 
                                                        inputRequired="" 
                                                        labelText="Active">
                                                        <label for="active" class="form-label">Active</label>
                                                    </x-form-fields.advanced.radio-checkbox>
                                                </div>
                                                <div class="form-check-inline">
                                                    <x-form-fields.advanced.radio-checkbox 
                                                        inputClass="form-check-input me-3" 
                                                        inputValidationID="inactive" 
                                                        isChecked="{{ (old('status', $book->status) == 2) ? 'checked' : '' }}" 
                                                        inputType="radio" 
                                                        inputName="status" 
                                                        inputValue="2" 
                                                        inputRequired="" 
                                                        labelText="Inactive">
                                                        <label for="inactive" class="form-label">Inactive</label>
                                                    </x-form-fields.advanced.radio-checkbox>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- shipping & warranty  --}}
                        {{-- <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="social-header">
                                                <h4 class="me-3">Shipping & Warranty</h4>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="input-group mb-3">
                                                <x-form-fields.advanced.number 
                                                    inputName="package_weight" 
                                                    inputValidationID="package_weight"
                                                    inputClass="form-control stock package_weight"
                                                    inputValue="{{old('package_weight')}}" 
                                                    inputRequired="required" 
                                                    labelText="Package Weight" 
                                                    minimumValue="0" 
                                                    maximumValue="" 
                                                    steps="1">
                                                    <label for="package_weight" class="form-label required">Package Weight <span>*</span></label>
                                                </x-form-fields.advanced.number>

                                                <span class="" id="basic-addon2">
                                                    <x-form-fields.advanced.select2-single
                                                        inputName="weight_unit"
                                                        inputValidationID="weight_unit"
                                                        inputValue="{{ old('weight_unit') }}"
                                                        hideValue=""
                                                        inputRequired="required"
                                                        inputClass="form-control weight_unit"
                                                        :options="$weightUnit"
                                                        optionValueKey="unit"
                                                        optionLabelKey="unit"
                                                        hasChildren="false"
                                                        childname=""
                                                        childValueKey=""
                                                        childLabelKey=""
                                                        getAjaxData=""
                                                        ajaxRouteName=""
                                                        ajaxInputLength=""
                                                        labelText="Weight Unit">
                                                        <label for="weight_unit" class="form-label required">Weight Unit <span>*</span></label>
                                                    </x-form-fields.advanced.select2-single>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <x-form-fields.advanced.number 
                                                    inputName="package_length" 
                                                    inputValidationID="package_length"
                                                    inputClass="form-control stock package_length"
                                                    inputValue="{{old('package_length')}}" 
                                                    inputRequired="required" 
                                                    labelText="Package Length (cm)" 
                                                    minimumValue="0" 
                                                    maximumValue="" 
                                                    steps="1">
                                                    <label for="package_length" class="form-label required">Package Length (cm) <span>*</span></label>
                                                </x-form-fields.advanced.number>
                                            </div>
                                            <div class="col-xl-4">
                                                <x-form-fields.advanced.number 
                                                    inputName="package_width" 
                                                    inputValidationID="package_width"
                                                    inputClass="form-control stock package_width"
                                                    inputValue="{{old('package_width')}}" 
                                                    inputRequired="required" 
                                                    labelText="Package Width (cm)" 
                                                    minimumValue="0" 
                                                    maximumValue="" 
                                                    steps="1">
                                                    <label for="package_width" class="form-label required">Package Width (cm) <span>*</span></label>
                                                </x-form-fields.advanced.number>
                                            </div>
                                            <div class="col-xl-4">
                                                <x-form-fields.advanced.number 
                                                    inputName="package_height" 
                                                    inputValidationID="package_height"
                                                    inputClass="form-control stock package_height"
                                                    inputValue="{{old('package_height')}}" 
                                                    inputRequired="required" 
                                                    labelText="Package Height (cm)" 
                                                    minimumValue="0" 
                                                    maximumValue="" 
                                                    steps="1">
                                                    <label for="package_height" class="form-label required">Package Height (cm) <span>*</span></label>
                                                </x-form-fields.advanced.number>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="status" class="form-label required">Is Dangerous <span class="text-danger">*</span></label>
                                                <div class="d-flex align-items-center mt-3">
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3" 
                                                            inputValidationID="yes" 
                                                            isChecked="{{ !empty(old('is_dangerous')) && old('is_dangerous')==1 ? 'checked' : '' }}"
                                                            inputType="radio" 
                                                            inputName="is_dangerous" 
                                                            inputValue="1" 
                                                            inputRequired="" 
                                                            labelText="Yes">
                                                            <label for="yes" class="form-label">Yes</label>
                                                        </x-form-fields.advanced.radio-checkbox>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <x-form-fields.advanced.radio-checkbox 
                                                            inputClass="form-check-input me-3" 
                                                            inputValidationID="no"
                                                            isChecked="{{ !empty(old('is_dangerous')) ? (old('is_dangerous')==2 ? 'checked' : '') : 'checked' }}" 
                                                            inputType="radio" 
                                                            inputName="is_dangerous" 
                                                            inputValue="2" 
                                                            inputRequired="" 
                                                            labelText="No">
                                                            <label for="no" class="form-label">No</label>
                                                        </x-form-fields.advanced.radio-checkbox>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xl-6">
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <small class="text-primary fw-bold">More Warranty Settings</small>
                                                        </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse border-0" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body px-0">
                                                                <x-form-fields.advanced.select2-single
                                                                    inputName="warranty_type"
                                                                    inputValidationID="warranty_type"
                                                                    inputValue="{{ old('warranty_type') }}"
                                                                    hideValue=""
                                                                    inputRequired=""
                                                                    inputClass="form-control warranty_type"
                                                                    :options="$warrantyTypes"
                                                                    optionValueKey="id"
                                                                    optionLabelKey="title"
                                                                    hasChildren="false"
                                                                    childname=""
                                                                    childValueKey=""
                                                                    childLabelKey=""
                                                                    getAjaxData=""
                                                                    ajaxRouteName=""
                                                                    ajaxInputLength=""
                                                                    labelText="Warranty Type">
                                                                    <label for="warranty_type" class="form-label required">Warranty Type </label>
                                                                </x-form-fields.advanced.select2-single>

                                                                <x-form-fields.advanced.select2-single
                                                                    inputName="warranty_id"
                                                                    inputValidationID="warranty_id"
                                                                    inputValue="{{ old('warranty_id') }}"
                                                                    hideValue=""
                                                                    inputRequired=""
                                                                    inputClass="form-control warranty_id"
                                                                    :options="$warranties"
                                                                    optionValueKey="id"
                                                                    optionLabelKey="name"
                                                                    hasChildren="false"
                                                                    childname=""
                                                                    childValueKey=""
                                                                    childLabelKey=""
                                                                    getAjaxData=""
                                                                    ajaxRouteName=""
                                                                    ajaxInputLength=""
                                                                    labelText="Warranty">
                                                                    <label for="warranty_id" class="form-label required">Warranty</label>
                                                                </x-form-fields.advanced.select2-single>

                                                                <x-form-fields.advanced.text-common 
                                                                    inputType="text"
                                                                    inputName="warranty_policy"
                                                                    inputValidationID="warranty_policy"
                                                                    inputValue="{{old('warranty_policy')}}"
                                                                    inputRequired=""  
                                                                    inputClass="form-control warranty_policy"
                                                                    labelText="Warranty Policy" 
                                                                    disabled="" 
                                                                    maxlength="200">
                                                                    <label for="warranty_policy" class="form-label required">Warranty Policy</label>
                                                                </x-form-fields.advanced.text-common>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-xl-3">
                        <x-product-submission-card cardLabel="Publish" submitLabel="Update" draftLabel="Draft" discardLabel="Discard" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click','.delete-product-images', function (e) {
                e.preventDefault();
                // Get the image ID from the data attribute
                const imageId = $(this).data('gal-img-id');

                // Check the hidden checkbox for the specific image
                $(`#delete-prod-img-${imageId}`).prop('checked', true);

                // Remove the parent .col-lg-1 container from the DOM
                $(this).closest('.gallery_preview').remove();

                if($('.gallery_preview').length == 0){
                    $('#image_path').attr('required', true);
                }
            });
            $(document).on('click','.delete-pdf-images', function (e) {
                e.preventDefault();
                // Get the image ID from the data attribute
                const imageId = $(this).data('pdf-img-id');

                // Check the hidden checkbox for the specific image
                $(`#delete-pdf-img-${imageId}`).prop('checked', true);

                // Remove the parent .col-lg-1 container from the DOM
                $(this).closest('.pdf_preview').remove();

                if($('.pdf_preview').length == 0){
                    $('#pdf_image_path').attr('required', false);
                }
            });
        });
    </script>
@endpush