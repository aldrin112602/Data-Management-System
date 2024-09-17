@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Main Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">System Data</h2>
            <p>Overview of system data goes here.</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Provincial Data</h2>
            <p>Overview of provincial data goes here.</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Municipal Data</h2>
            <p>Overview of municipal data goes here.</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Officials Data</h2>
            <p>Overview of officials data goes here.</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Location Data</h2>
            <p>Overview of location data goes here.</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Location Information</h2>
            <p>Overview of location information goes here.</p>
        </div>
    </div>
@endsection
