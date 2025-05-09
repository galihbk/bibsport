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
    <!-- Banner -->
    <section id="banner">
        <div class="content">
            <h1>BIBSPORT</h1>
            <p>
                Mudah Atur Event, Fokus pada Lomba
            </p>
            <ul class="actions">
                <li><a href="{{route('login')}}" class="button scrolly">Buat Event</a></li>
            </ul>
        </div>
    </section>
    <section id="one" class="wrapper">
        <div class="inner flex flex-3">
            <div class="flex-item left">
                <div>
                    <h3>Manajemen Event Mudah</h3>
                    <p>
                        Buat dan atur event olahraga hanya dalam hitungan menit. Kelola informasi dasar seperti nama event, tanggal, lokasi, dan deskripsi secara fleksibel.
                    </p>
                </div>
                <div>
                    <h3>Kategori Peserta Fleksibel</h3>
                    <p>
                        Tambahkan kategori peserta seperti Umum, Pelajar, atau Profesional dengan mudah. Dukung berbagai jenis lomba dalam satu event.
                    </p>
                </div>
            </div>
            <div class="flex-item image fit round">
                <img src="{{url('assets')}}/img/undraw_timeline_2gfy.png" alt="" width="330" />
            </div>
            <div class="flex-item right">
                <div>
                    <h3>Pembayaran Otomatis & Instan</h3>
                    <p>
                        Bibsport mendukung integrasi dengan payment gateway untuk transaksi cepat dan aman.
                    </p>
                </div>
                <div>
                    <h3>Manajemen Peserta</h3>
                    <p>
                        Kelola data peserta dengan mudah. Tandai kehadiran, lakukan verifikasi, cetak nomor dada, dan kelola pengelompokan peserta.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Two -->
    <section id="two" class="wrapper style1 special">
        <div class="inner">
            <h2>Feugiat lorem</h2>
            <figure>
                <blockquote>
                    "Morbi in sem quis dui placerat ornare. Pellentesque odio nisi,
                    euismod in, pharetra<br />
                    magna etiam lorem ultricies in diam. Sed arcu cras consequat."
                </blockquote>
                <footer>
                    <cite class="author">Jane Anderson</cite>
                    <cite class="company">CEO, Untitled</cite>
                </footer>
            </figure>
        </div>
    </section>
    <!-- Three -->
    <section id="three" class="wrapper">
        <div class="inner flex flex-3">
            <div class="flex-item box">
                <div class="image fit">
                    <img src="images/pic02.jpg" alt="" width="418" height="200" />
                </div>
                <div class="content">
                    <h3>Consequat</h3>
                    <p>
                        Placerat ornare. Pellentesque od sed euismod in, pharetra ltricies
                        edarcu cas consequat.
                    </p>
                </div>
            </div>
            <div class="flex-item box">
                <div class="image fit">
                    <img src="images/pic03.jpg" alt="" width="418" height="200" />
                </div>
                <div class="content">
                    <h3>Adipiscing</h3>
                    <p>
                        Morbi in sem quis dui placerat Pellentesque odio nisi, euismod
                        pharetra lorem ipsum.
                    </p>
                </div>
            </div>
            <div class="flex-item box">
                <div class="image fit">
                    <img src="images/pic04.jpg" alt="" width="418" height="200" />
                </div>
                <div class="content">
                    <h3>Malesuada</h3>
                    <p>
                        Nam dui mi, tincidunt quis, accu an porttitor, facilisis luctus
                        que metus vulputate sem magna.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <h2>Get In Touch</h2>
            <ul class="actions">
                <li>
                    <span class="icon fa-phone"></span> <a href="#">(000) 000-0000</a>
                </li>
                <li>
                    <span class="icon fa-envelope"></span>
                    <a href="#">admin@bibsport.id</a>
                </li>
                <li>
                    <span class="icon fa-map-marker"></span> <a href="https://maps.app.goo.gl/7WNx3aWHQUXTXp71A">RT.4/RW.5, Karangsalam, Penyarang, Kec. Sidareja, Kabupaten Cilacap, Jawa Tengah 53261</a>
                </li>
            </ul>
        </div>
    </footer>
    <div class="copyright">
        Copyright 2023. All rights reserved.
    </div>

    <!-- Scripts -->
    <script src="{{ url('assets') }}/js/jquery.min.js"></script>
    <script src="{{ url('assets') }}/js/jquery.scrolly.min.js"></script>
    <script src="{{ url('assets') }}/js/skel.min.js"></script>
    <script src="{{ url('assets') }}/js/util.js"></script>
    <script src="{{ url('assets') }}/js/main.js"></script>
</body>

</html>