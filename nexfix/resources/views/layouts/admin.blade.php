<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- Breeze’s navbar (Profile + Logout + etc.) --}}
    @include('layouts.navigation')

    {{-- Your custom user nav --}}
    <nav class="bg-gray-800 text-white p-4 flex space-x-4">
    <a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a>
    {{-- <a href="{{ route('admin.users') }}" class="text-white">Manage Users</a>
    <a href="{{ route('admin.vendors') }}" class="text-white">Manage Vendors</a> --}}
</nav>

    {{-- Main content --}}
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
