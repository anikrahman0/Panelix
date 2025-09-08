@extends('layouts.admin.base.app')
@section('title', 'Book Reviews')

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
                                <x-page-title header="Book Reviews" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <x-breadcrumb-item url="{{ route('admin.dashboard') }}" label="Dashboard" icon="home" />
                                <x-breadcrumb-item active="true" url="{{ route('admin.review.index') }}" label="Book Reviews" />
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
                            {{-- <a href="{{ route('admin.review.add') }}" class="btn btn-primary mt-md-0 mt-2"><i class="fas fa-plus"></i> Add New review</a> --}}
                            {{-- <form action="" method="GET">
                                <div class="d-flex">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control post-wrapper dbcategory" value="{{ request('search') }}" placeholder="Search review" aria-describedby="button-addon2">
                                        <button type="submit" class="btn search-list-btn" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i> </button>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('admin.review.index') }}" class="btn btn-sm reset-btn"><i class="fa-solid fa-rotate"></i></a>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                        <div class="card-body">
                            <table class="table display responsive nowrap" width="100%" id="basicTable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($reviews as $review)
                                        <tr class="">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $review->user->name  }}</td>
                                            <td>{{ $review->book->title  }}</td>
                                            <td>{{ $review->user_rating }}/5</td>
                                            <td>{{ Str::limit($review->comments, 100) }}</td>
                                            <td>
                                                @if ($review->approval == 1)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif ($review->approval == 2)
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-secondary">Disapproved</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" 
                                                    class="btn btn-sm {{ $review->approval == 2 ? 'btn-secondary' : 'btn-success' }} approve-review" 
                                                    data-id="{{ $review->id }}">
                                                    {{ $review->approval == 2 ? 'Disapprove' : 'Approve' }}
                                                </a>
                                                <x-action-buttons.delete
                                                    :url="route('admin.review.delete', $review->id)" 
                                                    :isSuper="auth()->guard('admin')->user()->is_super == 1"
                                                    confirmationMessage="Do you really want to delete this review?"
                                                    permission="product-yag-delete"
                                                />
                                                
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <strong>No reviews found.</strong>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mb-5">
							{!! $reviews->appends(request()->query())->onEachSide(2)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        const approveReviewUrl = '{{ route('admin.review.approve', ':id') }}';

        $('.approve-review').on('click', function (e) {
            e.preventDefault();

            const id = $(this).data('id');
            const url = approveReviewUrl.replace(':id', id);

            const confirmed = confirm("Do you want to change the approval status of this review?");
            if (!confirmed) {
                return;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response.message || "Review approval status updated successfully.");
                    location.reload(); // remove this if you want to update DOM manually
                },
                error: function (xhr) {
                    console.log("There was a problem approving the product review.");
                }
            });
        });
    });
</script>
@endpush