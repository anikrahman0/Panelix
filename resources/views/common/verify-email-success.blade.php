@extends('layouts.frontend.base.app')

@section('title','Verify Success')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('verify-success'))
                <x-frontend.common.success :message="session()->get('verify-success')" />
            @endif
            @if (session('error'))
                <x-frontend.common.error :message="session()->get('error')" />
            @endif
            @if(!session('verify-success') && !session('error'))
                 <x-frontend.common.error message="Something went wrong or the email is already verified" />
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card login-text">
                <div class="card-body verify-body">
                    <small class="me-2">Please click the button for login</small>
                    <a class="btn login-text-btn" href="{{ route('user.login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

