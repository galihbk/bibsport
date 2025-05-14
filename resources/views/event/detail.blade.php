<x-app-layout>
    @section('title', 'Event')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded d-flex align-items-center">
                                <div style="width:100%;">
                                    <h1 class="text-center text-white">{{ $event->event_name }}</h1>
                                    <div class="profile-name justify-content-center d-flex">
                                        @if ($event->event_validation == 1)
                                            <span class="badge badge-lg light badge-primary">Verifikasi</span>
                                        @elseif($event->event_validation == 0)
                                            <span class="badge badge-lg light badge-secondary">Diajukan</span>
                                        @elseif($event->event_validation == 2)
                                            <span class="badge badge-lg light badge-danger">Ditolak</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-muted mb-0">{{ $event->location_event }}</h4>
                                    <p>Lokasi</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ date('d-m-Y', strtotime($event->start_date_event)) }}
                                    </h4>
                                    <p>Tanggal Mulai</p>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown"
                                        aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                        </svg></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li class="dropdown-item"><i class="fa fa-ticket text-primary me-2"></i> <a
                                                type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalCategory">Tambah Kategori</a></li>
                                        <li class="dropdown-item"><i class="fa-solid fa-qrcode text-primary me-2"></i>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#scanModal">Scan
                                                QR</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ticket-list">

        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Peserta</h4>
                <a href="javascript:void(0)" id="refreshData"><i class="fas fa-refresh"></i></a>
            </div>
            <div class="card-body">
                <!-- <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" aria-selected="true" role="tab">Terdaftar</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile" aria-selected="false" role="tab" tabindex="-1">Tidak Terdaftar</a>
                        </li>
                    </ul> -->
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="pt-4">
                            <div class="table-responsive">
                                <table id="peserta-terdaftar" class="display">
                                    <thead>
                                        <tr>
                                            <th>BIB</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Asal</th>
                                            <th>Email</th>
                                            <th>Nomor WA</th>
                                            <th>Kategori Event</th>
                                            <th>Tanggal Terdaftar</th>
                                            <th>Racepack</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="profile" role="tabpanel">
                            <div class="pt-4">
                                <div class="table-responsive">
                                    <table id="peserta-tidak-terdaftar" class="display">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Lengkap</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Asal</th>
                                                <th>Email</th>
                                                <th>Nomor WA</th>
                                                <th>Kategori Event</th>
                                                <th>Tanggal Mendaftar</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-basic">
            <form action="{{ route('event.category-store') }}" method="POST" enctype="multipart/form-data"
                id="eventCategoryForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-2">
                            <input type="hidden" value="{{ $event->id }}" name="event_id">
                            <label>Kategori Event<span class="required">*</span></label>
                            <select name="category_event"
                                class="form-control @error('category_event') is-invalid @enderror">
                                <option value="">Pilih...</option>
                                <option value="Fun Run" {{ old('category_event') == 'Fun Run' ? 'selected' : '' }}>Fun
                                    Run
                                </option>
                                <option value="Trail Run" {{ old('category_event') == 'Trail Run' ? 'selected' : '' }}>
                                    Trail Run
                                </option>
                                <option value="Half Marathon"
                                    {{ old('category_event') == 'Half Marathon' ? 'selected' : '' }}>Half Marathon
                                </option>
                                <option value="Marathon" {{ old('category_event') == 'Marathon' ? 'selected' : '' }}>
                                    Marathon
                                </option>
                                <option value="Ultra Marathon"
                                    {{ old('category_event') == 'Ultra Marathon' ? 'selected' : '' }}>Ultra Marathon
                                </option>
                                <option value="Ultra Trail Run"
                                    {{ old('category_event') == 'Ultra Trail Run' ? 'selected' : '' }}>Ultra Trail Run
                                </option>
                            </select>
                            @error('category_event')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label>Jarak<span class="required">*</span></label>
                            <select name="distance" class="form-control @error('distance') is-invalid @enderror">
                                <option value="">Pilih...</option>
                                <option value="2" {{ old('distance') == 2 ? 'selected' : '' }}>2K
                                </option>
                                <option value="3" {{ old('distance') == 5 ? 'selected' : '' }}>3K
                                </option>
                                <option value="5" {{ old('distance') == 5 ? 'selected' : '' }}>5K
                                </option>
                                <option value="10" {{ old('distance') == 5 ? 'selected' : '' }}>10K
                                </option>
                                <option value="21" {{ old('distance') == 5 ? 'selected' : '' }}>21K
                                </option>
                            </select>
                            @error('distance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Format BIB<span class="required">*</span></label>
                            <input type="text" name="format_bib"
                                class="form-control @error('format_bib') is-invalid @enderror">
                            @error('format_bib')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Poster Kategori<span class="required">*</span></label>
                            <input type="file" name="poster"
                                class="form-control @error('poster') is-invalid @enderror">
                            @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class=" btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modalAddTicket" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-basic">
            <form action="{{ route('event.ticket-store') }}" method="POST" id="addTicketForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleAddTicket"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-2">
                            <input type="hidden" name="event_category_id" id="event_category_id">
                            <label>Nama Tiket<span class="required">*</span></label>
                            <input type="text" name="name_ticket" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Harga Tiket<span class="required">*</span></label>
                            <input type="text" name="price" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Kuota Tiket<span class="required">*</span></label>
                            <input type="number" name="quota" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Mulai di jual<span class="required">*</span></label>
                            <input type="datetime-local" name="ticket_start" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Selesai di jual<span class="required">*</span></label>
                            <input type="datetime-local" name="ticket_end" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class=" btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modalAddVoucher" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-basic">
            <form action="{{ route('event.voucher-store') }}" method="POST" id="addVoucherForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleAddVoucher"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-2">
                            <input type="hidden" name="ticket_id" id="ticket_id">
                            <label>Kode Vocuher<span class="required">*</span></label>
                            <input type="text" name="code"
                                class="form-control @error('code') is-invalid @enderror">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Jenis Vocuher<span class="required">*</span></label>
                            <select name="voucher_type"
                                class="form-control @error('voucher_type') is-invalid @enderror">
                                <option value="">Pilih...</option>
                                <option value="percent">Persen
                                </option>
                                <option value="fixed">Fix
                                </option>
                            </select>
                            @error('voucher_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 d-none" id="fixedAmountGroup">
                            <label>Potongan Harga (Rp)<span class="required">*</span></label>
                            <input type="text" name="fixed_amount"
                                class="form-control @error('fixed_amount') is-invalid @enderror">
                            @error('fixed_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 d-none" id="percentAmountGroup">
                            <label>Diskon (%)<span class="required">*</span></label>
                            <input type="number" name="percent_amount"
                                class="form-control @error('percent_amount') is-invalid @enderror">
                            @error('percent_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Kuota<span class="required">*</span></label>
                            <input type="number" name="quota"
                                class="form-control @error('quota') is-invalid @enderror">
                            @error('quota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Selesai Berlaku Vocuher<span class="required">*</span></label>
                            <input type="datetime-local" name="voucher_end"
                                class="form-control @error('voucher_end') is-invalid @enderror">
                            @error('voucher_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class=" btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-basic">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleAddVoucher">Scan Barcode Menggunakan Kamera</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="reader" style="width: 100%; max-width: 400px; margin: auto;"></div>
                    <div id="scan-result">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
            setTimeout(function() {
                const alertBox = document.getElementById('success-alert');
                if (alertBox) {
                    alertBox.style.transition = 'opacity 0.5s ease';
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500);
                }
            }, 5000);

            let html5QrCode;
            let isProcessing = false;
            var tableTerdaftar

            function startScanner() {
                if (html5QrCode) return;

                html5QrCode = new Html5Qrcode("reader");

                html5QrCode.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: 250
                    },
                    function(decodedText, decodedResult) {
                        if (isProcessing) return;
                        isProcessing = true;

                        html5QrCode.stop().then(() => {
                            $("#scan-result").html("Memproses...");

                            $.ajax({
                                url: "{{ route('event.get-data-scan') }}",
                                method: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    barcode: decodedText
                                },
                                success: function(res) {
                                    if (res.success) {
                                        $("#scan-result").html(res.data);
                                    } else {
                                        $("#scan-result").html(res.data);
                                    }

                                    isProcessing = false;
                                },
                                error: function() {
                                    $("#scan-result").html("Terjadi kesalahan.");
                                    isProcessing = false;
                                }
                            });
                        });
                    },
                    function(errorMessage) {}
                );
            }

            function stopScanner() {
                if (html5QrCode) {
                    html5QrCode.stop().then(() => {
                        html5QrCode.clear();
                        html5QrCode = null;
                        isProcessing = false;
                    });
                }
            }

            function ambilRacepack(order_id) {
                isProcessing = true;
                $("#scan-result").html("Memproses...");
                $.ajax({
                    url: "{{ route('event.change-status-racepack') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        barcode: order_id
                    },
                    success: function(res) {
                        if (res.success) {
                            $("#scan-result").html(res.message);
                            setTimeout(function() {
                                tableTerdaftar.ajax.reload();
                                scanUlang();
                            }, 3000);
                        } else {
                            $("#scan-result").html(res.message);
                            setTimeout(function() {
                                scanUlang();
                            }, 3000);
                        }
                        isProcessing = false;
                    },
                    error: function() {
                        $("#scan-result").html("Terjadi kesalahan.");
                        isProcessing = false;
                    }
                });
            }

            function scanUlang() {
                if (html5QrCode) {
                    html5QrCode.clear();
                    html5QrCode = null;
                    isProcessing = false;
                    $("#scan-result").html("");
                    startScanner();
                } else {
                    $("#scan-result").html("");
                    startScanner();
                }
            }
            $('#scanModal').on('shown.bs.modal', function() {
                startScanner();
            });

            $('#scanModal').on('hidden.bs.modal', function() {
                stopScanner();
            });
            $(document).ready(function() {

                getCategories()

                function getCategories() {
                    var event_id = "{{ $event->id }}";

                    $.ajax({
                        url: "{{ route('event.categories') }}",
                        type: "GET",
                        data: {
                            event_id: event_id
                        },
                        success: function(data) {
                            $('#ticket-list').html(data);
                        }
                    });
                };
                tableTerdaftar = $('#peserta-terdaftar').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('event.get-peserta-terdaftar') }}",
                    columns: [{
                            data: 'bib',
                            name: 'bib'
                        },
                        {
                            data: 'nama_lengkap',
                            name: 'nama_lengkap'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'kabupaten',
                            name: 'kabupaten'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'no_wa',
                            name: 'no_wa'
                        },
                        {
                            data: 'kategori_event',
                            name: 'kategori_event',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'tanggal_terdaftar',
                            name: 'tanggal_terdaftar'
                        },
                        {
                            data: 'status_racepack',
                            name: 'status_racepack',
                            render: function(data, type, row) {
                                if (data == 0) {
                                    return '<span class="badge badge-danger">Belum diambil</span>';
                                } else if (data == 1) {
                                    return '<span class="badge badge-success">Diambil</span>';
                                }
                                return '';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#refreshData').on('click', function() {
                    tableTerdaftar.ajax.reload();
                });
                $('#eventCategoryForm').submit(function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            // Opsional: tampilkan loading atau disable tombol
                        },
                        success: function(res) {
                            $('#modalCategory').modal('hide');
                            $('#eventCategoryForm')[0].reset();
                            getCategories()
                            toastrSuccessBottomRight('Kategori berhasil di tambahkan')
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON?.errors;
                            if (errors) {
                                $('.invalid-feedback').remove();
                                $('.is-invalid').removeClass('is-invalid');
                                for (let key in errors) {
                                    let input = $('[name="' + key + '"]');
                                    input.addClass('is-invalid');
                                    input.after('<div class="invalid-feedback">' + errors[key][0] +
                                        '</div>');
                                }
                            }
                        }
                    });
                });
                $('#ticket-list').on('click', '#btn-add-ticket', function() {
                    $('#event_category_id').val($(this).data('id'))
                    $('#titleAddTicket').text($(this).data('title'))
                    $('#modalAddTicket').modal('show')

                })
                $('#ticket-list').on('click', '#btn-add-voucher', function() {
                    $('#ticket_id').val($(this).data('id'))
                    $('#titleAddVoucher').text($(this).data('title'))
                    $('#modalAddVoucher').modal('show')

                })
                $('#addTicketForm').submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: formData,
                        beforeSend: function() {
                            // Opsional: tampilkan loading atau disable tombol
                        },
                        success: function(res) {
                            $('#modalAddTicket').modal('hide');
                            $('#addTicketForm')[0].reset();
                            getCategories()
                            toastrSuccessBottomRight('Tiket berhasil di tambahkan')
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON?.errors;
                            if (errors) {
                                $('.invalid-feedback').remove();
                                $('.is-invalid').removeClass('is-invalid');
                                for (let key in errors) {
                                    let input = $('[name="' + key + '"]');
                                    input.addClass('is-invalid');
                                    input.after('<div class="invalid-feedback">' + errors[key][0] +
                                        '</div>');
                                }
                            }
                        }
                    });
                })
                $('input[name="price"]').on('keyup', function() {
                    let value = $(this).val().replace(/[^,\d]/g, '').toString();
                    if (value) {
                        $(this).val(formatRupiah(value));
                    } else {
                        $(this).val('');
                    }
                });
                $('input[name="fixed_amount"]').on('keyup', function() {
                    let value = $(this).val().replace(/[^,\d]/g, '').toString();
                    if (value) {
                        $(this).val(formatRupiah(value));
                    } else {
                        $(this).val('');
                    }
                });

                function toggleVoucherFields() {
                    var selected = $('select[name="voucher_type"]').val();
                    $('#fixedAmountGroup').addClass('d-none');
                    $('#percentAmountGroup').addClass('d-none');

                    if (selected === 'fixed') {
                        $('#fixedAmountGroup').removeClass('d-none');
                    } else if (selected === 'percent') {
                        $('#percentAmountGroup').removeClass('d-none');
                    }
                }

                $('select[name="voucher_type"]').on('change', toggleVoucherFields);

                // Trigger saat pertama kali modal dibuka
                $('#modalAddVoucher').on('shown.bs.modal', function() {
                    toggleVoucherFields();
                });
                $('#addVoucherForm').submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: formData,
                        beforeSend: function() {
                            // Opsional: tampilkan loading atau disable tombol
                        },
                        success: function(res) {
                            $('#modalAddVoucher').modal('hide');
                            $('#addVoucherForm')[0].reset();
                            getCategories()
                            toastrSuccessBottomRight('Voucher berhasil di tambahkan')
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON?.errors;
                            if (errors) {
                                $('.invalid-feedback').remove();
                                $('.is-invalid').removeClass('is-invalid');
                                for (let key in errors) {
                                    let input = $('[name="' + key + '"]');
                                    input.addClass('is-invalid');
                                    input.after('<div class="invalid-feedback">' + errors[key][0] +
                                        '</div>');
                                }
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>
