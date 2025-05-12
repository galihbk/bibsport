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
                                    <h4 class="text-muted mb-0">{{$event->location_event}}</h4>
                                    <p>Lokasi</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{date('d-m-Y', strtotime($event->start_date_event))}}</h4>
                                    <p>Tanggal Mulai</p>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                        </svg></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li class="dropdown-item"><i class="fa fa-ticket text-primary me-2"></i> <a type="button" data-bs-toggle="modal" data-bs-target="#modalCategory">Tambah Kategori</a></li>
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
    </div>
    <div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-basic">
            <form action="{{ route('event.category-store') }}" method="POST" enctype="multipart/form-data" id="eventCategoryForm">
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
                            <input type="hidden" value="{{$event->id}}" name="event_id">
                            <label>Kategori Event<span class="required">*</span></label>
                            <select name="category_event" class="form-control @error('category_event') is-invalid @enderror">
                                <option value="">Pilih...</option>
                                <option value="Fun Run" {{ old('category_event') == 'Fun Run' ? 'selected' : '' }}>Fun Run
                                </option>
                                <option value="Trail Run" {{ old('category_event') == 'Trail Run' ? 'selected' : '' }}>Trail Run
                                </option>
                                <option value="Half Marathon" {{ old('category_event') == 'Half Marathon' ? 'selected' : '' }}>Half Marathon
                                </option>
                                <option value="Marathon" {{ old('category_event') == 'Marathon' ? 'selected' : '' }}>Marathon
                                </option>
                                <option value="Ultra Marathon" {{ old('category_event') == 'Ultra Marathon' ? 'selected' : '' }}>Ultra Marathon
                                </option>
                                <option value="Ultra Trail Run" {{ old('category_event') == 'Ultra Trail Run' ? 'selected' : '' }}>Ultra Trail Run
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
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror">
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Jenis Vocuher<span class="required">*</span></label>
                            <select name="voucher_type" class="form-control @error('voucher_type') is-invalid @enderror">
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
                            <input type="text" name="fixed_amount" class="form-control @error('fixed_amount') is-invalid @enderror">
                            @error('fixed_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2 d-none" id="percentAmountGroup">
                            <label>Diskon (%)<span class="required">*</span></label>
                            <input type="number" name="percent_amount" class="form-control @error('percent_amount') is-invalid @enderror">
                            @error('percent_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Kuota<span class="required">*</span></label>
                            <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror">
                            @error('quota')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Selesai Berlaku Vocuher<span class="required">*</span></label>
                            <input type="datetime-local" name="voucher_end" class="form-control @error('voucher_end') is-invalid @enderror">
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
    @section('script')
    <script>
        setTimeout(function() {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.style.transition = 'opacity 0.5s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 5000);
        $(document).ready(function() {

            getCategories()

            function getCategories() {
                var event_id = "{{$event->id}}";

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
                                input.after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
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
                                input.after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
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
                                input.after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
                            }
                        }
                    }
                });
            });
        });
    </script>
    @endsection
</x-app-layout>