 <div class="container-fluid fixed-top py-5  mb-5 d-flex align-items-center justify-content-around">
       <a href="{{route('portal.index')}}" class="navbar-brand">
                <h1 class="text-primary display-6">NexFix</h1>
            </a>

        <ul class="navbar-nav d-flex flex-row gap-4 align-items-center">
            <li class="nav-item">
                <a href="">My Bookings</a>

            </li>
            <li class="nav-item">
               <a href=""> My Payments</a>

            </li>
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