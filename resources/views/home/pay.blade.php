@extends('layouts.home')

@section('title', 'Pembayaran')

@section('content')
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Konfirmasi Pembayaran</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $pendaftar->nama_lengkap }}</p>
            <p><strong>Email:</strong> {{ $pendaftar->email }}</p>
            <p><strong>No. WA:</strong> {{ $pendaftar->no_wa }}</p>
            <p><strong>Event:</strong> {{ $ticket->eventCategory->event->name }}</p>
            <p><strong>Kategori Tiket:</strong> {{ $ticket->name }}</p>
            <p><strong>Harga Bayar:</strong> Rp{{ number_format($params['transaction_details']['gross_amount'], 0, ',', '.') }}</p>

            <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Midtrans Snap -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                console.log(result);
                // TODO: Kirim result ke server pakai AJAX
            },
            onPending: function(result) {
                alert("Menunggu pembayaran...");
                console.log(result);
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
                console.log(result);
            },
            onClose: function() {
                alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>
@endsection