<?php

namespace App\Http\Controllers;
use App\models\Property;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        //Lấy tất cả tham số từ chuỗi truy vấn (query string)
        $filters = $request->all();

        $listings = Property::query()
            ->when(isset($filters['CityID']), function ($query) use ($filters) {
                return $query->where('city_id', $filters['CityID']);
            })
            ->when(isset($filters['WardID']), function ($query) use ($filters) {
                return $query->where('ward_id', $filters['WardID']);
            })
            // Thêm các logic lọc khác (MinPrice, MaxArea, ListingType, ...)
            ->paginate(10); 

        return response()->json([
            'success' => true,
            'data' => $listings->items(),
            'pagination' => [
                'total' => $listings->total(),
                'per_page' => $listings->perPage(),
                'current_page' => $listings->currentPage(),
            ]
        ]);
    }
}
