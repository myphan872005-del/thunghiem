<?php

namespace App\Http\Controllers\Search;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Ward; 

class LocationController extends Controller
{
    public function getWardsByCity($cityId)
    {
        // Sử dụng Model đã import
        $wards = Ward::where('CityID', $cityId)->get();

        return response()->json([
            'success' => true,
            'data' => $wards
        ]);
    }

    public function getCity(){
        // Sử dụng Model đã import
        $cities = City::all();

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }
}