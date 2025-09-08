@extends('layouts.frontend.base.app')

@section('title', 'User Login')

@push('css')
    
@endpush


@section('meta')
    
@endsection


@section('content')
<section>
    <div class="login-page-area">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-5 m-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h4>লগইন করুন</h4>
                        </div>
                        <div class="login-box">
                            <form action="{{route('user.login.submit')}}" method="POST" id="loginForm">
                                @csrf
                                @method('PATCH')
                                @if(Session::has('already_registered'))
                                    <span class="invalid-feedback error-text ml-2 mb-2" role="alert"> 
                                        {{Session::get('already_registered')}}
                                    </span>
                                @endif
                                @if(Session::has('login_required'))
                                    <span class="invalid-feedback error-text ml-2 mb-2" role="alert"> 
                                        {{Session::get('login_required')}}
                                    </span>
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input class="form-control @error('email') is-invalid  @enderror" id="email" name="email" value="{{ old('email') ??  Session::get('registered_email') }}" type="email" placeholder="Email" required>
                                            <span class="invalid-feedback error-text email-error ml-2 mb-2" role="alert"> </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input class="form-control @error('password') is-invalid  @enderror" id="password" name="password" type="password" placeholder="Password" required>
                                            <span class="invalid-feedback error-text password-error ml-2 mb-2" role="alert"> </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="forgot-box mb-3">
                                            <div>
                                                <input class="form-check-input custom-checkbox" id="category1" type="checkbox" name="text">
                                                <label for="category1">Remember me</label>
                                            </div>
                                            <a href="{{ route('user.password.request') }}">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn login btn_black sm text-white" id="user-login" type="submit"><i class="fas fa-spinner fa-spin me-2 d-none spinner"></i> Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="other-log-in">
                            <h6>OR</h6>
                        </div>
                        <div class="log-in-button">
                            <ul>
                                <li> <a href="{{ route('user.login.google') }}" target="_blank"> <i class="fa-brands fa-google me-2"> </i>Google</a></li>
                                <li> <a href="{{ route('user.login.facebook') }}" target="_blank"><i class="fa-brands fa-facebook-f me-2"></i>Facebook </a></li>
                            </ul>
                        </div> --}}
                        <div class="sign-up-box">
                            <p>Don't have an account?</p>
                            <a href="{{ route('user.register') }}">Sign Up</a>
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
        // user login
        $('#user-login').on('click', function (e) {
            e.preventDefault();

            let form = $('#loginForm');
            let formData = form.serialize();

            console.log(formData);
            

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
                    $('#user-login').prop('disabled', false).removeClass('disabled').css('pointer-events', '');
                    $('.spinner').addClass('d-none'); // Hide spinner
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        // Display validation errors specific to the form
                        let errors = xhr.responseJSON.errors;
                        
                        let form = $('#loginForm'); // Replace with the ID of your specific form

                        $.each(errors, function (key, value) {
                            // Find the error container within the specific form using the key
                            form.find(`.${key}-error`).text(value);
                        });

                        // Re-enable buttons and hide spinner
                        $('#user-login').prop('disabled', false).removeClass('disabled').css('pointer-events', '');
                        $('.spinner').addClass('d-none'); // Hide spinner
                    } else {
                        console.log('Something went wrong. Please try again.');
                    }
                }
            });
        });
    </script>
@endpush
