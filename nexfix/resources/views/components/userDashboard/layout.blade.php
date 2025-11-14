<x-portal.header />

<body>
    <x-userDashboard.navbar />
<style>
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

</style>
    <!-- Sidebar -->
    <div class="sidebar" style="padding-top: 100px">


        @php
            if (Auth::check()) {
                $role = Auth::user()->role; // assuming 'role' column exists
                $dashboardUrl = url("$role/dashboard");
            } else {
                $dashboardUrl = route('login');
            }
        @endphp

        <a href="{{ $dashboardUrl }}" class="active">
            <i class="bi bi-speedometer2"></i> Dashboard</i>
        </a>


        <a href="{{ route('user.myBooking') }}"><i class="bi bi-calendar-check"></i> My Bookings</a>
        <a href="#"><i class="bi bi-wallet2"></i> Payments</a>
        <a href="#"><i class="bi bi-chat-dots"></i> Messages</a>
        <a href="{{ route('profile.edit') }}"><i class="bi bi-person-circle"></i> Profile</a>


    </div>

    <main>
        {{-- {{ $slot }} --}}
        @yield('content')
    </main>

    <x-portal.footer />

</body>

</html>
