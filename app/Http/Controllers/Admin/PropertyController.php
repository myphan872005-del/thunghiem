<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
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
        $property = Property::findOrFail($id);
        
        $property->update(['Status' => 'Approved']);

        return redirect()->route('admin.properties.index')->with('success', 'Đã duyệt tin đăng thành công.');
    }

    /**
     * Xử lý xóa tin (Kèm theo xóa ảnh trong Storage)
     */
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