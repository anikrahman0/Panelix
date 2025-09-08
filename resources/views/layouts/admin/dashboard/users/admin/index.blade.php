@extends('layouts.admin.base.app')
@section('title','Admin Users')

@push('css')
<!-- Datatables css-->
{{-- <link rel="stylesheet" type="text/css" href={{asset("assets/css/vendors/datatables.css")}}>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
<style>
    .dataTable tr.child ul li {
        display: block;
    }
    div.dataTables_wrapper div.dataTables_info {
        margin-top: 20px;
        padding-left: 10px;
        padding-top: 5px;
    }

    div.dataTables_wrapper div.dataTables_paginate {
        margin-left: 0 !important;
    }
</style> --}}
@endpush

@section('content')
<div class="container-fluid">
   <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <x-page-title header="Admin Users"/>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                    <x-breadcrumb-item active="true" label="Admin Users" />
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        @include('layouts.admin.partials.success')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.users.add') }}" class="btn btn-primary mt-md-0 mt-2"><i class="fas fa-plus"></i> Add New User</a>
                        <form action="" method="GET">
                            <div class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control post-wrapper dbcategory" value="{{ request('search') }}" placeholder="Search admin" aria-describedby="button-addon2">
                                    <button type="submit" class="btn search-list-btn" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>
                                </div>
                                <div class="">
                                    <a href="{{ route('admin.users.index-admin') }}" class="btn btn-sm reset-btn"><i class="fa-solid fa-rotate"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table display responsive nowrap" width="100%" id="basicTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role->type == 1 ? 'Admin' : ''}}</td>
                                    <td>{{$user->role->name}}</td>
                                    <td>
                                        @if($user->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Example usage in a Blade view -->
                                        <x-action-buttons.edit
                                            :url="route('admin.users.edit-admin', $user->id)" 
                                            :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                            permission="users-update"
                                        />
                                        <!-- Example usage in a Blade view -->
                                        <x-action-buttons.delete
                                            :url="route('admin.users.delete-admin', $user->id)" 
                                            :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                            confirmationMessage="Do you really want to delete this user?"
                                            permission="users-delete"
                                        />
                                        <x-action-buttons.password
                                            :url="route('admin.users.admin.change-password', $user->id)" 
                                            :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                            permission="users-update"
                                        />
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No User Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        {!! $users->appends(request()->query())->onEachSide(2)->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection

@push('script')
@endpush