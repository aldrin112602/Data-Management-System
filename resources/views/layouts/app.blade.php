<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management System</title>
    @vite('resources/css/app.css')
    @yield('headers')
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                <a href="{{ route('reviews.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Reviews</a>
                <a href="{{ route('events.index') }}" class="block py-2 px-4 hover:bg-gray-700">Manage Events</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                });
            @endif

            @if (session('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: '{{ session('warning') }}',
                });
            @endif

            @if (session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: '{{ session('info') }}',
                });
            @endif
        });
    </script>
</body>
</html>
