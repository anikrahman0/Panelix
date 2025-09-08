@extends('layouts.admin.base.app')
@section('title', 'Authors')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <x-page-title header="Authors" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.author.index') }}" label="Authors" />
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
                            <a href="{{ route('admin.author.add') }}" class="btn btn-primary mt-md-0 mt-2"><i class="fas fa-plus"></i> Add New Author</a>
                            <form action="" method="GET">
                                <div class="d-flex">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control post-wrapper dbcategory" value="{{ request('search') }}" placeholder="Search author" aria-describedby="button-addon2">
                                        <button type="submit" class="btn search-list-btn" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('admin.author.index') }}" class="btn btn-sm reset-btn"><i class="fa-solid fa-rotate"></i></a>
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
                                        <th>Name (Bangla)</th>
                                        <th>Name (English)</th>
                                        <th>Email</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody id="sortable">
                                    @forelse($authors as $author)
                                    <tr data-id="{{ $author->id }}">
                                        <td class="handle">{{ $loop->iteration }}</td>
                                        <td>
                                            @if($author->image_path)
                                                <img src="{{ $cdn_url.'/'.$author->image_path }}" class="rounded" title="{{ $author->name }}" alt="{{ $author->name }}" width="50">
                                            @else
                                                <img src="{{ asset('assets/common/logo-light.png') }}" class="rounded" title="{{ $author->name }}" alt="{{ $author->name }}" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $author->name }}</td>
                                        <td>{{ $author->en_name ?? ''}}</td>
                                        <td>{{ $author->email }}</td>
                                        <td>
                                            <x-action-buttons.edit
                                                :url="route('admin.author.edit', $author->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                permission="authors"
                                            />
                                            <!-- Example usage in a Blade view -->
                                            <x-action-buttons.delete
                                                :url="route('admin.author.delete', $author->id)" 
                                                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
                                                confirmationMessage="Do you really want to delete this author?"
                                                permission="authors"
                                            />
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No author Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $authors->appends(request()->query())->onEachSide(2)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function () {
        $("#sortable").sortable({
            handle: ".handle",
            update: function (event, ui) {
                let order = [];
                $("#sortable tr").each(function (index, element) {
                    $(this).find(".handle").text(index + 1);
                    order.push($(this).attr("data-id"));
                });

                $.ajax({
                    url: "{{ route('admin.author.sort') }}",
                    type: "POST",
                    data: {
                        order: order,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.success) {
                            // Show success message
                            let msgDiv = $(`
                                <div class="success-msg">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i> <strong>Position updated successfully</strong>
                                    </div>
                                </div>
                            `);
                            $(".container-fluid").first().prepend(msgDiv);
                        }
                    }
                });
            }
        });
    });
</script>
@endpush