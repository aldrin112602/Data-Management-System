@extends('layouts.app')

@section('title', 'Officials Data')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Officials Data</h1>

    <a href="{{ route('officials-data.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Add Official</a>

    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Position</th>
                <th class="px-4 py-2 text-left">Province</th>
                <th class="px-4 py-2 text-left">Municipality</th>
                <th class="px-4 py-2 text-left">Image</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($officialsData as $official)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $official->name }}</td>
                    <td class="px-4 py-2">{{ $official->position }}</td>
                    <td class="px-4 py-2">{{ $official->province->province_name }}</td>
                    <td class="px-4 py-2">{{ $official->municipality->municipal_name }}</td>
                    <td class="px-4 py-2"><img src="{{ asset('storage/' . $official->official_image) }}" class="w-12 h-12 object-cover" alt="Image"></td>
                    <td class="px-4 py-2">{{ $official->description }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('officials-data.edit', $official->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('officials-data.destroy', $official->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
