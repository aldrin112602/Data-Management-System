<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LocationInformation;
use App\Models\Review;

class MapController extends Controller
{
    public function dashboard()
    {
        // Fetch all location information from the database
        $locations = LocationInformation::all();

        return view('user.dashboard', [
            'locations' => $locations,
        ]);
    }



    public function locationDetails()
    {
        $locationInformation = LocationInformation::all();
        return view('user.location_in_details.index', compact('locationInformation'));
    }




    public function getReviews(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
        ]);

        $reviews = Review::where('status', 'approved')
            ->where('location_id', $request->location_id)
            ->get();
        return response()->json($reviews, 200);
    }
}
