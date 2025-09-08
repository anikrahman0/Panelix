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
        // general settings

        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('site_url')->nullable();
            $table->text('site_description')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('address')->nullable();
            $table->string('default_email')->nullable();
            $table->string('default_phone')->nullable();
            $table->string('timezone')->nullable();
            $table->string('logo')->nullable();
            $table->string('fb_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('banner_image_first')->nullable();
            $table->string('banner_image_second')->nullable();
            $table->string('banner_image_bottom')->nullable();
            $table->decimal('shipping_inside_dhaka', 8, 2)->default(50);
            $table->decimal('shipping_outside_dhaka', 8, 2)->default(70);
            $table->unsignedTinyInteger('default_currency')->default(1)->comment('1-USD, 2-BDT');
            $table->text('notice')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
};
