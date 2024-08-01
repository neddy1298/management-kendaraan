<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Website untuk management kendaraan dinas perhubungan kota bogor">
    <meta name="author" content="Dishub KKL" />
    <meta property="og:title" content="Dinas Perhubungan | Management Kendaraan">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Management Kendaraan">
    <link rel="shortcut icon" href="{{ asset('images/logokbr.ico') }}">

    <!-- Title -->
    <title>@yield('title', 'Management Kendaraan')</title>

    <!-- Common CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/bootstrap/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

    @yield('css')
</head>

<body>

    <!-- Loading wrapper start -->
    <div id="loading-wrapper">
        <div class="spinner">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
            <div class="line4"></div>
            <div class="line5"></div>
            <div class="line6"></div>
        </div>
    </div>
    <!-- Loading wrapper end -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Sidebar wrapper start -->
        @include('layouts.sidebar')
        <!-- Sidebar wrapper end -->

        <!-- Main container start -->
        <div class="main-container">

            <!-- Page header starts -->
            <div class="page-header">
                <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list" aria-label="Toggle Sidebar"></i></div>

                <!-- Breadcrumb start -->
                <ol class="breadcrumb d-md-flex d-none">
                    @php
                        $pages = [
                            'Home' => ['route' => 'home', 'icon' => 'bi-house', 'text' => 'Home'],
                            'Belanja' => ['route' => 'belanja.index', 'icon' => 'bi-cart2', 'text' => 'Belanja'],
                            'Kendaraan' => ['route' => 'kendaraan.index', 'icon' => 'bi-truck', 'text' => 'Kendaraan'],
                            'Maintenance' => ['route' => 'maintenance.index', 'icon' => 'bi-gear', 'text' => 'Maintenance'],
                            'Unit Kerja' => ['route' => 'unitKerja.index', 'icon' => 'bi-person-badge', 'text' => 'Unit Kerja'],
                            'Anggaran' => ['route' => null, 'icon' => 'bi-cash-stack', 'text' => 'Anggaran'],
                            'User' => ['route' => 'profile.edit', 'icon' => 'bi-person-circle', 'text' => 'User'],
                        ];

                        $pages2 = [
                            'Pertahun' => 'Pertahun',
                            'Anggota' => 'Anggota',
                            'Tambah' => 'Tambah Baru',
                            'Edit' => 'Ubah Data',
                        ];

                        $pages3 = [
                            'create' => 'Tambah Baru',
                            'edit' => 'Edit',
                        ];
                    @endphp

                    @if (isset($pages[$page]))
                        <li class="breadcrumb-item">
                            <i class="bi {{ $pages[$page]['icon'] }}" aria-hidden="true"></i>
                            @if ($pages[$page]['route'])
                                <a href="{{ route($pages[$page]['route']) }}">{{ $pages[$page]['text'] }}</a>
                            @else
                                {{ $pages[$page]['text'] }}
                            @endif
                        </li>
                    @endif

                    @if (isset($pages2[$page2]))
                        <li class="breadcrumb-item">{{ $pages2[$page2] }}</li>
                    @endif

                    @if (isset($pages3[$page3]))
                        <li class="breadcrumb-item">{{ $pages3[$page3] }}</li>
                    @endif
                </ol>
                <!-- Breadcrumb end -->
            </div>
            <!-- Page header ends -->

            <!-- Content wrapper scroll start -->
            <div class="content-wrapper-scroll">
                <div class="content-wrapper">
                    @yield('content')
                </div>

                <!-- App Footer start -->
                <div class="app-footer">
                    <span>© Dinas Perhubungan Kota Bogor 2024. All rights reserved.</span>
                </div>
                <!-- App footer end -->
            </div>
            <!-- Content wrapper scroll end -->
        </div>
        <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

    <!-- Required JavaScript Files -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    @yield('script')

    <!-- Main JS Required -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
