<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinnedLocation;
use App\Models\notification;

class PinnedLocationController extends Controller
{
    public function index(Request $request)
    {
        $pinnedLocations = PinnedLocation::paginate(10);

        // Pass only the data portion to the view for Mapbox
        $pinnedLocationsData = $pinnedLocations->items(); // Extract the actual data array

        return view('pinned-locations.index', compact('pinnedLocations', 'pinnedLocationsData'));
    }


    public function approve($id)
    {
        $pinnedLocation = PinnedLocation::find($id);

        if ($pinnedLocation) {
            $pinnedLocation->update(['status' => 'approved']);

            Notification::create([
                'user_id' => $pinnedLocation->user_id,
                'title' => 'Pinned Location Approved',
                'message' => 'Your pinned location has been approved by the admin!',
            ]);

            return redirect()->back()->with('success', 'Location approved and uploader notified.');
        }

        return redirect()->back()->with('error', 'Pinned location not found.');
    }

    public function destroy($id)
    {
        $pinnedLocation = PinnedLocation::find($id);

        if ($pinnedLocation) {
            Notification::create([
                'user_id' => $pinnedLocation->user_id,
                'title' => 'Pinned Location Deleted',
                'message' => 'Your pinned location has been deleted by the admin.',
            ]);

            $pinnedLocation->delete();

            return redirect()->back()->with('success', 'Pinned location deleted and uploader notified.');
        }

        return redirect()->back()->with('error', 'Pinned location not found.');
    }
}