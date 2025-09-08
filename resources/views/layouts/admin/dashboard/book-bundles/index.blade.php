@extends('layouts.admin.base.app')
@section('title', 'Book Bundles')

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
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Book Bundles" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.book.bundles.index') }}" label="Book Bundles" />
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
                            <a href="{{ route('admin.book.bundles.add') }}" class="btn btn-primary mt-md-0 mt-2"> <i class="fas fa-plus"></i> Add Book Bundle</a>
                        </div>
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="basicTable">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookBundles as $bundle)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($bundle->image_path)
                                                <img src="{{ $cdn_url.'/'.$bundle->image_path }}" class="rounded" title="{{ $bundle->title }}" alt="{{ $bundle->title }}" width="50">
                                            @else
                                                <img src="{{ asset('assets/common/logo-light.png') }}" class="rounded" title="{{ $bundle->title }}" alt="{{ $bundle->title }}" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $bundle->title }}</td>
                                        <td>{{ $bundle->url }}</td>
                                        <td>{{ $bundle->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <x-action-buttons.edit
                                                :url="route('admin.book.bundles.edit', $bundle->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                permission="sliders"
                                            />
                                            <!-- Example usage in a Blade view -->
                                            <x-action-buttons.delete
                                                :url="route('admin.book.bundles.delete', $bundle->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                confirmationMessage="Do you really want to delete this?"
                                                permission="sliders"
                                            />
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Book Bundles Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $bookBundles->appends(request()->query())->onEachSide(2)->links() !!}
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
    {{-- <script src={{asset("assets/js/admin/datatables/jquery.dataTables.min.js")}}></script> --}}
    {{-- <script src={{asset("assets/js/admin/datatables/custom-basic.js")}}></script> --}}
    {{-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script> --}}

    {{-- <script>
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