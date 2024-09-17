@extends('layouts.app')

@section('title', 'Provincial Data')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Provincial Data</h1>

    <a href="{{ route('provincial-data.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Add Province</a>

    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Province Name</th>
                <th class="px-4 py-2 text-left">Logo</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($provincialData as $province)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $province->province_name }}</td>
                    <td class="px-4 py-2"><img src="{{ asset('storage/' . $province->province_logo) }}" class="w-12 h-12 object-cover" alt="Logo"></td>
                    <td class="px-4 py-2">{{ $province->description }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('provincial-data.edit', $province->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('provincial-data.destroy', $province->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
