<nav class="sidebar-wrapper">

    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="index.html" class="logo">
            <img src="{{ asset('images/kotabogor.png') }}" alt="Kota Bogor" />&nbsp;&nbsp;
            <img src="{{ asset('images/dishub.png') }}" alt="Dinas Perhubungan" />
        </a>
    </div>
    <!-- Sidebar brand starts -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul class="font-bold">
                <li class="{{ $page == 'Home' ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="{{ $page == 'Home' ? 'current-page' : '' }}">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="{{ $page == 'Belanja' ? 'active' : '' }}">
                    <a href="{{ route('belanja.index') }}" class="{{ $page == 'Belanja' ? 'current-page' : '' }}">
                        <i class="bi bi-cart2"></i>
                        <span class="menu-text">Data Belanja</span>
                    </a>
                </li>
                <li class="{{ $page == 'Kendaraan' ? 'active' : '' }}">
                    <a href="{{ route('kendaraan.index') }}" class="{{ $page == 'Kendaraan' ? 'current-page' : '' }}">
                        <i class="bi bi-truck"></i>
                        <span class="menu-text">Data Kendaraan</span>
                    </a>
                </li>
                <li class="sidebar-dropdown {{ $page == 'Maintenance' ? 'active' : '' }}">
                    <a href="#">
                        <i class="bi bi-gear"></i>
                        <span class="menu-text">Maintenance</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li class="{{ $page == 'Master' ? 'active' : '' }}">
                                <a href="{{ route('maintenance.index') }}"
                                    class="{{ $page == 'Maintenance' ? 'current-page' : '' }}">
                                    <span class="menu-text">Master Data</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="{{ $page2 == 'Pajak' ? 'current-page' : '' }}">Pajak</a>
                            </li>
                            <li>
                                <a href="" class="{{ $page2 == 'Pelumas' ? 'current-page' : '' }}">Pelumas</a>
                            </li>
                            <li>
                                <a href="" class="{{ $page2 == 'Bensin' ? 'current-page' : '' }}">Bensin</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $page == 'User' ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}" class="{{ $page == 'User' ? 'current-page' : '' }}">
                        <i class="bi bi-person-circle"></i>
                        <span class="menu-text">User</span>
                    </a>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" class="text-red"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
