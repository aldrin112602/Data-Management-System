@extends('layouts.app')

@section('title', 'Edit Location Information')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Location Information</h1>

    <div class="flex">
        <!-- Form on the left -->
        <div class="w-1/2">
            <form enctype="multipart/form-data" action="{{ route('location-information.update', $locationInformation->id) }}" method="POST"
                class="bg-white shadow-md rounded-lg p-6">
                @csrf
                @method('PUT') <!-- This is required for update operations -->

                <div class="mb-4">
                    <label for="location_name" class="block text-gray-700">Location Name</label>
                    <input type="text" name="location_name" id="location_name"
                        value="{{ $locationInformation->location_name }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ $locationInformation->address }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="province_id" class="block text-gray-700">Province</label>
                    <select name="province_id" id="province_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select Province</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}"
                                {{ $locationInformation->province_id == $province->id ? 'selected' : '' }}>
                                {{ $province->province_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="municipality_id" class="block text-gray-700">Municipality</label>
                    <select name="municipality_id" id="municipality_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">Select Municipality</option>
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->id }}"
                                {{ $locationInformation->municipality_id == $municipality->id ? 'selected' : '' }}>
                                {{ $municipality->municipal_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="owner" class="block text-gray-700">Owner</label>
                    <input type="text" name="owner" id="owner" value="{{ $locationInformation->owner }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $locationInformation->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="latitude" class="block text-gray-700">Latitude</label>
                    <input type="text" readonly required name="latitude" id="latitude"
                        value="{{ $locationInformation->latitude }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="longitude" class="block text-gray-700">Longitude</label>
                    <input type="text" readonly required name="longitude" id="longitude"
                        value="{{ $locationInformation->longitude }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>


                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Upload Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @if ($locationInformation->image)
                        <img src="{{ Storage::url($locationInformation->image) }}" alt="Location Image" class="mt-2" style="max-width: 150px;">
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Update</button>
                    <a href="{{ route('location-information.index') }}"
                        class="ml-4 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back</a>
                </div>
            </form>
        </div>

        <!-- Map on the right -->
        <div class="w-1/2 pl-6">
            <div id="map" style="height: 500px; width: 100%;"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Set up the AJAX call for changing municipalities based on province selection
            $('#province_id').on('change', function() {
                var provinceID = $(this).val();
                if (provinceID) {
                    $.ajax({
                        url: '/getMunicipalities/' + provinceID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#municipality_id').empty();
                            $('#municipality_id').append(
                                '<option value="">Select Municipality</option>');
                            $.each(data, function(key, value) {
                                $('#municipality_id').append('<option value="' + value
                                    .id + '">' + value.municipal_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#municipality_id').empty();
                    $('#municipality_id').append('<option value="">Select Municipality</option>');
                }
            });

            // Optionally set the correct municipality if already selected
            var selectedProvinceID = $('#province_id').val();
            if (selectedProvinceID) {
                $.ajax({
                    url: '/getMunicipalities/' + selectedProvinceID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#municipality_id').empty();
                        $('#municipality_id').append('<option value="">Select Municipality</option>');
                        $.each(data, function(key, value) {
                            $('#municipality_id').append('<option value="' + value.id + '"' + (
                                    value.id ==
                                    '{{ $locationInformation->municipality_id }}' ?
                                    ' selected' : '') + '>' + value.municipal_name +
                                '</option>');
                        });
                    }
                });
            }
        });
    </script>


@section('headers')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css"
        integrity="sha512-Zcn6bjR/8RZbLEpLIeOwNtzREBAJnUKESxces60Mpoj+2okopSAcSUIUOseddDm0cxnGQzxIR7vJgsLZbdLE3w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"
        integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

<!-- Leaflet.js map script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set default view to the current location coordinates from the form
        var map = L.map('map').setView([{{ $locationInformation->latitude }},
            {{ $locationInformation->longitude }}
        ], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Capture latitude and longitude on map click
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Set the values in the form
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    });
</script>

@endsection
