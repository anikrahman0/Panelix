@extends('layouts.frontend.base.app')

@section('title', '503 - Service Unavailable')

@section('content')
    <div class="error-page">
        <div class="text-center px-4">
            <!-- Icon -->
            
            <!-- Error Code -->
            
            <h1 class="error-code"><i class="fas fa-tools fa-lg"></i> 503</h1>

            <!-- Title -->
            <h2 class="error-title">সার্ভিস সাময়িকভাবে বন্ধ</h2>

            <!-- Message -->
            <p class="error-message">দুঃখিত, সার্ভিস সাময়িকভাবে বন্ধ আছে। অনুগ্রহ করে কিছুক্ষণ পর পুনরায় চেষ্টা করুন।।</p>

        </div>
    </div>
@endsection
