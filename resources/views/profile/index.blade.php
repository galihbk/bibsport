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
                            <h1 class="text-center text-white"></h1>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="card h-auto">
            <div class="card-body">
                <div class="my-post-content pt-3">
                    <form action="">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Penting!</h3>
                                <ul style="padding-left: 0px;">
                                    <li style="list-style: inside;">Setiap data yang Anda masukkan merupakan tanggung jawab penyelenggara sepenuhnya. Pastikan data yang diinput adalah <strong>asli, valid, dan dapat diverifikasi</strong>.</li>
                                    <li style="list-style: inside;">Kami berhak melakukan <strong>verifikasi dokumen</strong> seperti KTP, NPWP, SIUP, dan dokumen pendukung lainnya untuk memastikan keabsahan penyelenggara.</li>
                                    <li style="list-style: inside;">Event yang terbukti menggunakan data palsu atau menyesatkan akan <strong>dibatalkan secara sepihak</strong> dan akun penyelenggara dapat dibekukan.</li>
                                    <li style="list-style: inside;">Gunakan informasi kontak resmi agar peserta dapat dengan mudah menghubungi Anda jika ada pertanyaan atau keluhan.</li>
                                    <li style="list-style: inside;">Patuhi seluruh kebijakan dan ketentuan layanan kami untuk menjaga keamanan dan kenyamanan seluruh peserta event.</li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Organizer</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Identitas</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">@php if(Auth::user()->)</label>
                                    <input type="text" class="form-control"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload KTP</label>
                                    <input type="file" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea type="text" class="form-control">{{ Auth::user()->alamat }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="replyModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Post Reply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <textarea class="form-control" rows="4">Message</textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Reply</button>
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