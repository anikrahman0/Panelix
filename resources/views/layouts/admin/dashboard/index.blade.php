@extends('layouts.admin.base.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-md-12">
                        {{-- <img src="{{ asset('assets/admin/common/logo.png') }}" alt="Panelix Logo" class="logo" width="300"> --}}
                        @if(!empty($settings->logo))
                            <img class="logo" src="{{ $cdn_url . '/' . $settings->logo }}" width="250" alt="Site Logo" title="Site Logo">
                        @else
                            <img class="logo" src="{{ $cdn_url . '/' . config('app.default_logo') }}" width="250" alt="Site Logo" title="Site Logo">
                        @endif
                    </div>
                </div>    
                <h5 class="fw-bold mt-2">{{ !empty($settings->site_title) ? $settings->site_title : (config('app.name') ?? 'Panelix') }} {{config('app.version')}}</h5>                                
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush