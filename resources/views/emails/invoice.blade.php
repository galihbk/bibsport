<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>
</head>

<body>
    <h2>Terima kasih, {{ $order->nama }}</h2>

    <p>Pembayaran Anda telah kami terima.</p>

    <ul>
        <li><strong>Order ID:</strong> {{ $order->order_id }}</li>
        <li><strong>Status:</strong> {{ $order->status_pembayaran }}</li>
        <li><strong>BIB:</strong> {{ $order->bib }}</li>
    </ul>

    <p>Silakan unduh invoice Anda dalam bentuk PDF pada lampiran email ini.</p>

    <p>Terima kasih.</p>
</body>

</html>