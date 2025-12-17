<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // ⭐️ ĐOẠN CODE CẦN THÊM VÀO ĐÂY ⭐️
        
        // Lấy thông tin người dùng vừa đăng nhập
        $user = Auth::user();

        // Kiểm tra RoleID
        if ($user->RoleID == 1) {
            // Nếu là Admin, chuyển hướng đến khu vực Admin
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        // Nếu là User thường, chuyển hướng đến khu vực User mặc định (hoặc Dashboard chung)
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
