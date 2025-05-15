<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{$event->event_name}}</title>
    <meta name="description" content="{{ \Str::limit(strip_tags($event->description), 200, '...') }}">
    <meta property="og:title" content="{{ $event->event_name }}" />
    <meta property="og:description" content="{{ \Str::limit(strip_tags($event->description), 200, '...') }}" />
    <meta property="og:image" content="{{ asset('storage/posters/' . $event->poster_url) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

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
    <link href="{{ url('assets-admin') }}/vendor/fontawesome/css/all.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="{{ url('assets') }}/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto">
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
    <main class="main">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <img src="{{ asset('storage/posters/' . $event->poster_url) }}" alt="" width="100%">
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Deskripsi</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">SKB</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">{!! $event->description !!}
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">{!! $event->skb !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @foreach($category as $c)
                    <div class="card mb-3">
                        <div class="card-header">Tiket {{$c->category_event}} - {{$c->distance}}K</div>
                        <div class="card-body">
                            <div class="row invoice-card-row">
                                @foreach($c->tickets as $ticket)
                                <a href="{{ route('home.event-register', ['id' => $ticket->id]) }}">
                                    <div class="col-lg-12">
                                        <div class="card bg-warning invoice-card">
                                            <div class="card-body d-flex">
                                                <div>
                                                    <h2 class="text-white invoice-num">{{$ticket->price}}</h2>
                                                    <span class="text-white fs-18">{{$ticket->name_ticket}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="card mb-3">
                        <div class="card-header">Organizer</div>
                        <div class="card-body">
                            @php
                            $photo = $user->image
                            ? asset('storage/profile/' . $user->image)
                            : asset('assets-admin/images/profile/profile.png');
                            @endphp
                            <img src="{{ $photo }}" alt="" width="100%">
                            <div class="d-flex mt-4">
                                <div>
                                    <p><strong>Nama Organizer </strong></p>
                                    <p><strong>Jenis Organizer </strong></p>
                                    <p><strong>Email </strong></p>
                                </div>
                                <div class="ms-2">
                                    <p> : {{$user->name}}</p>
                                    <p> : {{$user->organizer_type}}</p>
                                    <p> : {{$user->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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

    <script src="{{ url('assets') }}/js/main.js"></script>

</body>

</html>