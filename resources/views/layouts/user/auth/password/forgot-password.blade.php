@extends('layouts.frontend.base.app')

@section('title', 'User Login')

@push('css')
    
@endpush


@section('meta')
    
@endsection


@section('content')
<section class="forgot-pass-page-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto">
                @if (session('status'))
                    <x-frontend.common.success message="Your password reset link has been sent to your email address" />
                @endif
                <form action="{{ route('user.password.email') }}" method="POST">
                    @csrf
                    <div class="forgot-pass-page-wrapper">
                        <div class="forgot-pass-loginTop">
                            <img class="img-fluid" src="{{asset('assets/frontend/media/imgAll/bg/13731195.png')}}" alt="" title="">
                            <h3>Forgot Password?</h3>
                            <p>Don't worry. Just enter your email address below and we'll send you some
                                instructions.
                            </p>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-icons">
                                    <i class="fa-regular fa-envelope"></i>
                                    <input class="input-field" id="email" value="{{ old('email') }}" name="email" placeholder="abcd@gmail.com" type="email">
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback ml-2 mb-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button name="submit" type="submit">Submit</button>
                            <p><i class="fa-solid fa-angle-left"></i> Back to <a href="{{ route('user.login') }}"> Home</a> </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>   
@endsection


@push('js')
@endpush
