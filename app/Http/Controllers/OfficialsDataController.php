<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficialsData;
use App\Models\MunicipalData;
use App\Models\ProvincialData;

class OfficialsDataController extends Controller
{
    public function index()
    {
        $officialsData = OfficialsData::all();
        return view('officials-data.index', compact('officialsData'));
    }

    public function create()
    {
        $provinces = ProvincialData::all();
        $municipalities = MunicipalData::all();
        return view('officials-data.create', compact('provinces', 'municipalities'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'province_id' => 'required|exists:provincial_data,id',
            'municipality_id' => 'required|exists:municipal_data,id',
            'official_image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('official_image')) {
            $validatedData['official_image'] = $request->file('official_image')->store('official_images', 'public');
        }

        OfficialsData::create($validatedData);

        return redirect()->route('officials-data.index')
            ->with('success', 'Official added successfully.');
    }

    public function show($id)
    {
        $official = OfficialsData::findOrFail($id);
        return view('officials-data.show', compact('official'));
    }

    public function edit($id)
    {
        $official = OfficialsData::findOrFail($id);
        $provinces = ProvincialData::all();
        $municipalities = MunicipalData::all();
        return view('officials-data.edit', compact('official', 'provinces', 'municipalities'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'province_id' => 'required|exists:provincial_data,id',
            'municipality_id' => 'required|exists:municipal_data,id',
            'official_image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('official_image')) {
            $validatedData['official_image'] = $request->file('official_image')->store('official_images', 'public');
        }

        $official = OfficialsData::findOrFail($id);
        $official->update($validatedData);

        return redirect()->route('officials-data.index')
            ->with('success', 'Official updated successfully.');
    }

    public function destroy($id)
    {
        $official = OfficialsData::findOrFail($id);
        $official->delete();

        return redirect()->route('officials-data.index')
            ->with('success', 'Official deleted successfully.');
    }


    public function getMunicipalities($province_id)
    {
        $municipalities = MunicipalData::where('province_id', $province_id)->get();
        return response()->json($municipalities);
    }

}

