@extends('layouts.admin.base.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('assets/admin/common/logo.png') }}" alt="Panelix Logo" class="logo" width="300">
                    </div>
                </div>    
                <h4 class="mt-4">Panelix 1.0</h4>                                
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush