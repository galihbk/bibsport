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

        // Pastikan path ke file PDF sudah benar
        $pdfPath = storage_path('app/invoices/invoice-' . $this->order->order_id . '.pdf');

        // Kirim email dengan attachment PDF
        return $this->subject('Invoice Pembayaran - ' . $this->order->order_id)
            ->view('emails.invoice')  // View email
            ->attach($pdfPath, [
                'as' => 'Invoice-' . $this->order->order_id . '.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
