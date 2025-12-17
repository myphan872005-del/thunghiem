<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property; 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. GỌI CÁC SEEDER CƠ SỞ
        $this->call([
            RoleSeeder::class,
            CitySeeder::class, // Cần đảm bảo bạn đã tạo CitySeeder
            WardSeeder::class, // Cần đảm bảo bạn đã tạo WardSeeder
        ]);

        // 2. TẠO ADMIN USER (USER_ID = 1) VÀ CÁC USER MẪU KHÁC
        User::factory()->create([
            'name' => 'Admin FullName',
            'username' => 'admin_user', // ⭐️ Thêm username ⭐️
            'email' => 'admin@demo.com',
            'phone' => '0901234567',     // ⭐️ Thêm phone ⭐️
            'password'=>'11111111',
            'RoleID' => 1,
        ]);
        User::factory(10)->create(['RoleID' => 2]);
        
        // 3. THÊM DỮ LIỆU PROPERTY MẪU
        Property::create([
            'user_id' => 1,
            'CityID' => 1, // Đà Nẵng
            'WardID' => 1, // Phường Hải Châu 1
            'Title' => 'Nhà mặt tiền Đà Nẵng view biển',
            'Description' => 'Mô tả chi tiết...',
            'Address' => '123 Đường ABC', // ⭐️ Thêm Address ⭐️
            'Image' => 'default.jpg', // ⭐️ Thêm Image ⭐️
            'ListingType' => 'Sale',
            'Price' => 5000000000,
            'Area' => 80,
            'Status' => 'Approved',
        ]);

        // ... Thêm các Property khác nếu muốn
    }
}