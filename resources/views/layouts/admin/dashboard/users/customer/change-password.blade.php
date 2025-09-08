@extends('layouts.admin.base.app')
@section('title', 'Dashboard')
{{-- @push('css')
@endpush --}}
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Update User Password" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item url="{{ route('admin.users.index-user') }}" label="Users" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.users.customer.update-password', $user->id) }}" label="Update User Password" />
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-form-fields.advanced.change-user-password action="{{ route('admin.users.customer.update-password', $user->id) }}"/>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <!-- copy generate password js--> 
    <script src="{{ asset('assets/admin/js/generate-password.js') }}"></script>
@endpush