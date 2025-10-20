<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm" style="margin-left:250px; position:fixed; top:0; width:calc(100% - 250px); z-index:100;">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
