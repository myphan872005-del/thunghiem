<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Dùng để xóa file ảnh

class PropertyController extends Controller
{
    /**
     * Hiển thị danh sách tất cả tin đăng (Admin có thể xem Pending/Approved/etc.)
     */
    public function index()
    {
        // Lấy tất cả tin đăng, sắp xếp tin Pending lên đầu
        $properties = Property::with(['user', 'city', 'ward'])
            ->orderByRaw("FIELD(Status, 'Pending', 'Approved', 'Rejected')")
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        // Cần tạo view: resources/views/admin/properties/index.blade.php
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Xử lý duyệt tin (Chuyển Status sang Approved)
     */
    public function approve($id)
{
    // 🛠️ CÁCH 1: DÙNG BÚA TẠ (Query Builder) - Update bất chấp
    $affected = DB::table('properties')
        ->where('PropertyID', $id) // Đảm bảo đúng tên cột khóa chính (PropertyID hay id?)
        ->update([
            'Status'      => 'Approved',  // Gán cứng chữ này
            'is_approved' => 1            // Gán luôn cái này cho chắc
        ]);

    // Kiểm tra xem có dòng nào bị ảnh hưởng không
    if ($affected == 0) {
        return redirect()->back()->with('error', 'Lỗi: Không tìm thấy ID hoặc tin này đã duyệt rồi!');
    }

    // --- (Phần cộng điểm cho User - giữ nguyên) ---
    // Vì ta dùng DB::table nên phải lấy user_id thủ công một chút
    $prop = DB::table('properties')->where('PropertyID', $id)->first();
    if ($prop && $prop->user_id) {
        $user = \App\Models\User::find($prop->user_id);
        if ($user) {
            $user->points = ($user->points ?? 0) + 1;
            $user->save();
        }
    }

    return redirect()->back()->with('success', 'Đã DUYỆT  thành công!');
}
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        
        // ⭐️ LOGIC QUAN TRỌNG: Xóa file ảnh khỏi storage
        if ($property->Image) {
            Storage::disk('public')->delete($property->Image);
        }

        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', 'Đã xóa tin đăng thành công.');
    }
}