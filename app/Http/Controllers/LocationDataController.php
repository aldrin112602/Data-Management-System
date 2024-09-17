<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationData;
use Illuminate\Support\Facades\Storage;

class LocationDataController extends Controller
{
    public function index()
    {
        $locationData = LocationData::all();
        return view('location-data.index', compact('locationData'));
    }

    public function create()
    {
        return view('location-data.create');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location_type' => 'required|string|max:255',
            'location_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('location_logo')) {
            $validatedData['location_logo'] = $request->file('location_logo')->store('location_logos', 'public');
        }

        LocationData::create($validatedData);

        return redirect()->route('location-data.index')
            ->with('success', 'Location added successfully.');
    }

    public function show($id)
    {
        $locationData = LocationData::findOrFail($id);
        return view('location-data.show', compact('locationData'));
    }

    public function edit($id)
    {
        $locationData = LocationData::findOrFail($id);
        return view('location-data.edit', compact('locationData'));
    }

    public function update(Request $request, $id)
{
    // Validate form data
    $validatedData = $request->validate([
        'location_type' => 'required|string|max:255',
        'location_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'nullable|string',
    ]);

    $locationData = LocationData::findOrFail($id);

    if ($request->hasFile('location_logo')) {
        if ($locationData->location_logo) {
            Storage::disk('public')->delete($locationData->location_logo);
        }

        $logoPath = $request->file('location_logo')->store('location_logos', 'public');
        $validatedData['location_logo'] = $logoPath;
    }

    $locationData->update($validatedData);

    return redirect()->route('location-data.index')
        ->with('success', 'Location data updated successfully.');
}


    public function destroy($id)
    {
        $locationData = LocationData::findOrFail($id);
        $locationData->delete();

        return redirect()->route('location-data.index')
            ->with('success', 'Location data deleted successfully.');
    }
}

