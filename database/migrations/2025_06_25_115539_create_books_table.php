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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('edition')->nullable();
            $table->string('page_no')->nullable();
            $table->string('cover')->nullable();
            $table->string('language')->nullable();
            $table->text('description')->nullable();
            $table->decimal('regular_price', 8, 2)->nullable();
            $table->decimal('sale_price', 8, 2);
            $table->decimal('discounted_price', 8, 2)->default(0);
            $table->decimal('discounted_percent', 8, 2)->default(0);
            $table->integer('quantity')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('isbn_no')->nullable();
            $table->unsignedTinyInteger('pre_order')->default(2)->comment('1-Yes, 2-No');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // book galleries
        Schema::create('book_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->string('img_path');
            $table->string('img_sm_path')->nullable();
            $table->string('img_thumb_path')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // book pdf images
        Schema::create('book_pdf_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->string('pdf_image_path');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // book ratings
        Schema::create('book_rating_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('user_rating')->default(0);
            $table->text('comments');
            $table->unsignedTinyInteger('approval')->default(1)->comment('1-Pending, 2-Approved, 3-Disapproved');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();                                                            
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('book_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('book_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('book_authors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('book_id');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('recently_viewed_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamp('viewed_at')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'book_id']);
        });

        // book_stock_histories table
        Schema::create('book_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->enum('type', ['increase', 'decrease']);
            $table->integer('quantity');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('book_categories');
        Schema::dropIfExists('book_galleries');
        Schema::dropIfExists('book_pdf_images');
        Schema::dropIfExists('book_authors');
        Schema::dropIfExists('book_ratings_reviews');
        Schema::dropIfExists('book_tags');
        Schema::dropIfExists('recently_viewed_books');
    }
};
