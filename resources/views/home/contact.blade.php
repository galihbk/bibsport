<!DOCTYPE html>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>

<head>
    <title>BIBSPORT</title>
    <meta charset="utf-8" />
    <meta
        name="robots"
        content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ url('assets') }}/img/favicon.png" rel="icon">
    <link href="{{ url('assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ url('assets') }}/css/main.css" />
</head>

<body>
    <!-- Header -->
    <header id="header">
        <nav class="left">
            <a href="#menu"><span>Menu</span></a>
        </nav>
        <a href="{{route('home')}}" class="logo" style="height: 100%; display:flex; justify-content:center; align-items: center;"><img width="15%" src="{{ url('assets') }}/img/logo-bibsport-text-right.png" alt="Logo BIBSPORT"></a>
        <nav class="right"><a href="{{route('login')}}" class="button alt">masuk</a></nav>
    </header>
    <!-- Menu -->
    <nav id="menu">
        <ul class="links">
            <li><a href="{{route('home')}}">Beranda</a></li>
            <li><a href="{{route('home.event-list')}}">Event</a></li>
            <li><a href="{{route('home.contact')}}">Kontak</a></li>
        </ul>
        <ul class="actions vertical">
            <li><a href="#" class="button fit">Masuk</a></li>
        </ul>
    </nav>

    <div class="copyright">
        Copyright 2023. All rights reserved.
    </div>

    <script src="{{ url('assets') }}/js/jquery.min.js"></script>
    <script src="{{ url('assets') }}/js/jquery.scrolly.min.js"></script>
    <script src="{{ url('assets') }}/js/skel.min.js"></script>
    <script src="{{ url('assets') }}/js/util.js"></script>
    <script src="{{ url('assets') }}/js/main.js"></script>
</body>

</html>