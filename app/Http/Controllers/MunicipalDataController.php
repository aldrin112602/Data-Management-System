<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MunicipalData;
use App\Models\ProvincialData;

class MunicipalDataController extends Controller
{
    public function index()
    {
        $municipalData = MunicipalData::all();
        return view('municipal-data.index', compact('municipalData'));
    }

    public function create()
    {
        $provinces = ProvincialData::all();
        return view('municipal-data.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'municipal_name' => 'required|string|max:255',
            'province_id' => 'required|exists:provincial_data,id',
            'municipal_logo' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('municipal_logo')) {
            $validatedData['municipal_logo'] = $request->file('municipal_logo')->store('municipal_logos', 'public');
        }

        MunicipalData::create($validatedData);

        return redirect()->route('municipal-data.index')
            ->with('success', 'Municipal data added successfully.');
    }

    public function show($id)
    {
        $municipalData = MunicipalData::findOrFail($id);
        return view('municipal-data.show', compact('municipalData'));
    }

    public function edit($id)
    {
        $municipalData = MunicipalData::findOrFail($id);
        $provinces = ProvincialData::all();
        return view('municipal-data.edit', compact('municipalData', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'municipal_name' => 'required|string|max:255',
            'province_id' => 'required|exists:provincial_data,id',
            'municipal_logo' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('municipal_logo')) {
            $validatedData['municipal_logo'] = $request->file('municipal_logo')->store('municipal_logos', 'public');
        }

        $municipalData = MunicipalData::findOrFail($id);
        $municipalData->update($validatedData);

        return redirect()->route('municipal-data.index')
            ->with('success', 'Municipal data updated successfully.');
    }

    public function destroy($id)
    {
        $municipalData = MunicipalData::findOrFail($id);
        $municipalData->delete();

        return redirect()->route('municipal-data.index')
            ->with('success', 'Municipal data deleted successfully.');
    }
}
