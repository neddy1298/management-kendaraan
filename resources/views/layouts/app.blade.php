<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Best Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
                <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{ asset('images/logokbr.ico') }}">

    <!-- Title -->
    <title>Management Kendaraan</title>


    <!-- *************
   ************ Common Css Files *************
  ************ -->

    <!-- Animated css -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="{{ asset('fonts/bootstrap/bootstrap-icons.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">


    <!-- *************
   ************ Vendor Css Files *************
  ************ -->

    <!-- Scrollbar CSS -->
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

        <!-- *************
                ************ Main container start *************
            ************* -->
        <div class="main-container">

            <!-- Page header starts -->

            <div class="page-header">

                <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>

                <!-- Breadcrumb start -->
                <ol class="breadcrumb d-md-flex d-none">
                    @php
                        $pages = [
                            'Home' => ['route' => 'home', 'icon' => 'bi-house', 'text' => 'Home'],
                            'Kendaraan' => ['route' => 'kendaraan.index', 'icon' => 'bi bi-truck', 'text' => 'Kendaraan'],
                            'Maintenance' => ['route' => null, 'icon' => 'bi bi-gear', 'text' => 'Maintenance'],
                            'User' => ['route' => 'profile.edit', 'icon' => 'bi bi-person-circle', 'text' => 'User']
                        ];
                
                        $pages2 = [
                            'Master' => 'Master Data',
                            'Tambah' => 'Tambah Baru',
                            'Edit' => 'Ubah Data'
                        ];
                
                        $pages3 = [
                            'create' => 'Tambah Baru',
                            'edit' => 'Edit'
                        ];
                    @endphp
                
                    @if(isset($pages[$page]))
                        <li class="breadcrumb-item">
                            <i class="bi {{ $pages[$page]['icon'] }}"></i>
                            @if($pages[$page]['route'])
                                <a href="{{ route($pages[$page]['route']) }}">{{ $pages[$page]['text'] }}</a>
                            @else
                                {{ $pages[$page]['text'] }}
                            @endif
                        </li>
                    @endif
                
                    @if(isset($pages2[$page2]))
                        <li class="breadcrumb-item">
                            {{ $page2 }}
                        </li>
                    @endif
                </ol>
                
                <!-- Breadcrumb end -->
            </div>
            <!-- Page header ends -->

            <!-- Content wrapper scroll start -->
            <div class="content-wrapper-scroll">
                <!-- Content wrapper start -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- Content wrapper end -->

                <!-- App Footer start -->
                <div class="app-footer">
                    <span>© Dinas Perhubungan Kota Bogor 2024. All rights reserved.</span>
                </div>
                <!-- App footer end -->
            </div>
            <!-- Content wrapper scroll end -->
        </div>
        <!-- *************
                ************ Main container end *************
            ************* -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
   ************ Required JavaScript Files *************
  ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>

    <!-- *************
   ************ Vendor Js Files *************
  ************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{ asset('vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    @yield('script')

    <!-- Main Js Required -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
