<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecyclingFacility;

class LocationFinderController extends Controller
{
    public function index()
    {
        $facilities = RecyclingFacility::all();
        return view('location-finder', compact('facilities'));
    }

    public function search(Request $request)
    {
        $query = RecyclingFacility::query();
        
        // If latitude and longitude are provided, search within radius
        if ($request->has(['lat', 'lng'])) {
            $lat = $request->input('lat');
            $lng = $request->input('lng');
            $radius = $request->input('radius', 50); // Default 50km radius
            
            $query->whereRaw("
                (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * 
                cos(radians(longitude) - radians(?)) + 
                sin(radians(?)) * sin(radians(latitude)))) <= ?
            ", [$lat, $lng, $lat, $radius]);
        }
        
        // If search term is provided, search by name or address
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }
        
        $facilities = $query->get();
        
        return response()->json($facilities);
    }
} 