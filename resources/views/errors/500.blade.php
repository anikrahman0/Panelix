@extends('layouts.frontend.base.app')

@section('title', '500 - Server Error')

@section('content')
    <div class="error-page">
        <div class="text-center px-4">
            <!-- Icon -->
            
            <!-- Error Code -->
            
            <h1 class="error-code"><i class="fas fa-cogs fa-lg"></i> 500</h1>

            <!-- Title -->
            <h2 class="error-title">সার্ভার ত্রুটি</h2>

            <!-- Message -->
            <p class="error-message">দুঃখিত, আমাদের সাইটে কিছু সমস্যা হয়েছে। অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন।</p>

            <!-- Button -->
            <a href="{{ url('/') }}" class="btn btn-primary-custom btn-lg">হোমে ফিরে যান</a>
        </div>
    </div>
@endsection
