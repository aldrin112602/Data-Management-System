@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Event</h1>

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ $event->title }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" required>{{ $event->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="media" class="block text-sm font-medium text-gray-700">Media (Image/Video)</label>
                <input type="file" name="media" id="media" class="mt-1 block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow-sm file:border file:py-2 file:px-4 file:rounded-md file:text-sm file:font-medium file:bg-gray-50 hover:file:bg-gray-100" accept="image/*,video/*">
            </div>

            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update Event</button>
        </form>
    </div>
@endsection
