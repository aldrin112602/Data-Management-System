@extends('layouts.app')

@section('title', 'Location Data')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Location Data</h1>

    <a href="{{ route('location-data.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Add Location</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Logo</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locationData as $location)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $location->location_type }}</td>
                        <td class="px-4 py-2">
                            @if ($location->location_logo)
                                <img src="{{ asset('storage/' . $location->location_logo) }}" alt="Location Logo" class="w-16 h-16 object-cover">
                            @else
                                No Logo
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ Str::limit($location->description, 50) }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('location-data.edit', $location->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('location-data.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
