@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Manage Reviews</h1>

        <!-- Date filter form -->
        <form method="GET" action="{{ route('reviews.index') }}" class="mb-6">
            <label for="date" class="block text-sm font-medium text-gray-700">Filter by Date:</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}" class="mt-1 p-2 border border-gray-300 rounded-md">
            <button type="submit" class="ml-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                Filter
            </button>
        </form>

        <!-- Reviews Table -->
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b">User Name</th>
                    <th class="px-6 py-3 border-b">Review Description</th>
                    <th class="px-6 py-3 border-b">Media</th>
                    <th class="px-6 py-3 border-b">Date</th>
                    <th class="px-6 py-3 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $review->user->name ?? '' }}</td>
                        <td class="px-6 py-4 border-b">{{ $review->description }}</td>
                        <td class="px-6 py-4 border-b">
                            @if($review->media)
                                <img src="{{ asset($review->media) }}" alt="Media" class="w-16 h-16">
                            @else
                                No Media
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b">{{ $review->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 border-b">
                            @if($review->status == 'pending')
                                <form action="{{ route('reviews.approve', $review->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">Approve</button>
                                </form>
                            @endif
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
@endsection
