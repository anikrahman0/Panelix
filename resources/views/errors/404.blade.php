@extends('layouts.frontend.base.app')

@section('title', '404 - Page Not Found')

@section('content')
    <div class="error-page bg-404">
        <div>
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Page Not Found</h2>
            <p class="error-message mt-4 mb-5">Sorry, The requested page could not be found।</p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-dark btn-lg">Go to Home</a>
        </div>
    </div>
@endsection