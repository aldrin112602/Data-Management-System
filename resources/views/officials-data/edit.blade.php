@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Official Data</h1>

    <form action="{{ route('officials-data.update', $official->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $official->name) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="position" class="block text-gray-700">Position</label>
            <input type="text" name="position" id="position" value="{{ old('position', $official->position) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="province_id" class="block text-gray-700">Province</label>
            <select name="province_id" id="province_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                required>
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}" {{ $official->province_id == $province->id ? 'selected' : '' }}>
                        {{ $province->province_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="municipality_id" class="block text-gray-700">Municipality</label>
            <select name="municipality_id" id="municipality_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <!-- This will be populated dynamically by JavaScript -->
                <option value="">Select Municipality</option>
                @foreach ($municipalities as $municipality)
                    <option value="{{ $municipality->id }}"
                        {{ $official->municipality_id == $municipality->id ? 'selected' : '' }}>
                        {{ $municipality->municipal_name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-4">
            <label for="official_image" class="block text-gray-700">Official Image</label>
            <input type="file" name="official_image" id="official_image"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @if ($official->official_image)
                <img src="{{ asset('storage/' . $official->official_image) }}" alt="Official Image" class="mt-2"
                    style="max-width: 150px;">
            @endif
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $official->description) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Update</button>
            <a href="{{ route('officials-data.index') }}"
                class="ml-4 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Function to load municipalities based on selected province
            function loadMunicipalities(provinceID, selectedMunicipality = null) {
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
                                $('#municipality_id').append('<option value="' + value.id +
                                    '"' + (value.id == selectedMunicipality ? ' selected' :
                                        '') + '>' + value.municipal_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#municipality_id').empty();
                    $('#municipality_id').append('<option value="">Select Municipality</option>');
                }
            }

            // Load municipalities when the province is changed
            $('#province_id').on('change', function() {
                var provinceID = $(this).val();
                loadMunicipalities(provinceID);
            });

            // Load municipalities when the page loads based on the currently selected province and municipality
            var selectedProvinceID = $('#province_id').val();
            var selectedMunicipalityID = "{{ $official->municipality_id }}";
            loadMunicipalities(selectedProvinceID, selectedMunicipalityID);
        });
    </script>
@endsection
