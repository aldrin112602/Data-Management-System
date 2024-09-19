@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Manage Pinned Locations</h1>

    <div class="mb-6">
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pinnedLocations as $pinnedLocation)
                    <tr>
                        <td class="border px-4 py-2">{{ $pinnedLocation->user->name ?? null }}</td>
                        <td class="border px-4 py-2">{{ $pinnedLocation->location->name ?? null }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($pinnedLocation->status) }}</td>
                        <td class="border px-4 py-2">
                            @if ($pinnedLocation->status === 'pending')
                                <form action="{{ route('pinned-locations.approve', $pinnedLocation->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
                                        Approve
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('pinned-locations.destroy', $pinnedLocation->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pinnedLocations->links() }}
    </div>

    <!-- Map container -->
    <div id="map" style="width: 100%; height: 500px;"></div>
@endsection

@push('scripts')
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet" />

    <script>
        'use strict';
        mapboxgl.accessToken = 'pk.eyJ1Ijoicm9uZWwtNjY2IiwiYSI6ImNsanY5bmZuNDBvNWcza21oeGtoYjRudjUifQ.SY_2i8fuKAAaj6aApGbNpw';

        const map = new mapboxgl.Map({
            container: 'map', 
            style: 'mapbox://styles/ronel-666/clk3ff146006y01pg9z4t17es', 
            center: [121.493735, 16.600410], // Diffun, Quirino coordinates
            zoom: 12 
        });

        // Add navigation controls to the map
        map.addControl(new mapboxgl.NavigationControl());

        const pinnedLocationsData = @json($pinnedLocationsData);

        console.log(pinnedLocationsData)

        // Loop through each pinned location and add a marker
        pinnedLocationsData.forEach(function(pinnedLocation) {
            const marker = new mapboxgl.Marker()
                .setLngLat([pinnedLocation.longitude, pinnedLocation.latitude])
                .addTo(map);

            // Create a popup with location information
            const popup = new mapboxgl.Popup({ offset: 25 })
                .setHTML(`<h3>${pinnedLocation.location?.name?? "NA"}</h3><p>Status: ${pinnedLocation.status}</p>`);

            marker.setPopup(popup);
        });
    </script>
@endpush
