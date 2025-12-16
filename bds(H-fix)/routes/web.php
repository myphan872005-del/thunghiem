<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Search\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Middleware\IsAdmin; // Dùng Class trực tiếp, đã khắc phục lỗi Alias

// ====================================================
// 🌏 KHU VỰC CÔNG KHAI (AI CŨNG XEM ĐƯỢC)
// ====================================================
Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/property/{id}', [PropertyController::class, 'show'])
    ->name('properties.show')
    ->where('id', '[0-9]+');

Route::get('/getWard/{cityId}', [LocationController::class, 'getWardsByCity']);
Route::get('/getCity', [LocationController::class, 'getCity']);

Route::get('/property', [SearchController::class, 'index'])
    ->name('properties.indexSearch');  

// ====================================================
// 🔒 KHU VỰC CHỈ CẦN ĐĂNG NHẬP (USER/ADMIN ĐỀU VÀO ĐƯỢC)
// ====================================================
Route::middleware('auth')->group(function () {

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- CHỨC NĂNG CƠ BẢN CỦA USER (Đăng tin) ---
    Route::get('/property/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('properties.store');

    // API lấy phường xã (cho Javascript)
    Route::get('/get-wards/{city_id}', [PropertyController::class, 'getWards']);
    
    // TẠM THỜI ĐẶT ROUTE 'dashboard' Ở ĐÂY CHO USER THƯỜNG TRUY CẬP SAU KHI LOGIN (Nếu có)
    // Nếu không, hãy đảm bảo AuthenticatedSessionController đã xử lý redirect về 'home'
    Route::get('/dashboard', function () {
        return view('dashboard'); // Giả định có view dashboard.blade.php
    })->name('dashboard');
});

// ====================================================
// 👑 KHU VỰC ADMIN (CHỈ ROLE=1 MỚI VÀO ĐƯỢC)
// ====================================================
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    
    // Trang chủ Admin Dashboard (Sử dụng View blade thay vì closure)
    Route::get('/', function () {
        // Trả về view Admin Dashboard có menu đầy đủ
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    // --- QUẢN LÝ TIN ĐĂNG ---
    Route::get('properties', [Admin\PropertyController::class, 'index'])->name('admin.properties.index');
    Route::patch('properties/{id}/approve', [Admin\PropertyController::class, 'approve'])->name('admin.properties.approve');
    Route::delete('properties/{id}', [Admin\PropertyController::class, 'destroy'])->name('admin.properties.destroy');
    
    // --- QUẢN LÝ NGƯỜI DÙNG ---
    Route::get('users', [Admin\ManagerController::class, 'index'])->name('admin.users.index');
    Route::patch('users/{id}/make-admin', [Admin\ManagerController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
    Route::patch('users/{id}/remove-admin', [Admin\ManagerController::class, 'removeAdmin'])->name('admin.users.removeAdmin');

});

// ====================================================
// 🚪 CHỨC NĂNG ĐĂNG XUẤT (POST Method chuẩn mực)
// ====================================================
// Lưu ý: Tên route nên là 'logout' để đồng bộ với Form/Breeze
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
require __DIR__ . '/auth.php'; // Route mặc định của Breeze