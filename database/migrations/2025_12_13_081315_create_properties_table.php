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
        Schema::create('properties', function (Blueprint $table) {
            $table->id('PropertyID'); // Tương đương với id()
            
            // Khóa ngoại Người đăng (UserID)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            
            // Thông tin cơ bản
            $table->string('Title', 255);
            $table->text('Description')->nullable();
            
            // ⭐️ CÁC TRƯỜNG THEO YÊU CẦU CỦA BẠN ⭐️
            $table->string('Address', 255); // Địa chỉ chi tiết (Address)
            $table->string('Image', 255)->nullable(); // Ảnh đại diện (Image)
            
            // Khóa ngoại Vị trí
            $table->unsignedBigInteger('CityID');
            $table->foreign('CityID')->references('CityID')->on('cities')->onDelete('cascade');
            
            $table->unsignedBigInteger('WardID');
            $table->foreign('WardID')->references('WardID')->on('wards')->onDelete('cascade');

            // Chi tiết BĐS
            $table->string('ListingType', 50); // Bán/Thuê
            $table->bigInteger('Price');
            $table->integer('Area');
            $table->string('Status', 50)->default('Pending'); // Trạng thái
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
