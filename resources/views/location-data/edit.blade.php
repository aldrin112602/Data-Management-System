@extends('layouts.app')

@section('title', 'Edit Location')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Location</h1>

    <form action="{{ route('location-data.update', $locationData->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="location_type" class="block text-gray-700">Location Type</label>
            <input type="text" name="location_type" id="location_type" value="{{ old('location_type', $locationData->location_type) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="location_logo" class="block text-gray-700">Location Logo</label>
            <input type="file" name="location_logo" id="location_logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @if ($locationData->location_logo)
                <img src="{{ asset('storage/' . $locationData->location_logo) }}" alt="Location Logo" class="mt-2" style="max-width: 150px;">
            @endif
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $locationData->description) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Update</button>
            <a href="{{ route('location-data.index') }}" class="ml-4 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>
@endsection
