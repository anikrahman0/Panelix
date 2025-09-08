@extends('layouts.frontend.base.app')

@section('title', '404 - Page Not Found')

@section('content')
    <div class="error-page bg-404">
        <div>
            <h1 class="error-code">404</h1>
            <h2 class="error-title">পৃষ্ঠাটি পাওয়া যায়নি</h2>
            <p class="error-message">দুঃখিত, আপনি যে পৃষ্ঠাটি খুঁজছেন তা পাওয়া যায়নি।</p>
            <a href="{{ url('/') }}" class="btn btn-primary-custom btn-lg">হোমে ফিরে যান</a>
        </div>
    </div>
@endsection