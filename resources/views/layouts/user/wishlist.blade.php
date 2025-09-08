@extends('layouts.frontend.base.app')

@section('title', 'User Wishlist')

@push('css')
    
@endpush


@section('meta')
    
@endsection


@section('content')
<div class="dashboard-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4">
                @include('layouts.user.partials.sidebar')
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8">
                <div class="dash-heading">
                    <h1>Wishlist</h1>
                </div>
                <div class="filter-category-product-area">
                    <div class="wishlist-product-wrap">
                        @forelse ($wishlists as $wishlist)
                            <div class="my-cart-item-details-wrap" id="wishlist-item-{{ $wishlist->book->id }}">
                                <div class="cart-item-innerBox">
                                    <div class="cart-item-innerBox-left">
                                        <div class="cart-img-item">
                                            <a href="{{ route('frontend.book.details', $wishlist->book->slug) }}"> <img class="img-fluid" src="{{ asset($cdn_url.'/'.$wishlist->book->firstImage->img_path) }}" alt="" title=""> </a>
                                        </div>
                                        <div class="cart-item-contentBox">
                                            <h5><a href="{{ route('frontend.book.details', $wishlist->book->slug) }}">{{ $wishlist->book->title }} </a></h5>
                                            <div class="cart-item-link-meta">
                                                @foreach($wishlist->book->authors->take(2) as $author)
                                                    <a href="{{ route('frontend.author', [$author->id, Str::slug($author->name)]) }}">{{ $author->name }}@if (!$loop->last) | @endif</a>
                                                @endforeach <br>
                                                @if($wishlist->book->pre_order === 1)
                                                    <span class="offer-price">প্রি অর্ডার</span>
                                                @elseif($wishlist->book->discounted_percent > 0)
                                                    <span class="offer-price">{{ fEn2Bn($wishlist->book->discounted_percent) }}% ছাড়</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-item-inner-price-quantity">
                                        <div class="cart-item-innerBox-middle">
                                            <div class="cart-item-middle">
                                                <div class="cart-price">
                                                    @if($wishlist->book->discounted_price > 0)
                                                    <span>৳ {{ fEn2Bn($wishlist->book->sale_price) }}</span> <br>
                                                    <span class="old-price">৳ {{ fEn2Bn($wishlist->book->regular_price) }}</span><br>
                                                    @else
                                                    <span>৳ {{ fEn2Bn($wishlist->book->sale_price) }}</span><br>
                                                    @endif
                                                    <div class="automation-btn-delete">
                                                        <a href="{{ route('wishlist.delete', $wishlist->id) }}" data-id="{{ $wishlist->id }}" class="delete-from-wishlist">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wishlist-stock-out">
                                            @if($wishlist->book->quantity > 0)
                                                <div class="cart-item-contentBox-Right wishlist-add-cart">
                                                    <a type="button" class="btn product-cart add-to-cart" data-book-id="{{ $wishlist->book->id }}"><i class="fa-solid fa-cart-shopping"></i> কার্টে যোগ করুন</a>
                                                </div>
                                            @else
                                                <div class="cart-item-contentBox-Right">
                                                    <span class="btn btn-secondary disabled"><i class="fa-solid fa-cart-arrow-down"></i> Out of Stock</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="my-cart-item-details-wrap text-center p-3">
                                <span class="text-muted">দু:খিত! কোনও বই পাওয়া যায়নি</span>
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        {!! $wishlists->appends(request()->query())->onEachSide(2)->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection


@push('js')
<script>
    $(document).on('click', '.delete-from-wishlist', function(e){
        e.preventDefault();

        const wishlistId = $(this).data('id');
        const url = "{{ route('wishlist.delete', ':id') }}".replace(':id', wishlistId);

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, remove it!"
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        Swal.fire({
                            title: "Removed!",
                            text: "Item has been removed from your wishlist.",
                            icon: "success"
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error!",
                            text: "There was a problem deleting the item from the wishlist.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    });
</script>

@endpush
