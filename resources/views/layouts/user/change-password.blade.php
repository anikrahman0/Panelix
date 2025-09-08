@extends('layouts.frontend.base.app')

@section('title', 'Change Password')

@push('css')
    
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
                    <h1>Password</h1>
                </div>
                <form action="{{ route('user.password.update') }}" method="POST">
                    <div class="changPassw-content">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-4">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password" placeholder="Enter current password" maxlength="50">
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-4">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password" name="new_password" placeholder="Enter new password" maxlength="50">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-4">
                                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                        id="confirm_password" name="confirm_password" placeholder="Confirm new password" maxlength="50">
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="SavePass-btn-wrap text-center"> <button class="btn SavePass-btn" type="submit">Save</button> </div>
                </form>
            </div>
        </div>
    </div>
</div>   
@endsection


@push('js')
    
@endpush
