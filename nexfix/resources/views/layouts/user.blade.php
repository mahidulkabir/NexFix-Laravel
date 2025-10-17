<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>User Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- Breeze’s navbar (Profile + Logout + etc.) --}}
    @include('layouts.navigation')

    {{-- Your custom user nav --}}
    <nav class="bg-blue-100 border-b border-blue-200 p-4 flex space-x-4">
        <a href="{{ route('user.dashboard') }}" class="text-blue-800">Dashboard</a>
        {{-- <a href="{{ route('orders.index') }}" class="text-blue-800">My Orders</a>
        <a href="{{ route('user.support') }}" class="text-blue-800">Support</a>
    </nav> --}}

    {{-- Main content --}}
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
