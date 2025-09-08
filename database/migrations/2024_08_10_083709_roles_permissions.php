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
        // roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('short_desc')->nullable();
            $table->unsignedTinyInteger('type')->comment('1-Admin, 3-User');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->integer('parent_id')->default(0);
            $table->string('name',100);
            $table->string('meta_name');
            $table->string('short_desc')->nullable();
            $table->unsignedTinyInteger('type')->default(1)->comment('1-Admin');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

         // permission groups
        Schema::create('permission_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->unsignedTinyInteger('type')->default(1)->comment('1-Admin');
            $table->unsignedTinyInteger('status')->default(1)->comment('1-Active, 2-Inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        // role permissions
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_permissions');
    }
};
