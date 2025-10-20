@include('layouts.partials.admin_header')


<body class="font-sans antialiased bg-gray-100 ">

    {{-- Breeze Navigation (Profile + Logout) --}}
    @include('layouts.navigation')

 
    

    {{-- Admin Sidebar --}}
    @include('layouts.partials.admin_sidebar')

    {{-- Main Content Area --}}
    <main class="p-4" style="margin-left:250px; margin-top:70px;">
        @yield('content')


     {{-- footer     --}}
     @include('layouts.partials.admin_footer')
    </main>



{{-- js admin files  --}}
@include('layouts.partials.admin_js')
    
</body>
</html>
