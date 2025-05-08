<x-app-layout>
    @section('title', 'Detail Profil')
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Profil</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail Profil</a></li>
            </ol>
        </div>
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo rounded d-flex align-items-center">
                        <div style="width:100%;">
                            <h1 class="text-center text-white">{{ Auth::user()->name }}</h1>
                            <p class="text-center text-white">{{ Auth::user()->organizer_type }}</p>
                        </div>
                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="{{ url('assets-admin') }}/images/profile/profile.png" class="img-fluid rounded-circle"
                            alt="">
                    </div>
                    <div class="profile-details">
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">{{ Auth::user()->email }}</h4>
                            <p>Email</p>
                        </div>
                        <div class="profile-name px-3 pt-2">
                            @if (Auth::user()->is_verified == 1)
                                <span class="badge badge-lg light badge-primary">Verifikasi</span>
                            @elseif(Auth::user()->is_verified == 2)
                                <span class="badge badge-lg light badge-secondary">Diajukan</span>
                            @elseif(Auth::user()->is_verified == 0)
                                <span class="badge badge-lg light badge-warning">Perlu di lengkapi</span>
                            @elseif(Auth::user()->is_verified == 3)
                                <span class="badge badge-lg light badge-danger">Ditolak</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card h-auto">
            <div class="card-body">
                <div class="my-post-content pt-3">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (Auth::user()->is_verified == 1)
                            @php
                                $disabled = 'disabled';
                            @endphp
                        @elseif(Auth::user()->is_verified == 2)
                            @php
                                $disabled = 'disabled';
                            @endphp
                        @elseif(Auth::user()->is_verified == 3 || Auth::user()->is_verified == 0)
                            @php
                                $disabled = '';
                            @endphp
                            @if (Auth::user()->revition != null)
                                <div class="alert alert-danger">
                                    {{ Auth::user()->revition }}
                                </div>
                            @endif
                        @endif
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <h3>Penting!</h3>
                                <ul style="list-style-position: outside; padding-left: 1.2em; text-align: justify;">
                                    <li style="list-style-type: disc !important;">
                                        Setiap data yang Anda masukkan merupakan tanggung jawab penyelenggara
                                        sepenuhnya. Pastikan data yang diinput adalah <strong>asli, valid, dan dapat
                                            diverifikasi</strong>.
                                    </li>
                                    <li style="list-style-type: disc !important;">
                                        Kami berhak melakukan <strong>verifikasi dokumen</strong> seperti KTP/SIUP
                                        atau
                                        dokumen pendukung lainnya untuk memastikan keabsahan penyelenggara.
                                    </li>
                                    <li style="list-style-type: disc !important;">
                                        Data tidak dapat dirubah jika admin sudah menyatakan <strong>Valid</strong>
                                        pada
                                        data yang anda kirimkan.
                                    </li>
                                    <li style="list-style-type: disc !important;">
                                        Event yang terbukti menggunakan data palsu atau menyesatkan akan
                                        <strong>dibatalkan secara sepihak</strong> dan akun penyelenggara dapat
                                        dibekukan.
                                    </li>
                                    <li style="list-style-type: disc !important;">
                                        Gunakan informasi kontak resmi agar peserta dapat dengan mudah menghubungi
                                        Anda
                                        jika ada pertanyaan atau keluhan.
                                    </li>
                                    <li style="list-style-type: disc !important;">
                                        Patuhi seluruh kebijakan dan ketentuan layanan kami untuk menjaga keamanan
                                        dan
                                        kenyamanan seluruh peserta event.
                                    </li>
                                </ul>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Organizer</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ Auth::user()->name }}" {{ $disabled }}>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ Auth::user()->phone }}" required {{ $disabled }}>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@php
                                        if (Auth::user()->organizer_type == 'Perorangan') {
                                            echo 'NIK';
                                        } else {
                                            echo 'NIB';
                                    } @endphp</label>
                                    <input type="text" class="form-control" name="identity_id"
                                        value="{{ Auth::user()->identity_id }}" required {{ $disabled }}>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@php
                                        if (Auth::user()->organizer_type == 'Perorangan') {
                                            echo 'Upload KTP ';
                                        } else {
                                            echo 'Upload Legalitas CV';
                                    } @endphp</label>
                                    @if (Auth::user()->is_verified == 3 || Auth::user()->is_verified == 0)
                                        <input type="file" class="form-control" name="file_doc" required
                                            accept="application/pdf" {{ $disabled }}>
                                    @else
                                        <br>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('dokumen.download', ['filename' => Auth::user()->file_doc]) }}">Lihat
                                            File</a>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="address" type="text" {{ $disabled }} class="form-control" required>{{ Auth::user()->address }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" {{ $disabled }}>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function() {

            });
        </script>
    @endsection
</x-app-layout>
