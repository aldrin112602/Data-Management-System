<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    public function index(Request $request)
{
    // Check if a date filter is provided
    $query = Review::query();

    if ($request->has('date')) {
        $query->whereDate('created_at', $request->input('date'));
    }

    // Paginate results after applying the filter (default 10 per page)
    $reviews = $query->paginate(10);

    // Return the view with the reviews data
    return view('reviews.index', compact('reviews'));
}

    
    
public function store(Request $request)
{
    $request->validate([
        'rating' => 'required',
        'review_text' => 'required',
        'user_name' => 'required',
        'address' => 'required',
        'gender' => 'required',
        'age' => 'required',
        'location_id' => 'required',
        'user_unique_id' => 'required',
        'media_file' => 'nullable|max:2048',
    ]);

    // Prepare data for the review
    $data = $request->all();

    // Handle the media file upload
    if ($request->hasFile('media_file')) {
        $file = $request->file('media_file');
        $path = $file->store('uploads/reviews', 'public');
        $data['media_file'] = $path;
    }

    Review::create($data);

    return response()->json(['success' => true, 'message' => 'Review submitted successfully'], 201);
}

    public function approve($id)
    {
        $review = Review::find($id);

        if ($review) {
            $review->status = 'approved';
            $review->save();

            DB::table('notifications')->insert([
                'user_id' => $review->user_unique_id,
                'title' => 'Review Approved',
                'message' => 'Your review has been approved!',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Review approved and user notified.');
        }

        return response()->json(['success' => false, 'message' => 'Review not found.'], 404);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if ($review) {
            DB::table('notifications')->insert([
                'user_id' => $review->user_unique_id,
                'title' => 'Review Deleted',
                'message' => 'Your review was deleted as it did not meet the guidelines.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $review->delete();

            return redirect()->back()->with('success', 'eview deleted and user notified.');

        }

        return redirect()->back()->withErrors(['message' => 'Review not found.']);

        
    }
}
