<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// ====================================================
// 🌏 KHU VỰC CÔNG KHAI (AI CŨNG XEM ĐƯỢC)
// ====================================================

// 1. Trang chủ: Hiển thị danh sách tin
Route::get('/', [PropertyController::class, 'index'])->name('home');

// 2. Trang danh sách (Link phụ)
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

// 3. Xem chi tiết tin đăng
// Thêm ->where('id', '[0-9]+') để bắt buộc ID phải là số
Route::get('/property/{id}', [PropertyController::class, 'show'])
    ->name('properties.show')
    ->where('id', '[0-9]+');

// ====================================================
// 🔒 KHU VỰC ĐĂNG NHẬP (PHẢI LOGIN MỚI VÀO ĐƯỢC)
// ====================================================
Route::middleware('auth')->group(function () {

    // --- CHỨC NĂNG ĐĂNG TIN (Cái bạn đang bị lỗi 404 nằm ở đây) ---
    Route::get('/property/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('properties.store');

    // API lấy phường xã (cho Javascript)
    Route::get('/get-wards/{city_id}', [PropertyController::class, 'getWards']);

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ====================================================
// 🚪 CHỨC NĂNG ĐĂNG XUẤT (FIX LỖI)
// ====================================================
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.get');

require __DIR__ . '/auth.php';
