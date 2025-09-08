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
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Update Profile" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.users.index-admin') }}" label="Admin Users" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.users.edit.admin-profile', $user->id) }}" label="Update Profile" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('admin.users.update-admin-profile', $user->id)}}" enctype="multipart/form-data">
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
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <x-form-fields.dropify inputName="image_path" inputValue="" inputRequired="false" labelText="Profile Image <small>(Square. Preferable 150x150)</small>" height="80" maxSize="2M" extentions="jpeg jpg png gif webp svg" accepts=".jpg, .jpeg, .gif, .png, .webp, .svg" multiple="false" />
                                            </div>
                                            <div class="col-xl-2">
                                                <div class="form-group">
                                                    @if($imageExists)
                                                        <x-profile-image src="{{asset($cdn_url.'/'.auth()->guard('admin')->user()->image_path)}}" imgContainerClass="mt-3" width="110" height="110"/>
                                                    @else
                                                        <x-profile-image src="{{asset('assets/common/default-avatar.jpg')}}" imgContainerClass="" width="110" height="110"/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <x-form-fields.text-area inputName="address" inputValue="{{old('address') ?? $user->address}}" inputRequired="false" rows="4" cols="50" maxlength="255" inputType="text" labelText="Address" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <x-form-fields.text-common inputName="name" inputValue="{{old('name') ?? $user->name }}" inputRequired="true" maxlength="100" inputType="text" labelText="Name" placeholder="" />
                                            </div>
                                            <div class="col-xl-6">
                                                <x-form-fields.text-common inputName="email" inputValue="{{old('email') ?? $user->email }}" inputRequired="true" maxlength="100" inputType="email" labelText="Email" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <x-form-fields.select inputName="gender" inputValue="{{old('gender', $user->gender)}}" inputRequired="true" :options="$gender" optionValueKey="id" optionLabelKey="type" labelText="Gender" />
                                            </div>
                                            <div class="col-xl-6">
                                                <x-form-fields.text-common inputName="phone" inputValue="{{old('phone') ?? $user->phone }}" inputRequired="false" maxlength="20" inputType="text" labelText="Phone" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <x-form-fields.select2-single inputName="country_id" inputValue="{{old('country_id', $user->country_id)}}" inputRequired="true" :options="$countries" optionValueKey="id" optionLabelKey="country_name" labelText="Country" />
                                            </div>
                                        </div>
                                        {{-- @endif --}}
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