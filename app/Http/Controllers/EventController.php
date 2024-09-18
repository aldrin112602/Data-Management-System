<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'media' => 'required|mimes:jpeg,png,jpg,mp4,mov',
        ]);

        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('public/events');
            $validatedData['media'] = Storage::url($path);
        }

        Event::create($validatedData);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'media' => 'nullable|mimes:jpeg,png,jpg,mp4,mov', 
        ]);

        if ($request->hasFile('media')) {
            if ($event->media) {
                Storage::delete(str_replace('/storage/', 'public/', $event->media));
            }

            $path = $request->file('media')->store('public/events');
            $validatedData['media'] = Storage::url($path);
        }

        $event->update($validatedData);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->media) {
            Storage::delete(str_replace('/storage/', 'public/', $event->media));
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
