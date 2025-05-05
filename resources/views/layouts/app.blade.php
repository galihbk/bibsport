<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BibSport</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ url('assets') }}/img/favicon.png" rel="icon">
    <link href="{{ url('assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/toastr/css/toastr.min.css">


    <link href="{{ url('assets-admin') }}/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets-admin') }}/vendor/nouislider/nouislider.min.css">
    <link href="{{ url('assets-admin') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ url('assets-admin') }}/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ url('assets-admin') }}/css/style.css" rel="stylesheet">
    <link href="{{ url('assets-admin') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ url('assets-admin') }}/vendor/fontawesome/css/all.min.css" rel="stylesheet" />

</head>

<body>
    <?php $data = Auth::user(); ?>
    <div id="preloader">
        <div class="waviy">
            <span style="--i:1">L</span>
            <span style="--i:2">o</span>
            <span style="--i:3">a</span>
            <span style="--i:4">d</span>
            <span style="--i:5">i</span>
            <span style="--i:6">n</span>
            <span style="--i:7">g</span>
            <span style="--i:8">.</span>
            <span style="--i:9">.</span>
            <span style="--i:10">.</span>
        </div>
    </div>
    <div id="main-wrapper">

        <div class="nav-header">
            <a href="{{ url('dashboard') }}" class="brand-logo">
                <div class="logo-abbr d-flex align-items-center mt-3">
                    <img src="{{ url('assets') }}/img/logo-only-bibsport.png" alt="Logo Only BIBSPORT" width="100%">
                </div>
                <div class="brand-title" width="10px">
                    <img width="100%" src="{{ url('assets') }}/img/text-only-bibsport.png" alt="">
                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                @yield('title')
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
                                <div class="input-group search-area">
                                    <input type="text" class="form-control" placeholder="Search here...">
                                    <span class="input-group-text"><a href="javascript:void(0)"><i
                                                class="flaticon-381-search-2"></i></a></span>
                                </div>
                            </li>
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell dz-theme-mode p-0" href="javascript:void(0);">
                                    <i id="icon-light" class="fas fa-sun"></i>
                                    <i id="icon-dark" class="fas fa-moon"></i>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="btn btn-primary d-sm-inline-block d-none">Generate
                                    Report<i class="las la-signal ms-3 scale5"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <img src="{{ url('assets-admin') }}/images/profile/pic1.jpg" width="20" alt="">
                            <div class="header-info ms-3">
                                <span class="font-w600 ">Hi, <b>{{ explode(' ', $data->name)[0] }}</b></span>
                                <small class="text-end font-w400">{{ $data->email }}</small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ url('profile') }}" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                    width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ms-2">Profile </span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                        width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ms-2">Logout </span>
                                </button>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="fa-solid fa-gauge"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="ai-icon" href="{{ route('event') }}" aria-expanded="false">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="nav-text">Event</span>
                        </a>
                    </li>
                </ul>
                <div class="copyright">
                    <p> © {{ date('Y') }} All Rights Reserved</p>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- row -->
            {{ $slot }}
        </div>
        <div class="footer">

            <div class="copyright">
                <p>Copyright © Developed by <a href="https://galihbagaskoro.my.id/" target="_blank">Galih
                        Bagaskoro</a> 2023</p>
            </div>
        </div>
    </div>
    <script src="{{ url('assets-admin') }}/vendor/global/global.min.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/toastr/js/toastr.min.js"></script>
    <script src="{{ url('assets-admin') }}/js/plugins-init/toastr-init.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/chart-js/chart.bundle.min.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="{{ url('assets-admin') }}/js/plugins-init/jquery.validate-init.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="{{ url('assets-admin') }}/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <!-- Datatable -->
    <script src="{{ url('assets-admin') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets-admin') }}/js/plugins-init/datatables.init.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/apexchart/apexchart.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/nouislider/nouislider.min.js"></script>
    <script src="{{ url('assets-admin') }}/vendor/wnumb/wNumb.js"></script>
    <script src="{{ url('assets-admin') }}/js/dashboard/dashboard-1.js"></script>
    <script src="{{ url('assets-admin') }}/js/custom.min.js"></script>
    <script src="{{ url('assets-admin') }}/js/dlabnav-init.js"></script>
    <script src="{{ url('assets-admin') }}/js/demo.js"></script>
    <script src="{{ url('assets-admin') }}/js/js-kasirone.js"></script>
    @yield('script')

</body>

</html>
