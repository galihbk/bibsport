@extends('layouts.home')

@section('title', 'Beranda')

@section('content')
    <main class="main">

        <section id="contact" class="contact section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                    <iframe style="border:0; width: 100%; height: 270px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.21762713747!2d108.82567747574578!3d-7.441156673321363!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e657f1c746e245b%3A0x662a85613073bf0!2sGalih%20JP!5e0!3m2!1sid!2sid!4v1746793451718!5m2!1sid!2sid"
                        frameborder="0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Alamat</h3>
                                <p>Desa Penyarang RT 4 RW 5 Sidareja Cilacap</p>
                            </div>
                        </div>

                        {{-- <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                            </div>
                        </div> --}}

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email</h3>
                                <p>admin@bibsport.id</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <form action="{{ route('home.send') }}" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            @csrf

                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama lengkap"
                                        required="">
                                </div>
                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Masukan email"
                                        required="">
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Judul"
                                        required="">
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required=""></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Pesan berhasil di kirim. Terima kasih!</div>
                                    <button type="submit">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
