  <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" style="margin-top: 60px">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>NexFix</h3>
                </a>
                
                <div class="navbar-nav w-100">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Vendors</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item fw-bold">Add Vendor</a>
                            <a href="typography.html" class="dropdown-item fw-bold">View Vendor</a>
                            <a href="element.html" class="dropdown-item fw-bold">Edit Vendor</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Service category</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('service-categories.create') }}" class="dropdown-item fw-bold">Add category</a>
                            <a href="{{ route('service-categories.index') }}" class="dropdown-item fw-bold">View category</a>
                            
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>Services</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ route('services.create') }}" class="dropdown-item fw-bold">Add Service</a>
                            <a href="{{ route('services.index') }}" class="dropdown-item fw-bold">View Service</a>
                         
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>Bookings</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item fw-bold">Add Booking</a>
                            <a href="typography.html" class="dropdown-item fw-bold">View Booking</a>
                            <a href="element.html" class="dropdown-item fw-bold">Edit Booking</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-table me-2"></i>Payments</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item fw-bold">Add Payment</a>
                            <a href="typography.html" class="dropdown-item fw-bold">View Payment</a>
                            <a href="element.html" class="dropdown-item fw-bold">Edit Payment</a>
                        </div>
                    </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

