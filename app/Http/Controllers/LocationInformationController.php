<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationInformation;
use App\Models\ProvincialData;
use App\Models\MunicipalData;
use Illuminate\Support\Facades\Storage;


class LocationInformationController extends Controller
{
    public function index()
    {
        $locationInformation = LocationInformation::all();
        return view('location-information.index', compact('locationInformation'));
    }

    public function create()
    {
        $provinces = ProvincialData::all();
        $municipalities = MunicipalData::all();
        return view('location-information.create', compact('provinces', 'municipalities'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'province_id' => 'required|exists:provincial_data,id',
            'municipality_id' => 'required|exists:municipal_data,id',
            'owner' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('location_images', 'public');
            $validatedData['image'] = $imagePath;
        }


        LocationInformation::create($validatedData);

        return redirect()->route('location-information.index')
            ->with('success', 'Location information added successfully.');
    }

    public function show($id)
    {
        $locationInfo = LocationInformation::findOrFail($id);
        return view('location-information.show', compact('locationInfo'));
    }

    public function edit($id)
    {
        $locationInformation = LocationInformation::findOrFail($id);
        $provinces = ProvincialData::all();
        $municipalities = MunicipalData::all();
        return view('location-information.edit', compact('locationInformation', 'provinces', 'municipalities'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'location_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'province_id' => 'required|exists:provincial_data,id',
            'municipality_id' => 'required|exists:municipal_data,id',
            'owner' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $locationInfo = LocationInformation::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($locationInfo->image) {
                Storage::disk('public')->delete($locationInfo->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('location_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $locationInfo->update($validatedData);

        return redirect()->route('location-information.index')
            ->with('success', 'Location information updated successfully.');
    }

    public function destroy($id)
    {
        $locationInfo = LocationInformation::findOrFail($id);
        $locationInfo->delete();

        return redirect()->route('location-information.index')
            ->with('success', 'Location information deleted successfully.');
    }
}

