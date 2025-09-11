@extends('layouts.frontend.base.app')

@section('title', '500 - Server Error')

@section('content')
    <div class="error-page">
        <div class="text-center px-4">
            <!-- Icon -->
            
            <!-- Error Code -->
            
            <h1 class="error-code"><i class="fas fa-cogs fa-lg"></i> 500</h1>

            <!-- Title -->
            <h2 class="error-title">Server Error</h2>

            <!-- Message -->
            <p class="error-message">Sorry, there was a problem with our site. Please try again after some time.</p>

        </div>
    </div>
@endsection
