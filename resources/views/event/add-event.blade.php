<x-app-layout>
    @section('title', 'Tambah Event')

    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
        @csrf
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah Event</h4>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="alert alert-info solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <strong>Info!</strong> Form ini hanya untuk detail event. Tambah tiket dan kategori setelah
                        disetujui admin.
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label>Nama Event<span class="required">*</span></label>
                            <input type="text" name="nama_event"
                                class="form-control @error('nama_event') is-invalid @enderror"
                                value="{{ old('nama_event') }}">
                            @error('nama_event')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Jenis Event<span class="required">*</span></label>
                            <select name="jenis_event" class="form-control @error('jenis_event') is-invalid @enderror">
                                <option value="">Pilih...</option>
                                <option value="Lari" {{ old('jenis_event') == 'Lari' ? 'selected' : '' }}>Lari
                                </option>
                                <option value="Sepeda" {{ old('jenis_event') == 'Sepeda' ? 'selected' : '' }}>Sepeda
                                </option>
                            </select>
                            @error('jenis_event')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Lokasi Event<span class="required">*</span></label>
                            <input type="text" name="lokasi_event"
                                class="form-control @error('lokasi_event') is-invalid @enderror"
                                value="{{ old('lokasi_event') }}">
                            @error('lokasi_event')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label>Link Google Maps Event<span class="required">*</span></label>
                            <input type="text" name="maps_event"
                                class="form-control @error('maps_event') is-invalid @enderror"
                                value="{{ old('maps_event') }}">
                            @error('maps_event')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label>Lokasi RPC<span class="required">*</span></label>
                            <input type="text" name="lokasi_rpc"
                                class="form-control @error('lokasi_rpc') is-invalid @enderror"
                                value="{{ old('lokasi_rpc') }}">
                            @error('lokasi_rpc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label>Link Google Maps RPC<span class="required">*</span></label>
                            <input type="text" name="maps_rpc"
                                class="form-control @error('maps_rpc') is-invalid @enderror"
                                value="{{ old('maps_rpc') }}">
                            @error('maps_rpc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Instagram<span class="required">*</span></label>
                            <input type="text" name="instagram"
                                class="form-control @error('instagram') is-invalid @enderror"
                                value="{{ old('instagram') }}">
                            @error('instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Poster<span class="required">*</span></label>
                            <input type="file" name="poster"
                                class="form-control @error('poster') is-invalid @enderror">
                            @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Tanggal Mulai Event<span class="required">*</span></label>
                            <input type="datetime-local" name="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Tanggal Akhir Event<span class="required">*</span></label>
                            <input type="datetime-local" name="tanggal_akhir"
                                class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                value="{{ old('tanggal_akhir') }}">
                            @error('tanggal_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Tanggal Mulai RPC<span class="required">*</span></label>
                            <input type="datetime-local" name="tanggal_mulai_rpc"
                                class="form-control @error('tanggal_mulai_rpc') is-invalid @enderror"
                                value="{{ old('tanggal_mulai_rpc') }}">
                            @error('tanggal_mulai_rpc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Tanggal Akhir RPC<span class="required">*</span></label>
                            <input type="datetime-local" name="tanggal_akhir_rpc"
                                class="form-control @error('tanggal_akhir_rpc') is-invalid @enderror"
                                value="{{ old('tanggal_akhir_rpc') }}">
                            @error('tanggal_akhir_rpc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label>Deskripsi Event<span class="required">*</span></label>
                            <textarea name="deskripsi" id="editor1" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label>Syarat dan Ketentuan Event<span class="required">*</span></label>
                            <textarea name="skb" id="editor2" class="form-control @error('skb') is-invalid @enderror">{{ old('skb') }}</textarea>
                            @error('skb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" id="submitBtn">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @section('script')
        <script>
            CKEDITOR.replace('editor1', {
                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList']
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'undo',
                        items: ['Undo', 'Redo']
                    }
                ],
                removePlugins: 'elementspath',
                resize_enabled: false
            });

            CKEDITOR.replace('editor2', {
                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList']
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'undo',
                        items: ['Undo', 'Redo']
                    }
                ],
                removePlugins: 'elementspath',
                resize_enabled: false
            });
        </script>
    @endsection
</x-app-layout>
