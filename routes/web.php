<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Auth;

// 1. ROUTE GỐC (/) - HIỂN THỊ TRANG CHÍNH (DASHBOARD) CHO TẤT CẢ MỌI NGƯỜI
Route::get('/', function () {
    // Nếu bạn muốn hiển thị file dashboard.blade.php ngay từ đầu:
    return view('dashboard');
})->name('home');

// 2. ROUTE /dashboard - LÀM CHO NÓ CŨNG CÔNG KHAI 
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); // ⭐️ KHÔNG CÓ MIDDLEWARE AUTH HOẶC VERIFIED ⭐️

// 3. GROUP ROUTE CẦN ĐĂNG NHẬP (Chỉ dành cho các chức năng nhạy cảm: Profile, Đăng bài)
Route::middleware('auth')->group(function () {
    
    // Route demo hiển thị danh sách BĐS (Chỉ hiển thị sau khi đăng nhập, nếu cần)
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    
    // Profile Routes vẫn được bảo vệ
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';