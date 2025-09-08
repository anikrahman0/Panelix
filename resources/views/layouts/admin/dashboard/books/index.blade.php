@extends('layouts.admin.base.app')
@section('title', 'Books')

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
                                <x-page-title header="Books" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.books.index') }}" label="Books" />
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
                            <a href="{{ route('admin.books.add') }}" class="btn btn-primary mt-md-0 mt-2"><i class="fas fa-plus"></i> Add New Book</a>
                        </div>
                        <div class="filter-section">
                            <form action="{{ route('admin.books.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-5">
                                        <select name="filter_book" class="form-select select2" onchange="this.form.submit()">
                                            <option value="">Filter by Book</option>
                                            @foreach($all_books as $book)
                                                <option value="{{ $book->id }}" {{ request('filter_book') == $book->id ? 'selected' : '' }}>
                                                    {{ $book->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-md-5">
                                        <select name="filter_category" class="form-select select2" onchange="this.form.submit()">
                                            <option value="">Filter by Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ request('filter_category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2">
                                        <a href="{{ route('admin.books.index') }}" class="btn btn-sm reset-btn">
                                            <i class="fa-solid fa-rotate"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="{{!empty($books) && $books->count() > 0 ? 'basicTable': ''}}">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th style="max-width: 300px; word-wrap: break-word;white-space: normal;">Title</th>
                                        {{-- <th>Category</th> --}}
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($books as $book)
                                    <tr>
                                        <td><img src="{{ $cdn_url.'/'.$book->firstImage?->img_path }}" alt="{{ $book->title }}" class="img-fluid" style="max-width: 100px;"></td>

                                        <td style="max-width: 300px; word-wrap: break-word;white-space: normal;">{{ $book->title }}</td>
                                        {{-- <td></td> --}}
                                        <td>
                                            @if($book->regular_price !== null)
                                            <span class="cut-line-through text-danger">{{ $book->regular_price }}</span> {{ $book->sale_price }}
                                            @else
                                                {{ $book->sale_price }}
                                            @endif
                                        </td>
                                        <td>{{ $book->quantity }}</td>
                                        <td>{{ $book->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <x-action-buttons.edit
                                                :url="route('admin.books.edit', $book->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                permission="product-update"
                                            />
                                            <!-- Example usage in a Blade view -->
                                            <x-action-buttons.delete
                                                :url="route('admin.books.delete', $book->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                confirmationMessage="Do you really want to delete this book?"
                                                permission="product-delete"
                                            />
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No Books Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $books->appends(request()->query())->onEachSide(2)->links() !!}
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