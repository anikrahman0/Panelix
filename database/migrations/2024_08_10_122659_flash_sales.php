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
        // flash sales
        Schema::create('flash_sales', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('offer_type')->default(1)->comment('1-Amount, 2-Percentage');
            $table->double('offer_amount',8,2)->default(0);
            $table->timestamp('end_time')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('book_flash_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('book_id');
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
        Schema::dropIfExists('flash_sales');  
        Schema::dropIfExists('book_flash_sales');  
    }
};
