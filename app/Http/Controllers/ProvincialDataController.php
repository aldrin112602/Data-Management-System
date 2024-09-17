<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProvincialData;

class ProvincialDataController extends Controller
{
    public function index()
    {
        $provincialData = ProvincialData::all();
        return view('provincial-data.index', compact('provincialData'));
    }

    public function create()
    {
        return view('provincial-data.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'province_name' => 'required|string|max:255',
            'province_logo' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('province_logo')) {
            $validatedData['province_logo'] = $request->file('province_logo')->store('province_logos', 'public');
        }

        ProvincialData::create($validatedData);

        return redirect()->route('provincial-data.index')
            ->with('success', 'Provincial data added successfully.');
    }

    public function show($id)
    {
        $provincialData = ProvincialData::findOrFail($id);
        return view('provincial-data.show', compact('provincialData'));
    }

    public function edit($id)
    {
        $provincialData = ProvincialData::findOrFail($id);
        return view('provincial-data.edit', compact('provincialData'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'province_name' => 'required|string|max:255',
            'province_logo' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('province_logo')) {
            $validatedData['province_logo'] = $request->file('province_logo')->store('province_logos', 'public');
        }

        $provincialData = ProvincialData::findOrFail($id);
        $provincialData->update($validatedData);

        return redirect()->route('provincial-data.index')
            ->with('success', 'Provincial data updated successfully.');
    }

    public function destroy($id)
    {
        $provincialData = ProvincialData::findOrFail($id);
        $provincialData->delete();

        return redirect()->route('provincial-data.index')
            ->with('success', 'Provincial data deleted successfully.');
    }
}

