<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>
</head>

<body>
    <h2>Terima kasih, {{ $order->nama_lengkap }}</h2>

    <p>Kami dengan senang hati menginformasikan bahwa pembayaran Anda telah berhasil kami terima.</p>

    <div style="display: flex;">
        <ul style="margin-right: 10px; list-style: none; padding: 0;">
            <li><strong>Order ID</strong></li>
            <li><strong>Nama event</strong></li>
            <li><strong>Kategori Event</strong></li>
            <li><strong>Jenis Tiket</strong></li>
            <li><strong>Nomor BIB</strong></li>
            <li><strong>Status Pembayaran</strong></li>
        </ul>
        <ul style="list-style: none; padding: 0;">
            <li>: {{ $order->order_id }}</li>
            <li>: {{$order->ticket->eventCategory->event->event_name}}</li>
            <li>: {{$order->ticket->eventCategory->category_event}} - {{$order->ticket->eventCategory->distance}}K</li>
            <li>: {{$order->ticket->name_ticket}}</li>
            <li>: {{ $order->bib }}</li>
            <li>: Success</li>
        </ul>
    </div>

    <p>Silakan unduh invoice Anda dalam format PDF yang telah kami lampirkan pada email ini. Harap cetak dan bawa invoice tersebut saat proses pengambilan Racepack sebagai bukti validasi pembayaran.</p>

    <p>Apabila Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kontak panitia yang ada di deskripsi event.</p>

    <p>Terima kasih atas kepercayaan Anda dan sampai jumpa di hari event.</p>

</body>

</html>