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
        // billing addresses
        Schema::create('user_billing_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
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

        // shipping addresses
        Schema::create('user_shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('phone',20)->nullable();
            $table->string('email',100)->nullable();
            $table->unsignedBigInteger('country_id')->default(0);
            $table->unsignedBigInteger('state_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->string('zip_code',15)->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('same_as_billing')->default(2)->comment('1-Yes, 2-No');
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
        //
    }
};
