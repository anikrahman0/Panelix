@extends('layouts.frontend.base.app')

@section('title', 'User Registration')

@push('css')
    
@endpush


@section('meta')
    
@endsection


@section('content')
<section>
    <div class="registration-page-area">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-6 m-auto">
                    <div class="regi-box">
                        <div class="regi-title">
                            <h4>রেজিষ্ট্রেশন করুন</h4>
                        </div>
                            <form id="registerForm" action="{{ route('user.register.submit') }}" method="POST">
                                @csrf
                                <div class="user_details">
                                    <div class="input_box">
                                        <label for="name">Full Name <span class="text-danger">*</span></label>
                                        <input class="form-control" id="name" name="name" value="{{ old('name') }}" type="text" placeholder="Full Name" required>
                                        <span class="invalid-feedback error-text name-error ml-2 mb-2" role="alert"> </span>
                                    </div>
                                    <div class="input_box">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Email" required>
                                        <span class="invalid-feedback error-text email-error ml-2 mb-2" role="alert"> </span>
                                    </div>
                                    <div class="input_box">
                                        <label for="phone">Phone Number</label>
                                        <input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" type="text" placeholder="Phone Number">
                                        <span class="invalid-feedback error-text phone-error ml-2 mb-2" role="alert"> </span>
                                    </div>
                                    <div class="input_box">
                                        <label for="pass">Password <span class="text-danger">*</span></label>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
                                        <span class="invalid-feedback error-text password-error ml-2 mb-2" role="alert"> </span>
                                    </div>
                                    <div class="input_box">
                                        <label for="confirmPass">Confirm Password <span class="text-danger">*</span></label>
                                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" required>
                                        <span class="invalid-feedback error-text password_confirmation-error ml-2 mb-2" role="alert"> </span>
                                    </div>
                                </div>
                                <div class="reg_btn">
                                    <button type="button" id="user-register"> <i class="fas fa-spinner fa-spin me-2 d-none spinner"></i> Register</button>
                                </div>
                                <div class="sign-up-box">
                                    <p>Already have an account?</p><a href="{{ route('user.login') }}">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection


@push('js')
<script>
    // user registration submit
    $('#user-register').on('click', function (e) {
        e.preventDefault();

        let form = $('#registerForm');
        let formData = form.serialize();

        // Show spinner and disable the button
        $(this).prop('disabled', true).addClass('disabled').css('pointer-events', 'none');
        $('.spinner').removeClass('d-none'); // Show spinner


        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            beforeSend: function () {
                $('.error-text').text('');
            },
            success: function (response) {
                if (response.status === 'success') {
                    form[0].reset();
                    window.location.href = "/user/dashboard";
                }
                $('#user-register').prop('disabled', false).removeClass('disabled').css('pointer-events', '');
                $('.spinner').addClass('d-none'); // Hide spinner
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Display validation errors
                    let errors = xhr.responseJSON.errors;
                    let form = $('#registerForm');

                    $.each(errors, function (key, value) {
                        form.find(`.${key}-error`).text(value[0]);
                    });

                    $('#user-register').prop('disabled', false).removeClass('disabled').css('pointer-events', '');
                    $('.spinner').addClass('d-none'); // Hide spinner
                } else {
                    console.log('Something went wrong. Please try again.');
                }
            }
        });
    });
</script>
@endpush
