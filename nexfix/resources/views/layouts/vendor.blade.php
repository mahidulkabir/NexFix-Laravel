<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Vendor Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    {{-- Breeze’s navbar (Profile + Logout + etc.) --}}
    @include('layouts.navigation')

    {{-- Your custom user nav --}}
   <nav class="bg-green-100 border-b border-green-200 p-4 flex space-x-4">
    <a href="{{ route('vendor.dashboard') }}" class="text-green-800">Dashboard</a>
   
</nav>

    {{-- Main content --}}
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
