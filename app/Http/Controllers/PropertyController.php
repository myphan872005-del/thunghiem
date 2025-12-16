<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\City;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('')->with('success', 'Chờ admin duyệt.');
    }

    public function show($id)
    {
        // Tìm tin theo ID, nếu không thấy thì báo lỗi 404
        // Kèm theo thông tin người đăng (user), thành phố, phường
        $property = Property::with(['city', 'ward', 'user'])->findOrFail($id);

        return view('property.show', compact('property'));
    }
}
