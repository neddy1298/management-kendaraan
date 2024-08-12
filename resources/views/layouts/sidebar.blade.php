<nav class="sidebar-wrapper bg-secondary">

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
            <ul class="font-bold text-white">
                <li class="{{ $page == 'Home' ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="{{ $page == 'Home' ? 'current-page' : 'text-white' }}"
                        aria-label="Home">
                        <i class="bi bi-house "></i>
                        <span class="menu-text">Home</span>
                    </a>
                </li>
                {{-- TODO --}}
                <li class="{{ $page == 'Laporan' ? 'active' : '' }}">
                    <a href="{{ route('laporan.index') }}"
                        class="{{ $page == 'Laporan' ? 'current-page' : 'text-white' }}" aria-label="Laporan">
                        <i class="bi bi-bar-chart"></i>
                        <span class="menu-text">Laporan</span>
                    </a>
                </li>
                <li class="{{ $page == 'Belanja' ? 'active' : '' }}">
                    <a href="{{ route('belanja.index') }}"
                        class="{{ $page == 'Belanja' ? 'current-page' : 'text-white' }}" aria-label="Data Belanja">
                        <i class="bi bi-cart2"></i>
                        <span class="menu-text">Data Belanja</span>
                    </a>
                </li>
                <li class="{{ $page == 'Kendaraan' ? 'active' : '' }}">
                    <a href="{{ route('kendaraan.index') }}"
                        class="{{ $page == 'Kendaraan' ? 'current-page' : 'text-white' }}" aria-label="Data Kendaraan">
                        <i class="bi bi-truck"></i>
                        <span class="menu-text">Kendaraan</span>
                    </a>
                </li>
                <li class="{{ $page == 'Suku Cadang' ? 'active' : '' }}">
                    <a href="{{ route('sukuCadang.index') }}"
                        class="{{ $page == 'Suku Cadang' ? 'current-page' : 'text-white' }}"
                        aria-label="Data Suku Cadang">
                        <i class="bi bi-gear"></i>
                        <span class="menu-text">Suku Cadang</span>
                    </a>
                </li>
                <li class="sidebar-dropdown {{ $page == 'Anggaran' ? 'active' : '' }}">
                    <a href="#" class="text-white">
                        <i class="bi bi-pie-chart"></i>
                        <span class="menu-text">Anggaran</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('paguAnggaran.index') }}"
                                    class="{{ $page2 == 'Pagu' ? 'current-page' : 'text-white' }}">Pagu</a>
                            </li>
                            <li>
                                <a href="{{ route('masterAnggaran.index') }}"
                                    class="{{ $page2 == 'Pertahun' ? 'current-page' : 'text-white' }}">Pertahun</a>
                            </li>
                            <li>
                                <a href="{{ route('groupAnggaran.index') }}"
                                    class="{{ $page2 == 'Group' ? 'current-page' : 'text-white' }}">Group</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="{{ $page == 'User' ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}"
                        class="{{ $page == 'User' ? 'current-page' : 'text-white' }}" aria-label="User">
                        <i class="bi bi-person-circle"></i>
                        <span class="menu-text">User</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" class="text-red" aria-label="Keluar"
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
