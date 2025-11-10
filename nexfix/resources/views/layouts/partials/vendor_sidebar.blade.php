<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3" style="margin-top: 60px">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>NexFix</h3>
        </a>

        <div class="navbar-nav w-100">
            <!-- Dashboard -->
            <a href="{{ route('vendor.dashboard') }}" class="nav-item nav-link">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <!-- My Profile -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-user me-2"></i>My Profile
                </a>
                <div class="dropdown-menu bg-light ps-3" style="margin-left: 10px; border-radius: 6px; border: none;">
                    <a href="{{ route('vendors.create') }}" class="dropdown-item fw-bold">
                        Add Vendor
                    </a>
                    <a href="{{ route('vendors.index') }}" class="dropdown-item fw-bold">
                        View Vendor
                    </a>
                </div>
            </div>

            <!-- My Services -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-concierge-bell me-2"></i>My Services
                </a>
                <div class="dropdown-menu bg-light ps-3" style="margin-left: 10px; border-radius: 6px; border: none;">
                    <a href="{{ route('services.create') }}" class="dropdown-item fw-bold">
                        Add Service
                    </a>
                    <a href="{{ route('services.index') }}" class="dropdown-item fw-bold">
                        View Services
                    </a>
                </div>
            </div>

            <!-- My Bookings -->
            <div class="nav-item dropdown">
                <a href="{{ route('vendor.my.orders') }}" class="nav-link">
                    <i class="fa fa-calendar-check me-2"></i>My Orders
                </a>
                
            </div>

            <!-- My Payments -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-credit-card me-2"></i>My Payments
                </a>
                <div class="dropdown-menu bg-light ps-3" style="margin-left: 10px; border-radius: 6px; border: none;">
                    <a href="{{ route('payments.create') }}" class="dropdown-item fw-bold">
                        Add Payment
                    </a>
                    <a href="{{ route('payments.index') }}" class="dropdown-item fw-bold">
                        View Payments
                    </a>
                </div>
            </div>
            <!-- Live Orders-->
            <div class="nav-item dropdown">
                <a href="{{route('vendor.collect.orders')}}" class="nav-link " >
                    <i class="fa fa-credit-card me-2"></i>Collect Orders
                </a>
                
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
