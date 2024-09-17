@extends('layouts.app')

@section('title', 'Edit Municipality')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Municipality</h1>

    <form action="{{ route('municipal-data.update', $municipalData->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="municipal_name" class="block text-gray-700">Municipality Name</label>
            <input type="text" name="municipal_name" id="municipal_name" value="{{ $municipalData->municipal_name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="province_id" class="block text-gray-700">Province</label>
            <select name="province_id" id="province_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}" {{ $municipalData->province_id == $province->id ? 'selected' : '' }}>
                        {{ $province->province_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="municipal_logo" class="block text-gray-700">Municipal Logo</label>
            <input type="file" name="municipal_logo" id="municipal_logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @if ($municipalData->municipal_logo)
                <img src="{{ asset('storage/' . $municipalData->municipal_logo) }}" class="w-12 h-12 mt-2" alt="Current Logo">
            @endif
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $municipalData->description }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Update</button>
            <a href="{{ route('municipal-data.index') }}" class="ml-4 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>
@endsection
