<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            height: 842px;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            font-size: 14px;
            background-image: url("{{ asset('assets/img/bibsport-opacity.png') }}");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 70%;
        }

        .card-header {
            background-color: #f7f7f7;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            font-size: 18px;
        }

        .float-end {
            float: right;
        }


        .card-body {
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col {
            padding: 10px;
            box-sizing: border-box;
        }

        .col-3 {
            width: 25%;
        }

        .col-6 {
            width: 50%;
        }

        .col-4 {
            width: 33.33%;
        }

        .col-9 {
            width: 75%;
        }

        .text-center {
            text-align: center;
        }

        .text-black {
            color: #000;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .table th {
            background: #eee;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .strong {
            font-weight: bold;
        }

        .brand-logo img {
            max-width: 100%;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .mb-5 {
            margin-bottom: 3rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .ms-auto {
            margin-left: auto;
        }

        .table-clear td {
            border: none !important;
        }

        .width110 {
            width: 110px;
        }
    </style>
</head>

<body>

    <div class="card-header">
        <table width="100%" style="border: none;">
            <tr>
                <td align="left">
                    <strong>{{ \Carbon\Carbon::parse($pendaftar->tanggal_pembayaran)->format('d/m/Y') }}</strong>
                </td>
                <td align="center">
                    <strong>{{ $pendaftar->order_id }}</strong>
                </td>
                <td align="right">
                    <strong> Success</strong>
                </td>
            </tr>
        </table>
    </div>


    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <td style="width: 30%;">
                        <div>From:</div>
                        <div><strong>{{$pendaftar->ticket->eventCategory->event->user->name}}</strong></div>
                        <div>{{$pendaftar->ticket->eventCategory->event->user->address}}</div>
                        <div>Email: {{$pendaftar->ticket->eventCategory->event->user->email}}</div>
                        <div>Phone: {{$pendaftar->ticket->eventCategory->event->user->phone}}</div>
                    </td>
                    <td style="width: 30%;">
                        <div>To:</div>
                        <div><strong>{{$pendaftar->nama_lengkap}}</strong></div>
                        <div>{{$pendaftar->alamat}}</div>
                        <div>Email: {{$pendaftar->email}}</div>
                        <div>Phone: {{$pendaftar->no_wa}}</div>
                    </td>
                    <td style="width: 30%;">
                        <div class="col col-9">
                            <div class="brand-logo mb-3">
                                <img class="logo-abbr me-2" width="200" src="{{ asset('assets/img/logo-bibsport-text-right.png') }}" alt="">
                            </div>
                            <span><strong class="d-block">www.bibsport.id</strong>
                        </div>
                    </td>
                    <td style="width: 30%;">
                        <div class="col col-3 mt-3">
                            <img src="{{asset('qrcodes/'.$pendaftar->order_id.'.png')}}" alt="" style="width: 150px;">
                        </div>
                    </td>
                </tr>
            </thead>
        </table>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="center text-black">#</th>
                        <th class="text-black">Nama event</th>
                        <th class="text-black">Kategori Event</th>
                        <th class="right text-black">Jenis Tiket</th>
                        <th class="center text-black">QTY</th>
                        <th class="right text-black">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="center">1</td>
                        <td class="left strong">{{$pendaftar->ticket->eventCategory->event->event_name}}</td>
                        <td class="left">{{$pendaftar->ticket->eventCategory->category_event}} - {{$pendaftar->ticket->eventCategory->distance}}K</td>
                        <td class="right">{{$pendaftar->ticket->name_ticket}}</td>
                        <td class="center">1</td>
                        <td class="right">Rp. {{ number_format($pendaftar->ticket->price, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col col-4"></div>
            <div class="col col-4 ms-auto">
                <table class="table table-clear">
                    <tbody>
                        @php
                        $price = $pendaftar->ticket->price;
                        $voucher = $pendaftar->voucher_code; // Misalnya 'ABC123'
                        $voucherData = App\Models\Voucher::where('code', $voucher)->first();

                        $discount = 0;

                        if ($voucherData) {
                        if ($voucherData->discount_type == 'fixed') {
                        $discount = $voucherData->value;
                        } elseif ($voucherData->discount_type == 'percent') {
                        $discount = $price * ($voucherData->value / 100);
                        }
                        }

                        $total = $price - $discount;
                        @endphp

                        <tr>
                            <td class="left"><strong>Subtotal</strong></td>
                            <td class="right">Rp. {{ number_format($price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong>Diskon
                                    @if($voucherData)
                                    ({{ $voucherData->discount_type == 'percent' ? $voucherData->value . '%' : 'Rp. ' . number_format($voucherData->value, 0, ',', '.') }})
                                    @else
                                    (Tidak ada)
                                    @endif
                                </strong>
                            </td>
                            <td class="right">Rp. {{ number_format($discount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="left"><strong>Total</strong></td>
                            <td class="right"><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>