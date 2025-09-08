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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('en_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('image_path')->nullable();
            $table->text('bio')->nullable();
            $table->string('social_link_fb')->nullable();
            $table->string('social_link_x')->nullable();
            $table->string('social_link_ig')->nullable();
            $table->unsignedInteger('position')->default(0);
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
        Schema::dropIfExists('authors');
    }
};
