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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('username', 50)->unique()->nullable();
            $table->string('phone', 20)->nullable();
            // ⭐️ THÊM CÁC TRƯỜNG ROLEID TẠI ĐÂY ⭐️
            $table->unsignedBigInteger('RoleID')->default(2);
            // Quan trọng: Phải đảm bảo bảng 'roles' đã được tạo trước đó.
            $table->foreign('RoleID')->references('RoleID')->on('roles')->onDelete('cascade');
            
            $table->timestamps();
        });

        // Giữ nguyên các bảng khác: password_reset_tokens và sessions
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
        
        // ❌ XÓA HẾT ĐOẠN CODE LỖI SAU ĐOẠN NÀY ❌
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
