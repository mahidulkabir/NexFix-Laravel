<x-portal.layout>
    <div class="container py-5 hero-header mb-5 d-flex align-items-center justify-content-around">
        <h2 class="mb-4">User Dashboard</h2>

        <ul class="navbar-nav d-flex flex-row gap-4 align-items-center">
            <li class="nav-item">
                <!-- <a href="#" class="nav-link">Profile</a> -->

                 <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

            </li>

            <!-- Logout button -->
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link p-0 m-0" style=" text-decoration: none;">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="container-fluid py-5">
        <h2>This is your Dashboard</h2>
    </div>
<!-- limited time offer  -->
     <div class="container-fluid service py-5">
        <div class="container py-5">
             <div class="col-lg-4 text-start my-4">
                        <h1>Limited Time Offer</h1>
                    </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="{{ asset('img/featur-1.webp') }}" class="img-fluid rounded-top w-100" alt="">
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
                           <img src="{{ asset('img/featur-2.webp') }}" class="img-fluid rounded-top w-100" alt="">
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
                            <img src="{{ asset('img/featur-3.webp') }}" class="img-fluid rounded-top w-100" alt="">
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
</x-portal.layout>
