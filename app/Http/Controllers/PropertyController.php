<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
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
public function myProperties(): View
    {
        // ✅ CODE SẠCH: Lấy danh sách tin đăng của User hiện tại
        $properties = Property::where('user_id', Auth::id()) 
                              ->latest()
                              ->paginate(10); 
        
        // Lấy số lượng tin đăng
        $listingCount = Property::where('user_id', Auth::id())->count();
        
        // Truyền cả 2 biến vào View
        return view('user.properties.index', compact('properties', 'listingCount'));
    }
}
