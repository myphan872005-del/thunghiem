<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse; // Dòng này cần thiết nếu em dùng type hint RedirectResponse

class ManagerController extends Controller
{
    // ... (Hàm index giữ nguyên)

    public function makeAdmin($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        
        $user->update(['RoleID' => 1]); 

        // SỬA LỖI Ở ĐÂY
      return back()->with('success', 'Đã cấp quyền Admin cho người dùng ' . $user->name);
    }
    public function index()
    {
        // Lấy tất cả người dùng và phân trang
        $users = User::orderBy('id', 'asc')->paginate(15); 

        return view('admin.users.index', compact('users'));
    }
    public function removeAdmin($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            // SỬA LỖI Ở ĐÂY
            return back()->with('error', 'Không thể tự hạ quyền Admin của bản thân.');
        }

        $user->update(['RoleID' => 2]); 

        // SỬA LỖI Ở ĐÂY
    return back()->with('success', 'Đã hạ quyền người dùng ' . $user->name);
    }
}