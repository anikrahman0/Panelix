<script>
    $('#apply-coupon-btn').on('click', function(e) {
        e.preventDefault();

        $('#coupon-error').text('');
        $('#success-message').html('');
        const couponCode = $('#coupon_code').val(); // make sure you have this input field

        $.ajax({
            url: "{{ route('coupon.apply') }}",
            type: "POST",
            data: {
                coupon_code: couponCode,
                _token: "{{ csrf_token() }}"
            },

            success: function(response) {
                if (response.success) {
                    console.log(response);
                    
                    $('.total-price').text()
                    $('#coupon-error').text('');
                    $('.coupon-code-form').remove();
                    $('.coupon-amount').text(response.coupon_amount);
                    $('#applied-coupon').html( '<div class="oder-sub-total d-flex justify-content-between mt-3 mb-3">' + '<p id="coupon-name">কুপন কোড</p>' + '<p>' + '<span class="coupon-code me-2">' + response.coupon_code + '</span>' + '<a href="/remove/coupon/' + response.coupon_code + '" id="remove-coupon">' + '<i class="fas fa-times-circle text-danger" aria-hidden="true"></i>' + '</a>' + '</p>' + '</div>' );


                    // Get current total as number (no symbol used)
                    let currentTotal = parseFloat($('#checkout-cart-subtotal').text());

                    // Calculate new total
                    let shippingCost = parseFloat($('.shipping-cost').text()) || 0;

                    // Subtract coupon amount and add shipping cost
                    let newTotal = (currentTotal - parseFloat(response.coupon_amount)) + shippingCost;

                    console.log(newTotal+' '+ shippingCost + ' ' + currentTotal + ' ' + response.coupon_amount);
                    

                    // Update total
                    $('.total-price').text(newTotal.toFixed(2));

                    showSuccessMessage(response.message);
                } else {
                    $('#coupon-error').text(response.message || 'Something went wrong.');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    if (errors && errors.coupon_code) {
                        $('#coupon-error').text(errors.coupon_code[0]);
                    }
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    $('#coupon-error').text(xhr.responseJSON.message);
                } else {
                    $('#coupon-error').text('Something went wrong.');
                }
            }
        });
    });
</script>