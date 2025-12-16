<?php

namespace App\Http\Controllers; // ⭐️ DÒNG BẮT BUỘC PHẢI THÊM ⭐️

use App\Models\Property;
use Illuminate\Routing\Controller;

class PropertyController extends Controller
{
    /**
     * Hiển thị danh sách BĐS (chỉ những BĐS đã được duyệt).
     */
    public function index()
    {
        // Sử dụng eager loading để tải đồng thời Ward và City (ward.city)
        $properties = Property::with('ward.city')
                                 ->where('Status', 'Approved')
                                 ->paginate(10); 

        return view('property.index', compact('properties'));
    }
}