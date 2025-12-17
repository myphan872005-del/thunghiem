<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Search\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Middleware\IsAdmin; 

// ====================================================
// 🌏 KHU VỰC CÔNG KHAI (AI CŨNG XEM ĐƯỢC)
// ====================================================
Route::get('/', [PropertyController::class, 'index'])->name('home');

// Danh sách Tin đăng
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

// 🌟 ROUTE CHI TIẾT BĐS (ĐÃ KHÔI PHỤC VÀ SỬA LỖI TRONG VIEW)
Route::get('/property/{id}', [PropertyController::class, 'show'])
    ->name('properties.show')
    ->where('id', '[0-9]+');

// API Lấy dữ liệu vị trí (cho Public)
Route::get('/getWard/{cityId}', [LocationController::class, 'getWardsByCity']);
Route::get('/getCity', [LocationController::class, 'getCity']);

// Route tìm kiếm
Route::get('/search', [SearchController::class, 'index'])->name('properties.indexSearch'); 

// ====================================================
// 🔒 KHU VỰC CHỈ CẦN ĐĂNG NHẬP (USER/ADMIN ĐỀU VÀO ĐƯỢC)
// ====================================================
Route::middleware('auth')->group(function () {

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- CHỨC NĂNG ĐĂNG TIN ---
    Route::get('/property/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('properties.store');

    // API lấy phường xã (cho Javascript)
    Route::get('/get-wards/{city_id}', [PropertyController::class, 'getWards']);

    // 🌟 ROUTE QUẢN LÝ TIN ĐĂNG CỦA TÔI (ĐÃ ĐƯỢC BẢO VỆ DỨT ĐIỂM)
    Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('user.properties.index');
});

// ====================================================
// 👑 KHU VỰC ADMIN (CHỈ ROLE=1 MỚI VÀO ĐƯỢC)
// ====================================================
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    
    // Trang chủ Admin Dashboard
    Route::get('/', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    // --- QUẢN LÝ TIN ĐĂNG ---
    Route::get('properties', [Admin\PropertyController::class, 'index'])->name('admin.properties.index');
    
    // 🌟 ROUTE DUYỆT BÀI 
    Route::patch('properties/{id}/approve', [Admin\PropertyController::class, 'approve'])->name('admin.properties.approve');
    
    Route::delete('properties/{id}', [Admin\PropertyController::class, 'destroy'])->name('admin.properties.destroy');
    

    // --- QUẢN LÝ NGƯỜI DÙNG ---
    Route::get('users', [Admin\ManagerController::class, 'index'])->name('admin.users.index');
    Route::patch('users/{id}/make-admin', [Admin\ManagerController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
    Route::patch('users/{id}/remove-admin', [Admin\ManagerController::class, 'removeAdmin'])->name('admin.users.removeAdmin');

});

// ====================================================
// 🚪 ROUTE MẶC ĐỊNH CỦA BREEZE (AUTH)
// ====================================================
require __DIR__ . '/auth.php';