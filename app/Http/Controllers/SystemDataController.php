<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemData;

class SystemDataController extends Controller
{
    public function index()
    {
        $systemData = SystemData::all();
        return view('system-data.index', compact('systemData'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        SystemData::create($validatedData);

        return redirect()->route('system-data.index')
            ->with('success', 'System data added successfully.');
    }

    public function create()
    {
        return view('system-data.create');
    }

    public function show($id)
    {
        $systemData = SystemData::findOrFail($id);
        return view('system-data.show', compact('systemData'));
    }

    public function edit($id)
    {
        $systemData = SystemData::findOrFail($id);
        return view('system-data.edit', compact('systemData'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $systemData = SystemData::findOrFail($id);
        $systemData->update($validatedData);

        return redirect()->route('system-data.index')
            ->with('success', 'System data updated successfully.');
    }

    public function destroy($id)
    {
        $systemData = SystemData::findOrFail($id);
        $systemData->delete();

        return redirect()->route('system-data.index')
            ->with('success', 'System data deleted successfully.');
    }
}
