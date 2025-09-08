{{-- Add to Cart --}}
<script>
    // Add to Cart
    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var book_id = $(this).data('book-id');        
        var quantity = 0;

        $(this).prop('disabled', true).addClass('disabled').css('pointer-events', 'none');
        $('.spinner').removeClass('d-none');

        // Fallback to default quantity if none provided
        if (!quantity) {
            quantity = 1;
        }

        // Perform AJAX request
        $.ajax({
            url: '/cart',
            method: 'POST',
            data: {
                book_id: book_id,
                quantity: quantity,
                _token: "{{csrf_token()}}"
            },
            success: function(response) {
                console.log(response);
                
                if (response.status === 'success') {
                    $('.cart_count').text(response.cart_count);
                    $('#mini-cart-area').html(response.minicart);
                    $('.add-to-cart').prop('disabled', false).removeClass('disabled').css('pointer-events', '');
                    $('.spinner').addClass('d-none');
                    $('#cart-stock').html('<div class="product-cart-Btn"> <a href="#" class="btn-icon btn-add-cart product-type-simple" id="add-to-cart" data-book-id="'+book_id+'"> <i class="fas fa-spinner fa-spin me-2 d-none spinner"></i> <i class="icon-shopping-cart icon-bag"></i><span>ADD TO CART</span> </a> </div>')
                    $('#no-mini-product').html(''); 
                    $('#quick-view-modal').modal('hide');
                    showSuccessMessage(response.message);
                }else if(response.status === 'out-of-stock'){
                    $('.out-of-stock').html('<button class="btn out-of-stock-badge" disabled>Out of Stock</button>');
                    $('#book-box-'+book_id).addClass('pointer-events-none');
                    $('#book-box-'+book_id).append('<div class="out-of-stock-overlay d-flex justify-content-center align-items-center"><span class="out-stock-btn">Out of Stock</span> </div>');
                    $('#wishlist-item-' + book_id).find('.wishlist-stock-out').html('<div class="cart-item-contentBox-Right"> <span class="btn btn-secondary disabled"><i class="fa-solid fa-cart-arrow-down"></i> Out of Stock</span> </div>' );
                }
                else {
                    console.log('Failed to add book to cart.');
                }
            },
            error: function(xhr) {
                console.log('Something went wrong. Please try again.');
            }
        });
    });

    // remove cart
    $(document).on('click', '.cart-item-remove', function (e) {
        e.preventDefault(); // Prevent default action (like following a link)

        // Find the parent .mini-product and remove it
        $(this).closest('.mini-product').remove();
        var rowID = $(this).data('row-id')
        
        // Optionally, you can also make an AJAX request to remove the item from the cart on the server
        $.ajax({
            url: '/ajax/remove/cart/single/' + rowID,
            method: 'GET',
            success: function (response) {
                console.log('Product removed successfully:', response);
                
                showSuccessMessage(response.message);
                
                $('.cart_count').text(response.cart_count);
                $('.cart-subtotal').text(response.cartSubtotal);
                $('.coupon-amount').text(response.couponAmount ?? 0);
                $('.total-price').text(response.totalPrice - response.couponAmount);

                $('#rowId_' + rowID).remove();
                if (response.cart_count === 0 ){
                    $('.cart-items-area').remove()
                    $('#no-cart-item').html('<div class="d-flex flex-column justify-content-center align-items-center vh-100"> <i class="fas fa-shopping-cart fa-5x text-secondary mb-4"></i> <h2 class="text-dark mb-2">আপনার কার্ট খালি</h2> <p class="text-muted mb-4">আপনার কার্ট খালি হয়েছে, বর্তমানে কোনো আইটেম নেই।</p> <a href="" class="btn btn-no-item"> <i class="fas fa-arrow-left me-2"></i> শুরু করুন আপনার বই কেনার যাত্রা </a> </div>')
                    $('#no-mini-product').html('<div class="mini-product"> <div class="row gx-3"> <div class="col-12"> <div class="mini-product-details"> <h4 class="product-title text-center"> <span>No item in the cart</span> </h4> </div> </div> </div> </div>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error removing book:', error);
            }
        });
    });
</script>