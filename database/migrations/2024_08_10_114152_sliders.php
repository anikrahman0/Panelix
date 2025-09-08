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
        // sliders
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('slider_description')->nullable();
            $table->unsignedTinyInteger('slider_type')->default(1)->comment('1-Default');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // slider images
        Schema::create('slider_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->string('img_bg');
            // $table->string('img_sm')->nullable();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('cat_id')->default(0);
            // $table->unsignedBigInteger('subcat_id')->default(0);
            $table->unsignedBigInteger('product_id')->default(0);
            $table->string('slider_top_head')->nullable();
            $table->string('slider_sub_head')->nullable();
            $table->integer('position');
            $table->unsignedTinyInteger('link_type')->default(1)->comment('1-url, 2-product, 3-category, 4-subcategory');
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
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('slider_images');
    }
};
