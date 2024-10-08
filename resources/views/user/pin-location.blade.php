@extends('user.layouts.app')

@section('content')
    <h1>Pin a Location</h1>

    <form action="{{ route('user.storePinnedLocation') }}" method="POST">
        @csrf
        <div>
            <label for="location_name">Location Name</label>
            <input type="text" id="location_name" name="location_name" required class="border p-2 rounded">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required class="border p-2 rounded"></textarea>
        </div>

        <div>
            <label for="latitude">Latitude</label>
            <input type="text" id="latitude" name="latitude" required class="border p-2 rounded">
        </div>

        <div>
            <label for="longitude">Longitude</label>
            <input type="text" id="longitude" name="longitude" required class="border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
    </form>
@endsection
