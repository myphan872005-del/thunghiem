<?php

namespace App\Http\Controllers\Search;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City; // Import Model City

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();
        
        if ($request->filled('CityID')) {
            $query->where('CityID', $request->CityID);
        }

        if ($request->filled('WardID')) {
            $query->where('WardID', $request->WardID);
        }

        if ($request->filled('ListingType')) {
            $query->where('ListingType', $request->ListingType);
        }

        if ($request->filled('MinPrice')) {
            $query->where('Price', '>=', $request->MinPrice);
        }

        if ($request->filled('MaxPrice')) {
            $query->where('Price', '<=', $request->MaxPrice);
        }
        
        if ($request->filled('MinArea')) {
            $query->where('Area', '>=', $request->MinArea);
        }

        if ($request->filled('MaxArea')) {
            $query->where('Area', '<=', $request->MaxArea);
        }
        
       $result = $query
        ->paginate(10)
        ->withQueryString();
    return view('property.index', ['properties' => $result]);
    }
}