<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::when($request->date, function ($query) use ($request) {
                return $query->whereDate('created_at', $request->date);
            })
            ->paginate(10);

        return view('reviews.index', compact('reviews'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'location_id' => 'required|exists:locations,id',
            'description' => 'required',
            // Add other fields as necessary
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully');
    }


    public function approve($id)
    {
        // Retrieve the review
        $review = Review::find($id);

        if ($review) {

            $review->update(['status' => 'approved']);

            DB::table('notifications')->insert([
                'user_id' => $review->user_id,
                'title' => 'Review Approved',
                'message' => 'Your review has been approved!',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Review approved and user notified.');
        }

        return redirect()->back()->with('error', 'Review not found');
    }

    public function destroy($id)
    {
        // Retrieve the review
        $review = Review::find($id);

        if ($review) {
            // Notify the user that the review was deleted
            DB::table('notifications')->insert([
                'user_id' => $review->user_id,
                'title' => 'Review Deleted',
                'message' => 'Your review was deleted as it did not meet the guidelines.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Delete the review
            $review->delete();

            return redirect()->back()->with('success', 'Review deleted and user notified.');
        }

        return redirect()->back()->with('error', 'Review not found.');
    }
}
