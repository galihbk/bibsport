<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BIBSPORT</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="{{ url('assets') }}/img/favicon.png" rel="icon">
    <link href="{{ url('assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="{{ url('assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ url('assets') }}/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ url('assets') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ url('assets') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ url('assets') }}/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ url('assets') }}/img/logo-bibsport-text-right.png" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home') }}" class="active">Beranda<br></a></li>
                    <li class="dropdown"><a href="#"><span>Event</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{route('home.run')}}">Lari</a></li>
                            <li><a href="#">Sepeda</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('home.contact') }}">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Masuk</a>
        </div>
    </header>

    @yield('content')

    <footer id="footer" class="footer light-background">
        <div class="container footer-top">
            <div class="row gy-4 text-center justify-content-center">
                <div class="col-lg-5 col-md-12 footer-about justify-content-center text-center">
                    <a href="{{ route('home') }}" class="logo d-flex align-items-center justify-content-center">
                        <img src="{{ url('assets') }}/img/logo-bibsport-text-right.png" alt="">
                    </a>
                    <div class="social-links d-flex mt-4 justify-content-center">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Galih Bagaskoro</strong> <span>All Rights
                    Reserved</span>
            </p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ url('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets') }}/vendor/php-email-form/validate.js"></script>
    <script src="{{ url('assets') }}/vendor/aos/aos.js"></script>
    <script src="{{ url('assets') }}/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ url('assets') }}/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ url('assets') }}/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ url('assets') }}/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ url('assets') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    @yield('scripts')
    <script src="{{ url('assets') }}/js/main.js"></script>

</body>

</html>