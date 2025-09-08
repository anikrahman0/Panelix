<div class="offcanvas offcanvas-end mini-cart-area" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">শপিং কার্ট</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mini-cart-products">
            {{-- @if($cartData->isNotEmpty() && $cartDataCount > 0) --}}
                @forelse ($cartData as $item)
                    <div class="mini-product">
                        <div class="row">
                            <div class="col-9">
                                <div class="mini-product-details">
                                    <h4 class="product-title"> <a href="{{ route('frontend.book.details', $item->attributes->slug)}}">{{$item->name}}</a> </h4>
                                    <span class="cart-product-info"> <span class="cart-product-qty">{{$item->quantity}}</span>× {{config('app.currency_symbol')}}{{$item->price}} </span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="product-image-container">
                                    <a href="#"> <img class="img-fluid product-image" src="{{ $cdn_url.'/'.$item->attributes->book_image }}" alt="{{$item->name}}" title="{{$item->name}}"> </a>
                                    <a href="#" class="btn-remove cart-item-remove" data-row-id="{{$item->id}}" title="Remove Product"><span>×</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="mini-product">
                        <div class="row gx-3">
                            <div class="col-12">
                                <div class="mini-product-details">
                                    <h4 class="product-title text-center">
                                        <span>No item in the cart</span>
                                    </h4>               
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
                <div id="no-mini-product"></div>
            {{-- @endif --}}
        </div>
    </div>
    <div class="mini-cart-info-sticky">
        <div class="mini-cart-info-wrap">
            <div class="mini-cart-total">
                <span>মোট:</span>
                <span class="cart-total-price">{{config('app.currency_symbol')}} <span class="cart-subtotal">{{$cartSubtotal}}</span></span>
            </div>
            <div class="mini-cart-action">
                <a href="{{route('shopping.cart')}}" class="btn view-cart-btn">View Cart</a>
                <a href="{{route('checkout')}}" class="btn checkout-cart-btn">Checkout</a>
            </div>
        </div>
    </div>
</div>