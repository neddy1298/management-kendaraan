<nav class="sidebar-wrapper">

    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="index.html" class="logo">
            <img src="{{ asset('images/logo.svg') }}" alt="Admin Dashboards" />
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
                <li class="{{ $page == 'Permohonan' ? 'active' : '' }}">
                    <a href="{{ route('permohonan.index') }}"
                        class="{{ $page == 'Permohonan' ? 'current-page' : '' }}">
                        <i class="bi bi-file-earmark"></i>
                        <span class="menu-text">Permohonan KTP</span>
                    </a>
                </li>
                {{-- <li class="{{ $page == 'Laporan' ? 'active' : '' }}">
                    <a href="#" class="{{ $page == 'Laporan' ? 'current-page' : '' }}">
                        <i class="bi bi-clipboard"></i>
                        <span class="menu-text">Laporan</span>
                    </a>
                </li> --}}
                <li class="sidebar-dropdown {{ $page == 'Master Data' ? 'active' : '' }}">
                    <a href="#">
                        <i class="bi bi-list"></i>
                        <span class="menu-text">Master Data</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('kepala_keluarga.index') }}" class="{{ $page2 == 'Kepala Keluarga' ? 'current-page' : '' }}">Kepala Keluarga</a>
                            </li>
                            <li>
                                <a href="{{ route('penduduk.index') }}" class="{{ $page2 == 'Penduduk' ? 'current-page' : '' }}">Penduduk</a>
                            </li>
                            <li>
                                <a href="{{ route('desa.index') }}" class="{{ $page2 == 'Desa' ? 'current-page' : '' }}">Desa</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $page == 'Pengguna' ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}" class="{{ $page == 'Pengguna' ? 'current-page' : '' }}">
                        <i class="bi bi-person-circle"></i>
                        <span class="menu-text">Pengguna</span>
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
