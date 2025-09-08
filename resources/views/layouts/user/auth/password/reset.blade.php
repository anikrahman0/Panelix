@extends('layouts.frontend.base.app')

@section('title', 'Reset Password')

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
                            <h4>পাসওয়ার্ড পরিবর্তন</h4>
                        </div>
                        <div class="login-box">
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="row">
                                    <div class="col-12 d-none">
                                        <div class="mb-3">
                                            <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback ml-2 mb-2" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input class="form-control @error('password') is-invalid  @enderror" id="password" name="password" type="password" placeholder="New Password" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm New Password">
                                            <span class="invalid-feedback error-text password-error ml-2 mb-2" role="alert"> </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn login btn_black sm text-white" id="user-login" type="submit"> Reset Password</button>
                                    </div>
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
@endpush
