@extends('layouts.app')

@section('title', 'Add Province')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Province</h1>

    <form action="{{ route('provincial-data.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="province_name" class="block text-gray-700">Province Name</label>
            <input type="text" name="province_name" id="province_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="province_logo" class="block text-gray-700">Province Logo</label>
            <input type="file" name="province_logo" id="province_logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Save</button>
            <a href="{{ route('provincial-data.index') }}" class="ml-4 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>
@endsection
