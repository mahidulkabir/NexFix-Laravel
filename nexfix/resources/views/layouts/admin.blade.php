<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard')</title>

    {{-- Breeze / Vite Assets (for logout, dropdowns, etc.) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Admin Template CSS --}}
    <link rel="stylesheet" href="{{ asset('admin-template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/style.css') }}">
</head>
<body class="font-sans antialiased bg-gray-100">

    {{-- Breeze Navigation (Profile + Logout) --}}
    @include('layouts.navigation')

    {{-- Admin Panel Navbar --}}
    @include('layouts.partials.admin_navbar')

    {{-- Admin Sidebar --}}
    @include('layouts.partials.admin_sidebar')

    {{-- Main Content Area --}}
    <main class="p-4" style="margin-left:250px; margin-top:70px;">
        @yield('content')
    </main>

    {{-- Admin Template JS --}}
    <script src="{{ asset('admin-template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-template/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-template/js/main.js') }}"></script>

    {{-- Page Specific JS --}}
    @stack('scripts')
</body>
</html>
