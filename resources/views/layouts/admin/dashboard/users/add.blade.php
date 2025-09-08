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
                                <x-page-title header="Add New User" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.users.index-user') }}" label="Users" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.users.add') }}" label="Add New User" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('admin.users.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="digital-add needs-validation">
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <x-form-fields.advanced.select
                                                inputName="user_type"
                                                inputClass="form-control form-select user_type" 
                                                inputValidationID="user_type"
                                                inputValue="{{old('user_type')}}"
                                                inputRequired="required"
                                                :options="$userType"
                                                optionValueKey="id"
                                                optionLabelKey="type"
                                                labelText="Select User Type">
                                                <label for="user_type" class="form-label required">User Type <span>*</span></label>
                                            </x-form-fields.advanced.select>
                                        </div>
                                    </div>
                                    <div id="form-selected">
                                        @if(old('user_type') == 1)
                                            <x-users.admin.add-form :roles="$adminRoles" :countries="$countries" :gender="$gender"/>
                                        @elseif(old('user_type') == 2)
                                            <x-users.customer.add-form :countries="$countries" :gender="$gender"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <x-submission-card cardLabel="Publish" submitLabel="Save" discardLabel="Discard" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.image_path').dropify();
            // password generate
            $(document).on('click', '#generatePassword', function () {
                $('#copyButton').show();
                let password = generateRandomString(15);
                $('#password').val(password);
                $('#password_confirmation').val(password);
            });
            $(document).on('input', '#password', function () {
                if ($(this).val().length > 0) {
                    $('#copyButton').show();
                } else {
                    $('#copyButton').hide();
                }
            });

            $('.user_type').change(function() {
                var userType = $(this).val();
                
                var adminForm =`<x-users.admin.add-form :roles='$adminRoles' :countries='$countries' :gender="$gender" />`;

                var userForm =`<x-users.customer.add-form :countries='$countries' :gender="$gender" />`;

                //admin
                if(userType == 1){
                    $('#form-selected').html('');
                    $('#form-selected').html(adminForm);
                //user
                }else if(userType == 2){
                    $('#form-selected').html('');
                    $('#form-selected').html(userForm);
                }else{
                    $('#form-selected').html('');
                }
                $('.image_path').dropify();
                $('#country_id').select2({
                    placeholder: 'Select Country',
                });
            });

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
        $(document).on('click', '#copyButton', function () {
            var copyInput = $('#password');

            // Temporarily change type to text
            copyInput.attr('type', 'text');

            // Select and copy
            copyInput[0].select();
            document.execCommand('copy');
            $('#copyMessage').removeClass('d-none');

            // Change back to password
            copyInput.attr('type', 'password');

            setTimeout(function () {
                $('#copyMessage').addClass('d-none');
            }, 2000);
        });
        // generate & copy password start
        function generateRandomString(length = 15) {
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@$%&()_+-?';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }
        // generate & copy password end
    </script>
@endpush