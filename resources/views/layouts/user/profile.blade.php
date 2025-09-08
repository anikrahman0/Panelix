@extends('layouts.frontend.base.app')

@section('title', 'User Profile')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush


@section('meta')

@endsection

@section('content')
    <div class="dashboard-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4">
                    @include('layouts.user.partials.sidebar')
                </div>
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <div class="dash-heading">
                        <h1>Personal Details </h1>
                    </div>
                    <div class="people-content">
                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="people-info user-profile-section">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="mb-4">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" maxlength="100" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div>
                                            <label class="form-label">Mobile Number</label>
                                            <input type="text" class="form-control" maxlength="15" name="phone" value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Country <span class="text-danger">*</span></label>
                                            <div class="input-row form-group-field">
                                                <select class="contact-drop-down @error('country_id') is-invalid @enderror"  name="country_id" id="country_id" required style="width: 100%">
                                                    <option>Choose Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}"  {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                                    @endforeach
                                                </select> 
                                                @error('country_id')
                                                    <small class="error text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                                            <div class="input-row form-group-field">
                                                <select class="contact-drop-down @error('state_id') is-invalid @enderror" name="state_id" id="state_id" required style="width: 100%">
                                                    <option>Choose State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}" {{ old('state_id', $user->state_id) == $state->id ? 'selected' : '' }}>
                                                                {{ $state->name }}
                                                            </option>
                                                        @endforeach
                                                </select> 
                                                @error('state_id')
                                                    <small class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label for="city_id" class="form-label">City <span class="text-danger">*</span></label>
                                            <div class="input-row form-group-field">
                                                <select class="contact-drop-down @error('city_id') is-invalid @enderror" name="city_id" id="city_id" required style="width: 100%">
                                                    <option>Choose City</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}" {{ old('city_id', $user->city_id) == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                </select> 
                                                @error('city_id')
                                                    <small class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label for="zip_code" class="form-label">Zip Code</label>
                                            <div class="input-row form-group-field">
                                                <input type="text" class="form-control name-from @error('zip_code') is-invalid @enderror" id="zip_code"  name="zip_code" value="{{ old('zip_code', $user->zip) }}" placeholder="Zip code">
                                                @error('zip_code')
                                                    <small class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <div class="input-row form-group-field">
                                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Your address" id="address" rows="4">{{ old('address', $user->address) }}</textarea>
                                                @error('address')
                                                    <small class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="upload-img">
                                    <div class="upload__img-wrap"></div>
                                    <div class="upload-file">
                                        <div class="photo-upload">
                                            <div class="photo-preview">
                                                @if(!empty($user->image_path) && $user->account_type != 1)
                                                    <div id="imagePreview"
                                                        style="background-image:url({{ $cdn_url.'/'.$user->image_path }});">
                                                    </div>
                                                @elseif(!empty($user->image_path))
                                                    <div id="imagePreview"
                                                        style="background-image:url({{ $cdn_url.'/'.$user->image_path }});">
                                                    </div>
                                                @else
                                                    <div id="imagePreview"
                                                        style="background-image:url({{ asset('assets/frontend/media/imgAll/bg/dummy-image.jpg') }});">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="photo-edit">
                                                <input type="file" class="form-control d-none" id="imageUpload" name="image_path"
                                                    data-allowed-file-extensions="jpeg jpg png gif webp" accept=".png, .jpg, .jpeg .gif .webp">
                                                <label for="imageUpload">Upload Photo</label>
                                            </div>
                                            @error('image_path')
                                                <small class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="update-btn-wrap text-center">
                                <button type="submit" class="btn update-btn" >Update Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#country_id").select2({
            placeholder: "Select Country",
            allowClear: true,
        });
        $("#state_id").select2({
            placeholder: "Select State",
            allowClear: true,
        });
        $("#city_id").select2({
            placeholder: "Select City",
            allowClear: true,
        });
        // Handle country change
        $(document).on('change', '#country_id', function () {
            var selectedData = $(this).select2('data');
            $(`#city_id`).empty();
            $.ajax({
                url: "{{ route('user.states.ajax') }}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    'country_id': selectedData[0]?.id
                },
                success: function (response) {
                    let data = [{ id: '', text: 'Select State' }];
                    (response.states || []).forEach(element => {
                        data.push({ id: element.id, text: element.name });
                    });

                    $('#state_id').empty().select2({
                        data: data,
                        placeholder: 'Select State'
                    });
                }
            });
        });

        // Handle state change
        $(document).on('change', '#state_id', function () {
            var selectedData = $(this).select2('data');
            $.ajax({
                url: "{{ route('user.cities.ajax') }}",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    'state_id': selectedData[0]?.id
                },
                success: function (response) {
                    let data = [{ id: '', text: 'Select City' }];
                    (response.cities || []).forEach(element => {
                        data.push({ id: element.id, text: element.name });
                    });

                    $('#city_id').empty().select2({
                        data: data,
                        placeholder: 'Select City'
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").on('change', function() {
            readURL(this);
        });
        $('.remove-img').on('click', function() {
            var imageUrl = "images/no-img-avatar.png";
            $('.avatar-preview, #imagePreview').removeAttr('style');
            $('#imagePreview').css('background-image', 'url(' + imageUrl + ')');
        });
    });
</script>
{{-- <script>
    $(document).ready(function () {
        // Toggle password visibility for New Password
        $('#toggleNewPassword').click(function () {
            const passwordField = $('#newPassword');
            const icon = $('#newPasswordIcon');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });

        // Toggle password visibility for Confirm Password
        $('#toggleConfirmPassword').click(function () {
            const passwordField = $('#confirmPassword');
            const icon = $('#confirmPasswordIcon');
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });
    });
</script> --}}
@endpush
