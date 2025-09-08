@extends('layouts.admin.base.app')
@section('title', 'Update Tag')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Edit Tag" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.tag.index') }}" label="Tags" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.tag.edit',$tag->id) }}" label="Edit Tag" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.tag.update',$tag->id) }}" class="digital-add needs-validation">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="gap-3 col-md-9 mx-auto">
                        <div class="card mb-3">
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <x-form-fields.text-common inputType="text" inputName="name" inputValue="{{old('name') ?? $tag->name}}" inputRequired="true" labelText="Name" pattern="" />
                                        </div>
                                        <div class="col-sm-12">
                                            <x-form-fields.text-common inputType="text" inputName="slug" inputValue="{{old('slug') ?? $tag->slug}}" inputRequired="true" labelText="Slug" pattern="" />
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
