<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class InvoicePaidMail extends Mailable
{
    use Queueable;

    public $order;

    /**
     * Buat instance baru dari pesan email.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Bangun pesan pengiriman email.
     *
     * @return $this
     */
    public function build()
    {

        try {
            $pdfPath = storage_path('app/private/invoices/invoice-' . $this->order->order_id . '.pdf');

            if (!file_exists($pdfPath)) {
                Log::error('PDF invoice not found.', ['path' => $pdfPath]);
                throw new \Exception("File PDF tidak ditemukan di path: " . $pdfPath);
            }

            return $this->subject('Invoice Pembayaran - ' . $this->order->order_id)
                ->view('emails.invoice')
                ->attach($pdfPath, [
                    'as' => 'Invoice-' . $this->order->order_id . '.pdf',
                    'mime' => 'application/pdf',
                ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email invoice.', [
                'order_id' => $this->order->order_id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }
}
