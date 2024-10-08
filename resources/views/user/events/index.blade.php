@extends('user.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Events</h1>

    <!-- Sorting Links -->
    <div class="mb-4">
        <a href="?sort=asc" class="text-blue-500 underline">Sort by Date Ascending</a> | 
        <a href="?sort=desc" class="text-blue-500 underline">Sort by Date Descending</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Title</th>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Description</th>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Media</th>
                    <th class="py-3 px-6 bg-gray-200 text-left text-gray-600 uppercase text-sm font-semibold">Date</th> <!-- New Date Column -->
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="border-b">
                        <td class="py-4 px-6">{{ $event->title }}</td>
                        <td class="py-4 px-6">{{ $event->description }}</td>
                        <td class="py-4 px-6">
                            @if (Str::contains($event->media, ['jpeg', 'jpg', 'png']))
                                <img src="{{ $event->media }}" alt="{{ $event->title }}" class="w-20 h-20 object-cover">
                            @else
                                <video src="{{ $event->media }}" class="w-20" controls></video>
                            @endif
                        </td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($event->created_at)->format('M d, Y') }}</td> <!-- Display Event Date -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $events->links('pagination::tailwind') }}
    </div>
@endsection
