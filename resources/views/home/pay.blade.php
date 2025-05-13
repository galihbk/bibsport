@extends('layouts.home')

@section('title', 'Pembayaran')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow" style="border: none;">
                <div class="card-header">
                    <h4 class="text-center">Konfirmasi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="me-3">
                            <p><strong>Nama</strong> </p>
                            <p><strong>Email</strong> </p>
                            <p><strong>No. WA</strong> </p>
                            <p><strong>Event</strong> </p>
                            <p><strong>Kategori Tiket</strong> </p>
                            <p><strong>Harga Tiket</strong> </p>
                        </div>
                        <div>
                            <p>: {{ $pendaftar->nama_lengkap }}</p>
                            <p>: {{ $pendaftar->email }}</p>
                            <p>: {{ $pendaftar->no_wa }}</p>
                            <p>: {{ $ticket->eventCategory->event->event_name }}</p>
                            <p>: {{ $ticket->name_ticket }}</p>
                            <p>: Rp. {{ number_format($params['transaction_details']['gross_amount'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Midtrans Snap -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>


<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        window.snap.pay('{{$snapToken}}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                console.log(result);
                window.location.href = `event/payment/payment-status?order_id=${result.order_id}`;
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