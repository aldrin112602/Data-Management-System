<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function getReviews($locationId)
    {
        $reviews = Review::where('location_id', $locationId)->with('user')->get();
        $isLoggedIn = Auth::check();

        return response()->json([
            'reviews' => $reviews,
            'isLoggedIn' => $isLoggedIn,
        ]);
    }
    public function addReview(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'location_id' => $request->location_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Review submitted successfully']);
    }
}
