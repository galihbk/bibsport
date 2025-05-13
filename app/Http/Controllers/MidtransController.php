<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Debugging data yang diterima
        \Log::info('Midtrans Callback Received:', $request->all());

        // Menangani data dari Midtrans Notification
        $notif = new Notification();

        // Data yang diterima dari Midtrans
        $order_id = $notif->order_id; // ID order dari Midtrans
        $transaction_status = $notif->transaction_status; // Status transaksi
        $fraud_status = $notif->fraud_status; // Status fraud

        // Temukan order berdasarkan order_id
        $pendaftar = Order::with('ticket.eventCategory')->where('order_id', $order_id)->first();

        if (!$pendaftar) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Proses status transaksi
        if ($transaction_status == 'capture') {
            if ($fraud_status == 'challenge') {
                $pendaftar->status_pembayaran = 'challenge';
            } elseif ($fraud_status == 'accept') {
                $pendaftar->status_pembayaran = 'paid';
            }
        } elseif ($transaction_status == 'settlement') {
            $pendaftar->status_pembayaran = 'paid';
        } elseif ($transaction_status == 'pending') {
            $pendaftar->status_pembayaran = 'pending';
        } elseif (in_array($transaction_status, ['deny', 'expire', 'cancel'])) {
            $pendaftar->status_pembayaran = 'failed';
        }

        // Jika pembayaran berhasil, generate BIB
        if ($pendaftar->status_pembayaran === 'paid' && !$pendaftar->bib) {
            $gender = $pendaftar->jenis_kelamin; // L atau P
            $eventCategory = $pendaftar->ticket->eventCategory;
            $format = $gender === 'L' ? $eventCategory->bib_format_m : $eventCategory->bib_format_f;

            // Hitung jumlah peserta dengan BIB yang sudah diberikan
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
            $pendaftar->bib = $bib;
        }
        $pendaftar->metode_pembayaran = $notif->payment_type ?? null;
        if ($pendaftar->status_pembayaran === 'paid') {
            $pendaftar->tanggal_pembayaran = now();
        }
        $pendaftar->save();

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
