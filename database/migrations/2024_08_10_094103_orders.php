<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->default(0);
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->double('subtotal', 8, 2);
            $table->double('total', 8, 2);
            $table->string('coupon_code')->nullable();
            $table->double('coupon_amount', 8, 2)->default(0);
            $table->unsignedTinyInteger('coupon_type')->nullable()->comment('1=Fixed Amount, 2=Percentage, 3-Free Shipping');
            $table->double('shipping_cost', 8, 2);
            $table->unsignedTinyInteger('order_status')->default(1)->comment('1-Pending, 2-Processing, 3-Shipped, 4-Delivered, 5-Completed, 6-Cancelled, 7-Returned, 8-Failed');
            $table->unsignedTinyInteger('payment_status')->default(1)->comment('1-Unpaid, 2-Paid, 3-Refunded, 4-Cancelled, 5-Failed');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // order details
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('book_id');
            $table->string('book_title')->nullable();
            $table->integer('quantity')->default(0);
            $table->double('regular_price', 8, 2);
            $table->double('sale_price', 8, 2);
            $table->double('total', 8, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // order billing addresses
        Schema::create('order_billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('name');
            $table->string('phone',20)->nullable();
            $table->string('email',100)->nullable();
            $table->unsignedBigInteger('country_id')->default(0);
            $table->unsignedBigInteger('state_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->string('zip_code',15)->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // order shipping addresses
        Schema::create('order_shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('name');
            $table->string('phone',20)->nullable();
            $table->string('email',100)->nullable();
            $table->unsignedBigInteger('country_id')->default(0);
            $table->unsignedBigInteger('state_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->string('zip_code',15)->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        //  order refunds
        Schema::create('order_refunds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->text('items');
            $table->double('pending_amount', 8, 2);
            $table->double('refunded_amount', 8, 2);
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('order_billing_addresses');
        Schema::dropIfExists('order_shipping_addresses');
        Schema::dropIfExists('order_refunds');
    }
};
