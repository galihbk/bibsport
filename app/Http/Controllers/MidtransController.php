<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        \Log::info('Midtrans Callback Received:', $request->all());

        $notif = new Notification();

        $order_id = $notif->order_id;
        $transaction_status = $notif->transaction_status;
        $fraud_status = $notif->fraud_status;
        $jumlah_bayar = $notif->gross_amount;

        $order = Order::with('ticket.eventCategory')->where('order_id', $order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Proses status transaksi
        if ($transaction_status == 'capture') {
            if ($fraud_status == 'challenge') {
                $order->status_pembayaran = 'challenge';
            } elseif ($fraud_status == 'accept') {
                $order->status_pembayaran = 'paid';
            }
        } elseif ($transaction_status == 'settlement') {
            $order->status_pembayaran = 'paid';
        } elseif ($transaction_status == 'pending') {
            $order->status_pembayaran = 'pending';
        } elseif (in_array($transaction_status, ['deny', 'expire', 'cancel'])) {
            $order->status_pembayaran = 'failed';
        }

        if ($order->status_pembayaran === 'paid' && !$order->bib) {
            $gender = $order->jenis_kelamin; // L atau P
            $eventCategory = $order->ticket->eventCategory;
            $format = $gender === 'L' ? $eventCategory->bib_format_m : $eventCategory->bib_format_f;

            $count = Order::where('status_pembayaran', 'paid')
                ->where('jenis_kelamin', $gender)
                ->whereHas('ticket', function ($q) use ($eventCategory) {
                    $q->where('event_categories_id', $eventCategory->id);
                })
                ->whereNotNull('bib')
                ->count();

            preg_match('/#+/', $format, $matches);
            $placeholderLength = strlen($matches[0] ?? ''); // Jumlah karakter #
            $urutan = str_pad($count + 1, $placeholderLength, '0', STR_PAD_LEFT);

            $bib = preg_replace('/#+/', $urutan, $format);
            $order->bib = $bib;
            $order->metode_pembayaran = $notif->payment_type ?? null;
            if ($order->status_pembayaran === 'paid') {
                $order->tanggal_pembayaran = now();
                $order->jumlah_bayar = $jumlah_bayar;
            }
            $order->save();
            $qrPath = 'qrcodes/' . $order_id . '.png';
            $qrFullPath = public_path($qrPath);

            if (!file_exists($qrFullPath)) {
                $qrImage = QrCode::format('png')->size(200)->generate($order_id);

                if (!file_exists(public_path('qrcodes'))) {
                    mkdir(public_path('qrcodes'), 0755, true);
                }

                file_put_contents($qrFullPath, $qrImage);
            }
            $folder = storage_path('app/private/invoices');
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
            }

            $pdf = Pdf::loadView('pdf.invoice-pdf', compact('order'));
            $pdfPath = $folder . '/invoice-' . $order->order_id . '.pdf';
            $pdf->save($pdfPath);
            Mail::to($order->email)->send(new \App\Mail\InvoicePaidMail($order));
        }

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
