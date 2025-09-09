@extends('layouts.frontend.base.app')

@section('title', '')

@push('css')
    
@endpush

@section('content')
<!-- Logo -->
    <img src="{{ asset('assets/frontend/media/common/logo.png') }}" alt="Panelix Logo" class="logo">

    <!-- Title -->
    <h1>Panelix 1.0</h1>

    <!-- Admin Panel Link -->
    <a href="{{ route('admin.loginpage') }}" class="btn-admin">Go to Admin Panel</a>

    <!-- Footer -->
    <footer>
        &copy; {{ now()->year }} Panelix. Developed by Anik Rahman.
    </footer>
@endsection


@push('js')

@endpush