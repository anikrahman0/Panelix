@extends('layouts.frontend.base.app')

@section('title', '')

@push('css')
    
@endpush

@section('content')
<!-- Logo -->
    @if(!empty($settings->logo))
        <img class="img-fluid" src="{{ $cdn_url . '/' . $settings->logo }}" alt="Site Logo" title="Site Logo" width="250">
    @else
        <img class="img-fluid" src="{{ $cdn_url . '/' . config('app.default_logo') }}" alt="Site Logo" title="Site Logo" width="250">
    @endif

    <!-- Title -->
    <p class="mt-4 mb-5 fw-bold fs-18">{{ !empty($settings->site_title) ? $settings->site_title : (config('app.name') ?? 'Panelix') }} {{config('app.version')}}</p>

    <!-- Admin Panel Link -->
    <a href="{{ route('admin.loginpage') }}" class="btn-admin">Go to Admin Panel</a>

    <!-- Footer -->
    <footer>
        @if(!empty($settings->copyright_text))
            {{ $settings->copyright_text }}
        @else
            &copy; {{ now()->year }} Panelix. Developed by Anik Rahman.
        @endif
    </footer>
@endsection


@push('js')

@endpush