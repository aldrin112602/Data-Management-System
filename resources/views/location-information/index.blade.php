@extends('layouts.app')

@section('title', 'Location Information')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Location Information</h1>

    <a href="{{ route('location-information.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Add Location Information</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Location Name</th>
                    <th class="px-4 py-2 text-left">Address</th>
                    <th class="px-4 py-2 text-left">Province</th>
                    <th class="px-4 py-2 text-left">Municipality</th>
                    <th class="px-4 py-2 text-left">Owner</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Latitude</th>
                    <th class="px-4 py-2 text-left">Longitude</th>
                    <th class="px-4 py-2 text-left">Image</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locationInformation as $info)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $info->location_name }}</td>
                        <td class="px-4 py-2">{{ $info->address }}</td>
                        <td class="px-4 py-2">{{ $info->province->province_name }}</td>
                        <td class="px-4 py-2">{{ $info->municipality->municipal_name }}</td>
                        <td class="px-4 py-2">{{ $info->owner ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ Str::limit($info->description, 50) }}</td>
                        <td class="px-4 py-2">{{ $info->latitude ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $info->longitude ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ Storage::url($info->image) }}" alt="Uploded Image" class="mt-2" style="max-width: 30px;">
                        </td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('location-information.edit', $info->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('location-information.destroy', $info->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
