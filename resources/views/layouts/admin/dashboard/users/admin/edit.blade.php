@extends('layouts.admin.base.app')
@section('title', 'Dashboard')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Update Admin" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.users.index-admin') }}" label="Admin Users" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.users.edit-admin',$user->id) }}" label="Update Admin" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('admin.users.update-admin',$user->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container-fluid">
            <div class="digital-add needs-validation">
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div id="form-selected">
                                        @if(old('user_type', $user->role->type ?? '') == 1)
                                            <x-users.admin.edit-form :imageExists="$imageExists" :user="$user" :countries="$countries" :gender="$gender" :status="$status"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <x-submission-card cardLabel="Publish" submitLabel="Update" discardLabel="Discard" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
         $(document).ready(function() {
            $('#country_id').select2({
                placeholder: 'Select Country',
            });
            $('.image_path').dropify();
        });
    </script>
@endpush