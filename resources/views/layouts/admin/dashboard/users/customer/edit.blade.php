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
                                <x-page-title header="Update User" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.users.index-user') }}" label="User" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.users.edit-user',$user->id) }}" label="Update User" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('admin.users.update-user',$user->id)}}" enctype="multipart/form-data">
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
                                        <x-users.customer.edit-form :imageExists="$imageExists" :user="$user" :gender="$gender" :countries="$countries" :states="$states" :cities="$cities" :status="$status"/>
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

            // country on change event
            $(document).on('change', '#country_id', function () {
                var selectedData = $(this).select2('data'); // Get an array of selected data items
                console.log(selectedData);
                $.ajax({
                    url: "{{route('admin.cities.states')}}",
                    type: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        'country_id': selectedData[0].id
                    },
                    success: function (response) {
                        console.log(response);
                        let data = [{id: '', text: 'Select State'}];
                        (response.states).forEach(element => {
                            data.push({id: element.id, text: element.name})
                        });

                        $('#state_id').empty();
                        $('#city_id').empty();
                        $('#state_id').select2({
                            data: data,
                            placeholder: 'Select State'
                        });
                    }
                });
            });

            // state on change event
            $(document).on('change', '#state_id', function () {
                var selectedData = $(this).select2('data'); // Get an array of selected data items
                console.log(selectedData);
                $.ajax({
                    url: "{{route('admin.cities.ajax')}}",
                    type: "POST",
                    data: {
                        "_token": "{{csrf_token()}}",
                        'state_id': selectedData[0].id
                    },
                    success: function (response) {
                        console.log(response);
                        let data = [{id: '', text: 'Select City'}];
                        (response.cities).forEach(element => {
                            data.push({id: element.id, text: element.name})
                        });

                        $('#city_id').empty();
                        $('#city_id').select2({
                            data: data,
                            placeholder: 'Select City'
                        });
                    }
                });
            });
        });
    </script>
@endpush