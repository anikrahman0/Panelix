@extends('layouts.admin.base.app')
@section('title', 'Sub Category')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Sub Categories" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.subcategories.index') }}" label="Sub-Categories" />
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
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{ route('admin.subcategories.add') }}" class="btn btn-primary mt-md-0 mt-2"> <i class="fas fa-plus"></i> Add New Sub-Category</a>
                        </div>
                        <div class="filter-section">
                            <form action="{{ route('admin.subcategories.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <select name="filter_category" class="form-select select2" onchange="this.form.submit()">
                                            <option value="">Filter by Sub Category</option>
                                            @foreach($all_subcategories as $category)
                                                <option value="{{ $category->id }}" {{ request('filter_category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-sm reset-btn">
                                            <i class="fa-solid fa-rotate"></i>
                                        </a>
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
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($subcategories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($category->img)
                                            <img src="{{ $cdn_url.'/'.$category->img }}" class="rounded" title="{{ $category->title }}" alt="{{ $category->title }}" width="50">
                                            @else
                                            <img src="{{ asset('assets/common/logo-light.png') }}" class="rounded" title="{{ $category->title }}" alt="{{ $category->title }}" width="50">
                                            @endif
                                        </td>
                                        {{-- <td>{{ $category->parent->title ?? '' }}</td> --}}
                                        <td>{{ $category->title ?? '' }}</td>
                                        {{-- <td>{{ $category->slug }}</td> --}}
                                        <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <x-action-buttons.edit
                                                :url="route('admin.subcategories.edit', $category->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                permission="category"
                                            />
                                            <!-- Example usage in a Blade view -->
                                            <x-action-buttons.delete
                                                :url="route('admin.categories.delete', $category->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                confirmationMessage="Do you really want to delete this category?"
                                                permission="category"
                                            />
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Category Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $subcategories->appends(request()->query())->onEachSide(2)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush