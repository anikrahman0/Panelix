@extends('layouts.admin.base.app')
@section('title', 'Permissions')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Permissions" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.permissions.index') }}" label="Permissions" />
                            </ol>
                        </div>
                    </div>
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
                            <a href="{{ route('admin.permissions.add') }}" class="btn btn-primary mt-md-0 mt-2"><i class="fas fa-plus"></i> Add New Permission</a>
                            {{-- <form action="" method="GET">
                                <div class="d-flex">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control post-wrapper dbcategory" value="{{ request('search') }}" placeholder="Search permission" aria-describedby="button-addon2">
                                        <button type="submit" class="btn search-list-btn" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('admin.permission.index') }}" class="btn btn-sm reset-btn"><i class="fa-solid fa-rotate"></i></a>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="basicTable">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Permission Group</th>
                                        <th>Permission Name</th>
                                        {{-- <th>Sub Permission Name</th> --}}
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($groups as $group)
                                        {{-- @foreach($group->permissions as $permission) --}}
                                            {{-- @if($permission->children->isEmpty()) --}}
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $group->name }}</td>
                                                    <td class="w-50" style="min-width:200px;">
                                                        @foreach($group->permissions as $permission)
                                                            {{ $permission->name }}@if(!$loop->last), @endif
                                                        @endforeach
                                                    </td>
                                                    {{-- <td>-</td> --}}
                                                    <td>
                                                        <x-action-buttons.edit
                                                            :url="route('admin.permissions.edit', $group->id)" 
                                                            :isSuper="auth()->guard('admin')->user()->is_super == 1"
                                                            permission="roles"
                                                        />
                                                        <!-- Example usage in a Blade view -->
                                                        <x-action-buttons.delete
                                                            :url="route('admin.permissions.delete', $group->id)" 
                                                            :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                            confirmationMessage="Do you really want to delete this permission?"
                                                            permission="roles"
                                                        />
                                                    </td>
                                                </tr>
                                            {{-- @else
                                                @foreach($permission->children as $sub)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $group->name }}</td>
                                                        <td>{{ $permission->name }}</td>
                                                        <td>{{ $sub->name }}</td>
                                                        <td>
                                                            <x-action-buttons.edit
                                                                :url="route('admin.permissions.edit', $group->id)" 
                                                                :isSuper="auth()->guard('admin')->user()->is_super == 1"
                                                            />
                                                            <!-- Example usage in a Blade view -->
                                                            <x-action-buttons.delete
                                                                :url="route('admin.permissions.delete', $group->id)" 
                                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                                confirmationMessage="Do you really want to delete this permission?"
                                                            />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif --}}
                                        {{-- @endforeach --}}
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Permissions Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $groups->appends(request()->query())->onEachSide(2)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection