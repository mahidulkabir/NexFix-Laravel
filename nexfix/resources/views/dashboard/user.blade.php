@extends('components.userDashboard.layout')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f7f9f7;
        font-family: 'Inter', sans-serif;
        color: #1f2937;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 230px;
        background: #ffffff;
        border-right: 1px solid #e5e5e5;
        padding-top: 70px;
        box-shadow: 4px 0 8px rgba(0, 0, 0, 0.03);
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #333;
        font-weight: 500;
        text-decoration: none;
        border-radius: 8px;
        margin: 6px 15px;
        transition: all 0.25s ease;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: #81c408;
        color: #fff;
        transform: translateX(5px);
    }

    .sidebar a i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    /* Main Content */
    .main-content {
        margin-left: 230px;
        padding: 40px 30px;
    }

    /* Welcome box */
    .welcome-box {
        background: #ffffff;
        border-left: 6px solid #81c408;
        border-radius: 12px;
        padding: 25px 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .welcome-box h4 {
        font-weight: 700;
        color: #222;
    }

    .welcome-box p {
        color: #555;
    }

    .btn-primary {
        background-color: #81c408;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #6da106;
    }

    .btn-outline-primary {
        color: #81c408;
        border: 1.5px solid #81c408;
        border-radius: 8px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-outline-primary:hover {
        background-color: #81c408;
        color: #fff;
    }

    /* Stats Cards */
    .stat-card {
        background: #fff;
        border: none;
        border-radius: 14px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
        padding: 25px 10px;
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
    }

    .stat-card h6 {
        color: #777;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .stat-card h3 {
        font-weight: 700;
        color: #333;
    }

    .stat-card:nth-child(1) h3 { color: #81c408; }
    .stat-card:nth-child(2) h3 { color: #5aa404; }
    .stat-card:nth-child(3) h3 { color: #ffb524; }
    .stat-card:nth-child(4) h3 { color: #e63946; }

    /* Cards for bottom section */
    .card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        background-color: #fff;
        transition: all 0.2s ease;
    }

    .card:hover {
        transform: translateY(-3px);
    }

    .card h5 {
        color: #333;
        font-weight: 600;
    }

    ul.list-unstyled li {
        padding: 8px 0;
        border-bottom: 1px dashed #e5e7eb;
    }

    ul.list-unstyled li:last-child {
        border-bottom: none;
    }

    /* Highlight badges */
    .badge.bg-warning {
        background-color: #ffb524 !important;
        color: #212529;
    }
</style>



<!-- Main Content -->
<div class="main-content">
    <div class="container mt-5 pt-4">

        <!-- Welcome Section -->
        <div class="welcome-box mb-4">
            <h4>Hello, {{ Auth::user()->name }} 👋</h4>
            <p class="mb-3">Welcome back to <strong>NexFix</strong> — your trusted home service partner.</p>
            <a href="#" class="btn btn-primary btn-sm me-2"><i class="bi bi-plus-circle me-1"></i> Book a Service</a>
            <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-list-check me-1"></i> View Bookings</a>
        </div>

        <!-- Stats Section -->
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <h6>Total Bookings</h6>
                    <h3>18</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <h6>Completed</h6>
                    <h3>12</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <h6>Pending</h6>
                    <h3>3</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <h6>Cancelled</h6>
                    <h3>2</h3>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="row g-4">
            <!-- Upcoming Booking -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h5 class="fw-bold mb-3">Upcoming Booking</h5>
                    <p class="mb-1"><strong>Service:</strong> AC Repair</p>
                    <p class="mb-1"><strong>Vendor:</strong> CoolTech BD</p>
                    <p class="mb-1"><strong>Date:</strong> Nov 15, 2025 at 11:00 AM</p>
                    <p class="mb-0"><strong>Status:</strong>
                        <span class="badge bg-warning text-dark">Scheduled</span>
                    </p>
                </div>
            </div>

        
        </div>

    </div>
</div>





    <!-- limited time offer  -->
    <div class="container service py-5 mx-auto">
        <div class="container py-5 mx-auto">
            <div class="col-lg-4 text-start my-4">
                <h1>Limited Time Offer</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="{{ asset('img/featur-1.webp') }}" class="img-fluid rounded-top w-100"
                                alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Driving Course</h5>
                                    <h3 class="mb-0">20% OFF</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="{{ asset('img/featur-2.webp') }}" class="img-fluid rounded-top w-100"
                                alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Room Cleaning</h5>
                                    <h3 class="mb-0">15% OFF</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="{{ asset('img/featur-3.webp') }}" class="img-fluid rounded-top w-100"
                                alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Plumbing</h5>
                                    <h3 class="mb-0">Discount 30$</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
