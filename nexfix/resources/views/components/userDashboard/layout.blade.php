<x-portal.header />

<body>
    <x-userDashboard.navbar />

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
        {{ $slot }}
    </main>

    <x-portal.footer />

</body>

</html>
