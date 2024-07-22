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
    <link rel="shortcut icon" href="{{ secure_asset('asset('images/logokbr.ico') }}">

    <!-- Title -->
    <title>Management Kendaraan</title>


    <!-- *************
   ************ Common Css Files *************
  ************ -->

    <!-- Animated css -->
    <link rel="stylesheet" href="{{ secure_asset('asset('css/animate.css') }}">

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="{{ secure_asset('asset('fonts/bootstrap/bootstrap-icons.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ secure_asset('asset('css/main.min.css') }}">


</head>

<body class="login-container">

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

    <!-- Login box start -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-box">
            <div class="login-form">
                <a href="" class="login-logo">
                    <img src="{{ secure_asset('asset('images/kotabogor.png') }}" alt="Kota Bogor"/>&nbsp;&nbsp;
                    <img src="{{ secure_asset('asset('images/dishub.png') }}" alt="Dinas Perhubungan" />
                </a>
                <div class="login-welcome">
                    Selamat Datang, <br />Silahkan login menggunakan akun admin.
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" autocomplete="off" name="email">
                    @if ($errors->has('email'))
                        <div class="text-red">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Password</label>
                    </div>
                    <input type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <div class="text-red">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                </div>
                <div class="login-form-actions">
                    <button type="submit" class="btn"> <span class="icon"> <i
                                class="bi bi-arrow-right-circle"></i> </span>
                        Login</button>
                </div>
            </div>
        </div>
    </form>
    <!-- Login box end -->

    <!-- *************
   ************ Required JavaScript Files *************
  ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ secure_asset('asset('js/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ secure_asset('asset('js/modernizr.js') }}"></script>
    <script src="{{ secure_asset('asset('js/moment.js') }}"></script>

    <!-- *************
   ************ Vendor Js Files *************
  ************* -->

    <!-- Main Js Required -->
    <script src="{{ secure_asset('asset('js/main.js') }}"></script>

</body>

</html>
