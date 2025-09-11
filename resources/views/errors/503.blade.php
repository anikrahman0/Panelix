@extends('layouts.frontend.base.app')

@section('title', '503 - Service Unavailable')

@section('content')
    <div class="error-page">
        <div class="text-center px-4">
            <!-- Icon -->
            
            <!-- Error Code -->
            
            <h1 class="error-code"><i class="fas fa-tools fa-lg"></i> 503</h1>

            <!-- Title -->
            <h2 class="error-title">Service Temporarily Unavailable</h2>

            <!-- Message -->
            <p class="error-message">Sorry, the service is temporarily unavailable. Please try again after some time.</p>

        </div>
    </div>
@endsection
