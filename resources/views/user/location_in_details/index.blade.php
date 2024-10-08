@extends('user.layouts.app')
@section('content')
    <h1 class="text-2xl font-bold mb-4">Location In Details</h1>

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
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
