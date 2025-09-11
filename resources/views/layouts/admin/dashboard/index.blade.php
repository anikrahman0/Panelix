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
                <h5 class="fw-bold">Panelix 1.0</h5>                                
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush