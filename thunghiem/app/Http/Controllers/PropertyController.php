<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
class PropertyController extends Controller
{
    /**
     * 1. Hiển thị danh sách BĐS (Trang chủ hoặc trang danh sách)
     * Đây là đoạn code bạn vừa hỏi
     */
    public function index()
    {
        // Eager loading 'city' và 'ward' để tránh lỗi N+1 query
        // Lưu ý: Nếu muốn hiện tin mới đăng (Pending) để test thì tạm thời bỏ dòng where 'Approved' đi nhé
        $properties = Property::with(['city', 'ward'])
            ->where('Status', 'Approved') // Chỉ lấy tin đã duyệt
            ->orderBy('created_at', 'desc') // Tin mới nhất lên đầu
            ->paginate(10);

        return view('property.index', compact('properties'));
    }

    /**
     * 2. Hiển thị form đăng tin (Code cũ)
     */
    public function create()
    {
        $cities = City::all();
        return view('property.create', compact('cities'));
    }

    /**
     * 3. API lấy danh sách Phường (Code cũ)
     */
    public function getWards($city_id)
    {
        $wards = Ward::where('CityID', $city_id)->get();
        return response()->json($wards);
    }

    /**
     * 4. Xử lý lưu tin vào Database (Code cũ)
     */
    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required|max:255',
            'Price' => 'required|numeric',
            'Area' => 'required|numeric',
            'CityID' => 'required',
            'WardID' => 'required',
            'Address' => 'required',
            'ListingType' => 'required',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $imagePath = null;
        if ($request->hasFile('Image')) {
            $path = $request->file('Image')->store('properties', 'public');
            $imagePath = $path;
        }

        Property::create([
            'user_id' => Auth::id(),
            'Title' => $request->Title,
            'Description' => $request->Description,
            'Address' => $request->Address,
            'Image' => $imagePath,
            'CityID' => $request->CityID,
            'WardID' => $request->WardID,
            'ListingType' => $request->ListingType,
            'Price' => $request->Price,
            'Area' => $request->Area,
            'Status' => 'Pending', // Mặc định chờ duyệt
        ]);

        return redirect()->route('home')->with('success', 'Tin đăng đã được gửi thành công, vui lòng chờ admin duyệt.');
    }

   public function show($id)
{
    $property = Property::with(['city', 'ward', 'user'])->findOrFail($id);

    // Bổ sung Logic: Chỉ hiển thị nếu tin đã duyệt HOẶC là tin của người dùng hiện tại
    if ($property->Status != 'Approved' && (!Auth::check() || Auth::id() != $property->user_id)) {
        // Nếu tin CHƯA DUYỆT VÀ KHÔNG PHẢI CHỦ SỞ HỮU, báo lỗi 404
        abort(404);
    }
    
    return view('property.show', compact('property'));
}
public function myProperties()
    {
        // 1. Lấy ID người dùng hiện tại
        $userId = Auth::id();

        // 2. Lấy danh sách tin để hiện bảng (Phân trang 10 tin)
        // Code sạch: Dùng latest() để tin mới nhất lên đầu
        $properties = Property::where('user_id', $userId)
                              ->latest()
                              ->paginate(10); 
        
        // 3. Đếm tổng số tin (để hiện trên tiêu đề)
        $listingCount = Property::where('user_id', $userId)->count();

        // 4. Đếm số tin ĐÃ DUYỆT (để tính cấp độ)
        // Lưu ý: Đảm bảo cột trong Database là 'Status' và giá trị là 'Approved'
        $approvedCount = Property::where('user_id', $userId)
                                 ->where('Status', 'Approved') 
                                 ->count();

        // 5. LOGIC TÍNH CẤP ĐỘ (GAMIFICATION)
        $rankName = 'Sơ Cấp';
        $nextRank = 'Trung Cấp';
        $target = 5;      // Mục tiêu mặc định
        $color = 'gray';  

        if ($approvedCount >= 10) {
            $rankName = 'Cao Cấp (VIP)';
            $nextRank = 'Max Level';
            $target = 1000; // Đã max cấp
            $color = 'purple';
        } elseif ($approvedCount >= 5) {
            $rankName = 'Trung Cấp';
            $nextRank = 'Cao Cấp';
            $target = 10;
            $color = 'blue';
        }

        // 6. Tính phần trăm thanh chạy
        if ($approvedCount >= 10) {
            $progressPercent = 100;
        } else {
            // Toán tử 3 ngôi: Nếu target > 0 thì dùng target, không thì dùng 5 (tránh lỗi chia cho 0)
            $realTarget = $target > 0 ? $target : 5;
            $progressPercent = ($approvedCount / $realTarget) * 100;
        }

        // 7. TRẢ VỀ VIEW
        return view('user.properties.index', compact(
            'properties', 
            'listingCount', 
            'approvedCount', 
            'rankName', 
            'progressPercent', 
            'target', 
            'nextRank', 
            'color'
        ));
    }
}