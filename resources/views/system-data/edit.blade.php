@extends('layouts.app')

@section('title', 'Edit System Data')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit System Data</h1>

    <form action="{{ route('system-data.update', $systemData->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ $systemData->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="value" class="block text-gray-700">Value</label>
            <input type="text" name="value" id="value" value="{{ $systemData->value }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Update</button>
            <a href="{{ route('system-data.index') }}" class="ml-4 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>
@endsection
