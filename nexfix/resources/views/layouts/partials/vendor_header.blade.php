<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
     <title>@yield('title', 'Vendor Dashboard')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    {{-- Breeze / Vite Assets (for logout, dropdowns, etc.) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link href="{{asset('img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

      {{-- Admin Template CSS --}}
    <link rel="stylesheet" href="{{ asset('admin-template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/css/style.css') }}">
</head>
