<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kiểm tra đã đăng nhập chưa
        if (!Auth::check()) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('login');
        }

        // 2. Kiểm tra vai trò (RoleID)
        // Dựa trên User Model và Seeder của em (RoleID = 1 là Admin)
        if (Auth::user()->RoleID != 1) {
            // Nếu không phải Admin, chuyển hướng về trang chủ và báo lỗi
            return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực này.');
        }

        // Nếu là Admin, cho phép request đi tiếp
        return $next($request);
    }
}