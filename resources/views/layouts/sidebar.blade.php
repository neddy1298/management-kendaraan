<nav class="sidebar-wrapper">

    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ secure_asset('images/kotabogor.png') }}" alt="Kota Bogor" />&nbsp;&nbsp;
            <img src="{{ secure_asset('images/dishub.png') }}" alt="Dinas Perhubungan" />
        </a>
    </div>
    <!-- Sidebar brand ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul class="font-bold">
                <li class="{{ $page == 'Home' ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="{{ $page == 'Home' ? 'current-page' : '' }}" aria-label="Home">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="{{ $page == 'Belanja' ? 'active' : '' }}">
                    <a href="{{ route('belanja.index') }}" class="{{ $page == 'Belanja' ? 'current-page' : '' }}" aria-label="Data Belanja">
                        <i class="bi bi-cart2"></i>
                        <span class="menu-text">Data Belanja</span>
                    </a>
                </li>
                <li class="{{ $page == 'Maintenance' ? 'active' : '' }}">
                    <a href="{{ route('maintenance.index') }}" class="{{ $page == 'Maintenance' ? 'current-page' : '' }}" aria-label="Maintenance">
                        <i class="bi bi-gear"></i>
                        <span class="menu-text">Maintenance</span>
                    </a>
                </li>
                <li class="{{ $page == 'Kendaraan' ? 'active' : '' }}">
                    <a href="{{ route('kendaraan.index') }}" class="{{ $page == 'Kendaraan' ? 'current-page' : '' }}" aria-label="Data Kendaraan">
                        <i class="bi bi-truck"></i>
                        <span class="menu-text">Data Kendaraan</span>
                    </a>
                </li>
                <li class="{{ $page == 'User' ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}" class="{{ $page == 'User' ? 'current-page' : '' }}" aria-label="User">
                        <i class="bi bi-person-circle"></i>
                        <span class="menu-text">User</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" class="text-red" aria-label="Keluar" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-left text-red"></i>
                            <span class="menu-text">Keluar</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <!-- Sidebar menu ends -->

</nav>
