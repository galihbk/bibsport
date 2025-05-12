@extends('layouts.home')

@section('title', 'Event Lari')

@section('content')
<main class="main">
    <div class="container py-3">
        <h5 class="text-center">Form Registrasi</h5>
        <form method="POST" action="">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" class="form-control" readonly>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" placeholder="Nama lengkap" class="form-control" required>
                                    @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Nama Panggilan</label>
                                    <input type="text" name="nama_panggilan" placeholder="Nama panggilan" class="form-control" required>
                                    @error('nama_panggilan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">--pilih--</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                    @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Golongan Darah</label>
                                    <select name="gol_darah" class="form-control">
                                        <option value="">--pilih--</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                    @error('gol_darah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Ukuran Jersey</label>
                                    <select name="ukuran_jersey" class="form-control" required>
                                        <option value="">--pilih--</option>
                                        @foreach (['XS','S','M','L','XL','XXL','XXXL','XXXXL','XXXXXL'] as $ukuran)
                                        <option value="{{ $ukuran }}">{{ $ukuran }}</option>
                                        @endforeach
                                    </select>
                                    @error('ukuran_jersey')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Jenis Identitas</label>
                                    <select name="jenis_identitas" class="form-control" required>
                                        <option value="">--pilih--</option>
                                        <option value="KTP">KTP</option>
                                        <option value="SIM">SIM</option>
                                        <option value="PASPORT">PASPORT</option>
                                        <option value="KARTU PELAJAR">Kartu Pelajar</option>
                                    </select>
                                    @error('jenis_identitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Nomor Identitas</label>
                                    <input name="nomor_identitas" class="form-control" type="text" required>
                                    @error('nomor_identitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Provinsi</label>
                                    <select name="provinsi" id="provinsi" class="form-control" required>
                                        <option value="">--pilih--</option>
                                    </select>
                                    @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" id="provinsi-nama" class="form-control mt-2" readonly>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Kabupaten/kota</label>
                                    <select name="kabupaten" id="kabupaten" class="form-control" required>
                                        <option value="">--pilih--</option>
                                    </select>
                                    @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" id="kabupaten-nama" class="form-control mt-2" readonly>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="col-form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" required></textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Email Aktif</label>
                                    <input type="email" name="email" class="form-control" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Nomor WA</label>
                                    <input type="tel" name="no_wa" class="form-control" required>
                                    @error('no_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Nama Kontak Darurat</label>
                                    <input type="text" name="nama_kontak_darurat" class="form-control" required>
                                    @error('nama_kontak_darurat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Nomor Kontak Darurat</label>
                                    <input type="tel" name="no_kontak_darurat" class="form-control" required>
                                    @error('no_kontak_darurat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="col-form-label">Hubungan Kontak Darurat</label>
                                    <input type="text" name="hubungan_kontak" class="form-control" required>
                                    @error('hubungan_kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="col-form-label">Voucher</label>
                                    <div class="d-flex">
                                        <input type="text" name="voucher" class="form-control me-2" id="voucherCode">
                                        <button type="button" data-idticket="" class="btn btn-primary" onclick="cekVoucher('{{$ticket->id}}')">Cek Voucher</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RINGKASAN --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="py-2"><strong>Sub Total</strong></h6>
                                    <h6 class="py-2"><strong>Biaya Admin</strong></h6>
                                    <h6 class="py-2"><strong>Voucher Diskon</strong></h6>
                                </div>
                                <div class="text-end">
                                    <h6 class="py-2">Rp. {{ number_format($ticket->price, 0, ',', '.') }}</h6>
                                    <h6 class="py-2">Rp. 0</h6>
                                    <h6 class="py-2" id="vouchertext">0</h6>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h6 class="py-2"><strong>Total</strong></h6>
                                <h6 class="py-2" id="totalHarga">Rp. {{ number_format($ticket->price, 0, ',', '.') }}</h6>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Load Provinsi
    $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', function(data) {
        $.each(data, function(i, provinsi) {
            $('#provinsi').append(`<option value="${provinsi.id}">${provinsi.name}</option>`);
        });
    });

    // Load Kabupaten saat provinsi dipilih
    $('#provinsi').on('change', function() {
        var provinsiId = $(this).val(); // ID Provinsi
        var provinsiName = $("#provinsi option:selected").text(); // Nama Provinsi
        $('#kabupaten').html('<option value="">--pilih--</option>'); // reset kabupaten
        $('#provinsi-nama').val(provinsiName); // Menampilkan nama provinsi di input text

        if (provinsiId) {
            $.getJSON(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`, function(data) {
                $.each(data, function(i, kabupaten) {
                    $('#kabupaten').append(`<option value="${kabupaten.id}">${kabupaten.name}</option>`);
                });
            });
        }
    });

    // Load Nama Kabupaten saat kabupaten dipilih
    $('#kabupaten').on('change', function() {
        var kabupatenId = $(this).val(); // ID Kabupaten
        var kabupatenName = $("#kabupaten option:selected").text(); // Nama Kabupaten
        $('#kabupaten-nama').val(kabupatenName); // Menampilkan nama kabupaten di input text
    });

    let hargaAwal = "{{ $ticket->price}}";
    let voucherIsChecked = false;
    let voucherValid = false;

    function cekVoucher(id) {
        let kode = $('#voucherCode').val().trim();
        voucherIsChecked = true;

        if (kode === '') {
            $('#vouchertext').text('0');
            $('#totalHarga').text('Rp. ' + hargaAwal.toLocaleString('id-ID'));
            voucherValid = true;
            return;
        }

        $.ajax({
            url: '{{ url("/cek-voucher") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                kode: kode,
                id: id
            },
            success: function(res) {
                if (res.status) {
                    let diskon = 0;
                    if (res.tipe === 'percent') {
                        diskon = (hargaAwal * res.diskon / 100);
                    } else if (res.tipe === 'fixed') {
                        diskon = res.diskon;
                    }

                    // Cegah harga negatif
                    let totalBayar = Math.max(0, hargaAwal - diskon);

                    $('#vouchertext').text('Rp. ' + diskon.toLocaleString('id-ID'));
                    $('#totalHarga').text('Rp. ' + totalBayar.toLocaleString('id-ID'));

                    voucherValid = true;
                } else {
                    $('#vouchertext').text('0');
                    $('#totalHarga').text('Rp. ' + hargaAwal.toLocaleString('id-ID'));
                    alert(res.message);
                    voucherValid = false;
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat validasi voucher.');
                voucherValid = false;
            }
        });
    }


    // Reset status jika voucher diubah
    $('#voucherCode').on('input', function() {
        voucherIsChecked = false;
        voucherValid = false;
    });

    // Validasi saat form disubmit
    $('form').on('submit', function(e) {
        let kode = $('#voucherCode').val().trim();
        if (kode !== '') {
            if (!voucherIsChecked) {
                e.preventDefault();
                alert('Silakan cek voucher terlebih dahulu!');
                return;
            }
            if (!voucherValid) {
                e.preventDefault();
                alert('Voucher tidak valid. Silakan cek kembali.');
                return;
            }
        }
    });
</script>
@endsection