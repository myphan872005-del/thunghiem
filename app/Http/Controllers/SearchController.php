<?php

namespace App\Http\Controllers;
use App\models\Property;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
{
    $query = Property::query();

    if ($request->filled('CityID')) {
        $query->where('city_id', $request->CityID);
    }

    if ($request->filled('WardID')) {
        $query->where('ward_id', $request->WardID);
    }

    if ($request->filled('ListingType')) {
        $query->where('listing_type', $request->ListingType);
    }

    if ($request->filled('MinPrice')) {
        $query->where('price', '>=', $request->MinPrice);
    }

    if ($request->filled('MaxPrice')) {
        $query->where('price', '<=', $request->MaxPrice);
    }

    $listings = $query
        ->paginate(10)
        ->withQueryString();

    return view('properties.index', compact('listings'));
}

}
