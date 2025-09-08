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

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // admin users
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('country_id')->default(0);
            $table->string('name',100);
            $table->string('email',100);
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('gender')->default(0)->comment('1-Male, 2-Female, 3-Others');
            $table->string('phone',20)->nullable()->unique();
            $table->string('image_path')->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->unsignedTinyInteger('is_super')->default(2)->comment('1-Yes, 2-No');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->string('email_verify_token')->nullable();
            $table->string('email_token_expire')->nullable();
            $table->unsignedBigInteger('country_id')->default(0);
            $table->unsignedBigInteger('state_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->string('zip',15)->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('gender')->default(0)->comment('1-Male, 2-Female, 3-Others');
            $table->string('phone', 20)->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedTinyInteger('account_type')->default(1)->comment('1-Normal, 2-Google, 3-Facebook');
            $table->string('provider_id')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('password_changed_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
