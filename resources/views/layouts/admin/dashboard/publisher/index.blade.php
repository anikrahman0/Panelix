@extends('layouts.admin.base.app')
@section('title', 'Publishers')

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
                                <x-page-title header="Publishers" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.publisher.index') }}" label="Publishers" />
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
                            <a href="{{ route('admin.publisher.add') }}" class="btn btn-primary mt-md-0 mt-2"><i class="fas fa-plus"></i> Add New Publisher</a>
                            <form action="" method="GET">
                                <div class="d-flex">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control post-wrapper dbcategory" value="{{ request('search') }}" placeholder="Search publisher" aria-describedby="button-addon2">
                                        <button type="submit" class="btn search-list-btn" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('admin.publisher.index') }}" class="btn btn-sm reset-btn"><i class="fa-solid fa-rotate"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="basicTable">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Email</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($publishers as $publisher)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($publisher->image_path)
                                                <img src="{{ $cdn_url.'/'.$publisher->image_path }}" class="rounded" title="{{ $publisher->name }}" alt="{{ $publisher->name }}" width="50">
                                            @else
                                                <img src="{{ asset('assets/common/logo-light.png') }}" class="rounded" title="{{ $publisher->name }}" alt="{{ $publisher->name }}" width="50">
                                            @endif
                                        </td>
                                        <td>{{$publisher->title}}</td>
                                        <td>{{$publisher->email}}</td>
                                        <td>
                                            <x-action-buttons.edit
                                                :url="route('admin.publisher.edit', $publisher->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                permission="publishers"
                                            />
                                            <!-- Example usage in a Blade view -->
                                            <x-action-buttons.delete
                                                :url="route('admin.publisher.delete', $publisher->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                confirmationMessage="Do you really want to delete this publisher?"
                                                permission="publishers"
                                            />
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Publishers Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $publishers->appends(request()->query())->onEachSide(2)->links() !!}
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
    {{-- <script src={{asset("assets/js/admin/datatables/jquery.dataTables.min.js")}}></script>
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
    </script> --}}
@endpush