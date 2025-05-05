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
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0">{{ Auth::user()->name }}</h4>
                            <p style="text-transform: capitalize"></p>
                        </div>
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
                <div class="profile-tab">
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation"><a href="#my-data" data-bs-toggle="tab"
                                    class="nav-link active show" aria-selected="true" role="tab">Data Pribadi</a>
                            </li>
                            <li class="nav-item" role="presentation"><a href="#bisnisUsaha" data-bs-toggle="tab"
                                    class="nav-link" aria-selected="false" tabindex="-1" role="tab">Dokumen
                                    Pendukung</a>
                            </li>
                            <li class="nav-item" role="presentation"><a href="#password" data-bs-toggle="tab"
                                    class="nav-link" aria-selected="false" tabindex="-1" role="tab">Password</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="my-data" class="tab-pane fade active show" role="tabpanel">
                                <div class="my-post-content pt-3">
                                    <form action="">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control"
                                                    value="{{ Auth::user()->email }}" disabled>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <select type="text" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="L"
                                                        @php if(Auth::user()->gender == 'L'){echo 'selected';} @endphp>
                                                        Laki-Laki</option>
                                                    <option value="L"
                                                        @php if(Auth::user()->gender == 'P'){echo 'selected';} @endphp>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">No Hp</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->phone }}">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Alamat Lengkap</label>
                                                <textarea type="text" class="form-control">{{ Auth::user()->alamat }}</textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                            <div id="bisnisUsaha" class="tab-pane fade" role="tabpanel">
                                <div class="my-post-content pt-3">
                                    <form action="">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Jenis Dokumen</label>
                                                <select type="text" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="L"
                                                        @php if(Auth::user()->detailUser?->type_doc == 'KTP'){echo 'selected';} @endphp>
                                                        KTP</option>
                                                    <option value="L"
                                                        @php if(Auth::user()->detailUser?->type_doc == 'SIUP'){echo 'selected';} @endphp>
                                                        SIUP</option>
                                                    <option value="L"
                                                        @php if(Auth::user()->detailUser?->type_doc == 'NPWP'){echo 'selected';} @endphp>
                                                        NPWP</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">ID Identitas (NIK/NOMOR SIUP/NOMRO
                                                    NPWP)</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->detailUser?->identity_id }}">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">File</label>
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" name="agreement"
                                                id="agreement" required>
                                            <label class="form-check-label" for="agreement">
                                                Saya menyatakan bahwa data yang saya isi adalah benar dan dapat
                                                dipertanggungjawabkan.
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="password" class="tab-pane fade" role="tabpanel">

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
