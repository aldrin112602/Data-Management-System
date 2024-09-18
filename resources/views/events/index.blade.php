@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Manage Events</h1>

    <a href="{{ route('events.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4">Add New Event</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Title</th>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Description</th>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Media</th>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="border-b">
                        <td class="py-4 px-6">{{ $event->title }}</td>
                        <td class="py-4 px-6">{{ $event->description }}</td>
                        <td class="py-4 px-6">
                            @if (Str::contains($event->media, ['jpeg', 'jpg', 'png']))
                                <img src="{{ $event->media }}" alt="{{ $event->title }}" class="w-20 h-20 object-cover">
                            @else
                                <video src="{{ $event->media }}" class="w-20" controls></video>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('events.edit', $event->id) }}" class="inline-block bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $events->links('pagination::tailwind') }}
    </div>
@endsection
