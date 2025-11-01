<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@vite('resources/css/app.css') {{-- ensures Tailwind loads after Bootstrap --}}

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .dashboard-container {
            flex: 1;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 1rem;
            border-right: 1px solid #dee2e6;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #007bff;
            color: white;
        }
        .content {
            flex: 1;
            padding: 2rem;
        }
    </style>
</head>

<body>

    {{-- Top Navbar (optional) --}}
    @include('layouts.navigation')

    <div class="dashboard-container">
        
        {{-- Sidebar --}}
        <div class="sidebar">
            <h5 class="mb-3">Vendor Panel</h5>
            <a href="{{ route('vendor.dashboard') }}" class="{{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('vendor.bookings') }}" class="{{ request()->routeIs('vendor.bookings') ? 'active' : '' }}">My Bookings</a>
            
        </div>

        {{-- Main Content Area --}}
        <div class="content">
            @yield('content')
        </div>

    </div>

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        &copy; {{ date('Y') }} NexFix. All Rights Reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>
