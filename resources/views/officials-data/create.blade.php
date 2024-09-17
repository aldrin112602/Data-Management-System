@extends('layouts.app')

@section('title', 'Add Official')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Official</h1>

    <form action="{{ route('officials-data.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                required>
        </div>

        <div class="mb-4">
            <label for="position" class="block text-gray-700">Position</label>
            <input type="text" name="position" id="position"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="province_id" class="block text-gray-700">Province</label>
            <select name="province_id" id="province_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                required>
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="municipality_id" class="block text-gray-700">Municipality</label>
            <select name="municipality_id" id="municipality_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Select Municipality</option>
                <!-- Dynamically populated -->
            </select>
        </div>


        <div class="mb-4">
            <label for="official_image" class="block text-gray-700">Official Image</label>
            <input type="file" name="official_image" id="official_image"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Save</button>
            <a href="{{ route('officials-data.index') }}"
                class="ml-4 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Back</a>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
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
        });
    </script>

@endsection
