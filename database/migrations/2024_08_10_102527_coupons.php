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
        // coupons
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->unsignedTinyInteger('coupon_usage')->default(2)->comment('1-Multiple, 2-Unlimited');
            $table->unsignedTinyInteger('coupon_type')->default(1)->comment('1-Fixed Amount, 2-Percentage, 3-Free Shipping');
            $table->unsignedTinyInteger('apply_for')->default(1)->comment('1-All Orders, 2-Order Amount from, 3-Category, 4-Product, 5-Customer, 6-Once Per Customer');
            $table->double('amount', 8, 2)->default(0);
            $table->double('max_amount', 8, 2)->default(0);
            $table->double('free_shipping_min', 8, 2)->default(0);
            $table->double('order_from_amount', 8, 2)->default(0);
            $table->integer('usage_limit')->default(0);
            $table->timestamp('start_date');
            $table->timestamp('expire_date')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // coupon cats
        Schema::create('coupon_cats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // coupon books
        Schema::create('coupon_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // coupon users
        Schema::create('coupon_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('coupon_cats');
        Schema::dropIfExists('coupon_books');
        Schema::dropIfExists('coupon_users');
    }
};
