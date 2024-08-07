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
    <link rel="shortcut icon" href="{{ secure_asset('images/logokbr.ico') }}">

    <!-- Title -->
    <title>@yield('title', 'Management Kendaraan')</title>

    <!-- Common CSS Files -->
    <link rel="stylesheet" href="{{ secure_asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('fonts/bootstrap/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/main.min.css') }}">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

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
                <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list" aria-label="Toggle Sidebar"></i>
                </div>

                <!-- Breadcrumb start -->
                <ol class="breadcrumb d-md-flex d-none">
                    @php
                        $pages = [
                            'Home' => ['route' => 'home', 'icon' => 'bi-house', 'text' => 'Home'],
                            'Laporan' => ['route' => 'laporan.index', 'icon' => 'bi-bar-chart', 'text' => 'Laporan'],
                            'Belanja' => ['route' => 'belanja.index', 'icon' => 'bi-cart2', 'text' => 'Belanja'],
                            'Kendaraan' => ['route' => 'kendaraan.index', 'icon' => 'bi-truck', 'text' => 'Kendaraan'],
                            'Anggaran' => ['route' => null, 'icon' => 'bi-cash-stack', 'text' => 'Anggaran'],
                            'User' => ['route' => 'profile.edit', 'icon' => 'bi-person-circle', 'text' => 'User'],
                        ];

                        $pages2 = [
                            'Pertahun' => ['route' => 'masterAnggaran.index', 'text' => 'Pertahun'],
                            'Group' => ['route' => 'groupAnggaran.index', 'text' => 'Group'],
                            'Tambah' => ['route' => null, 'text' => 'Tambah'],
                            'Edit' => ['route' => null, 'text' => 'Edit'],
                        ];

                        $pages3 = [
                            'Tambah' => 'Tambah Baru',
                            'Edit' => 'Edit',
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
                        <li class="breadcrumb-item">
                            @if ($pages2[$page2]['route'])
                                <a href="{{ route($pages2[$page2]['route']) }}">{{ $pages2[$page2]['text'] }}</a>
                            @else
                                {{ $pages2[$page2]['text'] }}
                            @endif
                        </li>
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
    <script src="{{ secure_asset('js/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('js/modernizr.js') }}"></script>
    <script src="{{ secure_asset('js/moment.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ secure_asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    @yield('script')

    <!-- Main JS Required -->
    <script src="{{ secure_asset('js/main.js') }}"></script>

</body>

</html>
