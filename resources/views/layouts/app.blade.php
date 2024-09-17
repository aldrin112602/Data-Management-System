<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management System</title>
    @vite('resources/css/app.css')
    @yield('headers')
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 min-h-screen text-white">
            <nav class="mt-5">
                <a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">Main Dash</a>
                <a href="{{ route('system-data.index') }}" class="block py-2 px-4 hover:bg-gray-700">System Data</a>
                <a href="{{ route('provincial-data.index') }}" class="block py-2 px-4 hover:bg-gray-700">Provincial Data</a>
                <a href="{{ route('municipal-data.index') }}" class="block py-2 px-4 hover:bg-gray-700">Municipal Data</a>
                <a href="{{ route('officials-data.index') }}" class="block py-2 px-4 hover:bg-gray-700">Officials Data</a>
                <a href="{{ route('location-data.index') }}" class="block py-2 px-4 hover:bg-gray-700">Location Data</a>
                <a href="{{ route('location-information.index') }}" class="block py-2 px-4 hover:bg-gray-700">Location Information</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
