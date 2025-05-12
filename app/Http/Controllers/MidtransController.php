<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $notif = new Notification();

        $order_id = $notif->order_id;
        $status_code = $notif->status_code;
        $transaction_status = $notif->transaction_status;
        $fraud_status = $notif->fraud_status;

        $pendaftar = Order::with('ticket.eventCategory')->where('order_id', $order_id)->first();

        if (!$pendaftar) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($transaction_status == 'capture') {
            if ($fraud_status == 'challenge') {
                $pendaftar->status_pembayaran = 'challenge';
            } else if ($fraud_status == 'accept') {
                $pendaftar->status_pembayaran = 'paid';
            }
        } else if ($transaction_status == 'settlement') {
            $pendaftar->status_pembayaran = 'paid';
        } else if ($transaction_status == 'pending') {
            $pendaftar->status_pembayaran = 'pending';
        } else if (in_array($transaction_status, ['deny', 'expire', 'cancel'])) {
            $pendaftar->status_pembayaran = 'failed';
        }

        // ✅ Jika pembayaran berhasil, generate BIB
        if ($pendaftar->status_pembayaran === 'paid' && !$pendaftar->bib) {
            $gender = $pendaftar->jenis_kelamin; // L atau P
            $eventCategory = $pendaftar->ticket->eventCategory;

            $format = $gender === 'L' ? $eventCategory->bib_format_m : $eventCategory->bib_format_f;

            // Hitung jumlah peserta yang sudah punya BIB pada kategori dan gender yang sama
            $count = Order::where('status_pembayaran', 'paid')
                ->where('jenis_kelamin', $gender)
                ->whereHas('ticket', function ($q) use ($eventCategory) {
                    $q->where('event_categories_id', $eventCategory->id);
                })
                ->whereNotNull('bib')
                ->count();

            preg_match('/#+/', $format, $matches);
            $placeholderLength = strlen($matches[0] ?? ''); // jumlah #
            $urutan = str_pad($count + 1, $placeholderLength, '0', STR_PAD_LEFT);

            $bib = preg_replace('/#+/', $urutan, $format);
            $pendaftar->bib = $bib;
        }

        $pendaftar->save();

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
