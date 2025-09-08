@extends('layouts.admin.base.app')
@section('title','Role')

@push('css')
<!-- Datatables css-->
<link rel="stylesheet" type="text/css" href={{asset("assets/css/vendors/datatables.css")}}>
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
</style>
@endpush

@section('content')
<div class="container-fluid">
   <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <x-page-title header="Roles"/>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                    <x-breadcrumb-item active="true" label="Roles" />
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
                        {{-- <form class="form-inline search-form search-box">
                            <div class="form-group">
                                <input class="form-control-plaintext" type="search" placeholder="Search..">
                            </div>
                        </form> --}}
                        <a href="{{ route('admin.roles.add') }}" class="btn btn-primary mt-md-0 mt-2"><i class="fas fa-plus"></i> Add New Role</a>
                    </div>
                    <div class="card-body">
                        <table class="table display responsive nowrap" width="100%" id="basicTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>

                                    <td>{{$role->type == 1 ? 'Admin' : ''}}</td>

                                    <td>
                                        {{-- @if(auth()->user()->hasPermission('roles-update')) 
                                        <a href="{{route('admin.roles.edit',$role->id)}}">
                                            <i class="fa fa-edit bg-success p-2 rounded " title="Edit"></i>
                                        </a>
                                        @endif
                                        @if(auth()->user()->hasPermission('roles-delete')) 
                                        <a href="{{route('admin.roles.delete',$role->id)}}" onclick="return confirm('Do you really want to delete this role?');">
                                            <i class="fa fa-trash bg-primary p-2 rounded" title="Delete"></i>
                                        </a>
                                        @endif --}}
                                        <x-action-buttons.edit
                                            :url="route('admin.roles.edit', $role->id)" 
                                            :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                            permission="roles-update"
                                        />
                                        <!-- Example usage in a Blade view -->
                                        <x-action-buttons.delete
                                            :url="route('admin.roles.delete', $role->id)" 
                                            :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                            confirmationMessage="Do you really want to delete this role?"
                                            permission="roles-delete"
                                        />
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No Roles Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection

@push('script')
    <!-- Datatable js-->
    <script src={{asset("assets/js/admin/datatables/jquery.dataTables.min.js")}}></script>
    {{-- <script src={{asset("assets/js/admin/datatables/custom-basic.js")}}></script> --}}
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#basicTable').DataTable( {
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: [0,-1] },
                    { responsivePriority: 2, targets: [2] },
                ]
            });
        });
    </script>
@endpush