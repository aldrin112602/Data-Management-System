@extends('layouts.app')

@section('title', 'Municipal Data')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Municipal Data</h1>

    <a href="{{ route('municipal-data.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Add Municipality</a>

    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Municipal Name</th>
                <th class="px-4 py-2 text-left">Province</th>
                <th class="px-4 py-2 text-left">Logo</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($municipalData as $municipality)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $municipality->municipal_name }}</td>
                    <td class="px-4 py-2">{{ $municipality->province->province_name }}</td>
                    <td class="px-4 py-2"><img src="{{ asset('storage/' . $municipality->municipal_logo) }}" class="w-12 h-12 object-cover" alt="Logo"></td>
                    <td class="px-4 py-2">{{ $municipality->description }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('municipal-data.edit', $municipality->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('municipal-data.destroy', $municipality->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
