@extends('layouts.app')

@section('title', 'System Data')

@section('content')
    <h1 class="text-2xl font-bold mb-4">System Data</h1>

    <a href="{{ route('system-data.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4 inline-block">Add System Data</a>

    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Value</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($systemData as $data)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $data->name }}</td>
                    <td class="px-4 py-2">{{ $data->value }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('system-data.edit', $data->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('system-data.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
