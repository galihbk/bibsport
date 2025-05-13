@extends('layouts.home')

@section('title', 'Status Pembayaran')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow text-center" style="border: none;">
                <div class="card-header">
                    <h4>Status Pembayaran</h4>
                </div>
                <div class="card-body" id="status-container">
                    <div class="mb-4" id="status-icon">
                        <i class="fas fa-spinner fa-spin fa-5x text-secondary"></i>
                    </div>
                    <p id="status-message" class="lead">
                        Sedang memverifikasi pembayaran Anda...
                    </p>
                    <p class="text-muted">
                        Order ID: <strong>{{ request('order_id') }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const orderId = "{{ $order_id }}";
    const statusIcon = document.getElementById('status-icon');
    const statusMessage = document.getElementById('status-message');

    const icons = {
        pending: '<i class="fas fa-spinner fa-spin fa-5x text-secondary"></i>',
        paid: '<i class="fas fa-check-circle fa-5x text-success"></i>',
        failed: '<i class="fas fa-times-circle fa-5x text-danger"></i>',
    };

    const messages = {
        pending: 'Sedang memverifikasi pembayaran Anda...',
        paid: 'Terima kasih, pembayaran Anda berhasil!<br>Invoice sudah di kirimkan melalui email yang di daftarkan!',
        failed: 'Maaf, pembayaran Anda gagal atau dibatalkan. Silahkan hubungi admin jika anda sudah mengirim uang',
    };

    let interval = null;

    const checkStatus = () => {
        $.ajax({
            url: `/events/payment/check-payment-status/${orderId}`, // Ganti dengan URL API yang benar
            method: 'GET',
            success: function(data) {
                const status = data.status;

                statusIcon.innerHTML = icons[status] ?? icons.pending;
                statusMessage.innerHTML = messages[status] ?? messages.pending;

                if (status === 'paid' || status === 'failed') {
                    if (interval) {
                        clearInterval(interval);
                        interval = null;
                    }
                }
            },
            error: function(err) {
                console.error(err);
                statusMessage.innerHTML = 'Terjadi kesalahan. Silakan muat ulang halaman.';
                if (interval) {
                    clearInterval(interval);
                    interval = null;
                }
            }
        });
    };

    checkStatus();
    interval = setInterval(checkStatus, 3000); // Cek setiap 3 detik
</script>

@endsection