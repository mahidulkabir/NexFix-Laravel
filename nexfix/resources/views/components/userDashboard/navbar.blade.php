


 <!-- Spinner Start -->
<div id="spinner"
    class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->


<!-- Navbar start -->
<div class="container-fluid fixed-top">

    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            @if(session('success'))
    <div class="alert alert-success text-center mt-3" id="success-alert">
        {{ session('success') }}
    </div>

    <script>
        // Wait 3 seconds (3000 ms), then fade out the alert smoothly
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500); // Remove completely after fade-out
            }
        }, 3000);
    </script>
@endif

            <a href="{{route('portal.index')}}" class="navbar-brand">
                <h1 class="text-primary display-6">NexFix</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto ">
                    <ul class="d-flex justify-content-center align-items-center list-unstyled gap-4" >
                        <li>
                            
                            <a href="/" class="nav-item nav-link active">Home</a>
                        </li>
                        <li>

                            <a href="shop.html" class="nav-item nav-link">All Service</a>
                        </li>
                        <li>

                            <a href="shop-detail.html" class="nav-item nav-link">About US</a>
                        </li>
                        <li>

                            <a href="portal.contact.html" class="nav-item nav-link">Contact</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link p-0 m-0 text-warning" style=" text-decoration: none;">
                                    Logout
                                </button>
                            </form>
                        </li>
                        
                        
                    </ul>
                </div>
                <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4 float-end"><i
               class="fas fa-search text-primary"></i></button>
                
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
