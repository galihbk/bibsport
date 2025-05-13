<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategories;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Voucher;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $order_id = 'RUN-3-1747050578';
        $pendaftar = Order::with('ticket.eventCategory.event.user')->where('order_id', $order_id)->first();
        $qrPath = 'app/qrcodes/' . $order_id . '.png';
        Storage::put($qrPath, QrCode::format('png')->size(200)->generate($order_id));
        $qrPublicPath = storage_path($qrPath);
        return view('pdf.invoice-pdf', compact('pendaftar', 'qrPath'));
        die;
        $folder = storage_path('app/invoices');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        // 2. Buat dan simpan file PDF
        $pdf = Pdf::loadView('pdf.invoice-pdf', compact('pendaftar'));
        $pdfPath = $folder . '/invoice-' . $pendaftar->order_id . '.pdf';
        $pdf->save($pdfPath);
    }
    public function test()
    {
        Mail::to($order->email)->send(new InvoicePaid($order));
    }
    public function contact()
    {
        return view('home.contact');
    }
    public function successPage(Request $request)
    {
        $order_id = $request->query('order_id');

        $order = Order::where('order_id', $order_id)->firstOrFail();

        return view('home.response-pay', compact('order'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        try {
            Mail::raw($request->message, function ($msg) use ($request) {
                $msg->to('net.galih7@gmail.com')
                    ->subject($request->subject)
                    ->from('noreply@bibsport.id', $request->name);
            });

            return response('OK', 200);
        } catch (\Exception $e) {
            return response('Gagal mengirim pesan: ' . $e->getMessage(), 500);
        }
    }
    public function run(Request $request)
    {
        $events = Event::paginate(10);
        return view('home.run', compact('events'));
    }
    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $user = User::where('id', $event->user_id)->firstOrFail();
        $category = EventCategories::with('tickets')->where('event_id', $event->id)->get();
        return view('home.details', compact(['event', 'category', 'user']));
    }
    public function register($id)
    {
        $ticket = Ticket::where('id', $id)->firstOrFail();
        return view('home.register', compact('ticket'));
    }
    public function registerStore(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi.',
            'email' => 'Format :attribute tidak valid.',
            'in' => ':attribute harus salah satu dari :values.',
            'date' => 'Format :attribute harus berupa tanggal.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute maksimal :max karakter.',
            'exists' => ':attribute tidak valid.',
        ];

        // Validasi request
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'gol_darah' => 'nullable|in:A,B,AB,O',
            'ukuran_jersey' => 'required|in:XS,S,M,L,XL,XXL,XXXL,XXXXL,XXXXXL',
            'jenis_identitas' => 'required|in:KTP,SIM,PASPORT,KARTU PELAJAR',
            'nomor_identitas' => 'required|string|max:50',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'no_wa' => 'required|string|max:20',
            'nama_kontak_darurat' => 'required|string|max:100',
            'no_kontak_darurat' => 'required|string|max:20',
            'hubungan_kontak' => 'required|string|max:50',
            'voucher' => 'nullable|string',
        ], $messages);

        // Simpan data ke database
        $pendaftar = Order::create($validated);

        // Ambil data tiket
        $ticket = Ticket::with('eventCategory.event')->findOrFail($validated['ticket_id']);

        $eventType = strtolower($ticket->eventCategory->event->event_type);

        // Tentukan prefix order_id berdasarkan jenis event
        $prefix = match ($eventType) {
            'lari' => 'RUN',
            'sepeda' => 'CYCLE',
            default => 'EVNT',
        };

        // Generate order_id
        $order_id = $prefix . '-' . $pendaftar->id . '-' . time();
        $pendaftar->order_id = $order_id;
        $pendaftar->save();

        // Default harga tiket
        $hargaAkhir = $ticket->price;

        // Jika ada voucher, hitung diskon
        if ($validated['voucher']) {
            $voucher = Voucher::where('code', $validated['voucher'])
                ->where('ticket_id', $validated['ticket_id'])
                ->first();

            // Jika voucher ada, hitung diskon
            if ($voucher) {
                if ($voucher->discount_type == 'percent') {
                    // Diskon persentase
                    $hargaAkhir -= ($hargaAkhir * ($voucher->discount_value / 100));
                } elseif ($voucher->discount_type == 'fixed') {
                    // Diskon tetap
                    $hargaAkhir -= $voucher->discount_value;
                }

                // Pastikan harga akhir tidak negatif
                $hargaAkhir = max(0, $hargaAkhir);
            }
        }

        // Siapkan data untuk Midtrans Snap
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $hargaAkhir,
            ],
            'customer_details' => [
                'first_name' => $pendaftar->nama_lengkap,
                'email' => $pendaftar->email,
                'phone' => $pendaftar->no_wa,
            ]
        ];

        // Dapatkan SnapToken dari Midtrans
        $snapToken = Snap::getSnapToken($params);
        // Tampilkan halaman pemba  yaran
        return view('home.pay', compact('pendaftar', 'snapToken', 'ticket', 'params'));
    }

    public function cekVoucher(Request $request)
    {
        $kode = $request->kode;
        $id = $request->id;

        // Cari voucher berdasarkan kode dan ticket_id yang diberikan
        $voucher = Voucher::where(['code' => $kode, 'ticket_id' => $id])
            ->where('discount_end', '>=', now())  // Pastikan voucher belum kedaluwarsa
            ->first();

        // Jika voucher tidak ditemukan
        if (!$voucher) {
            return response()->json([
                'status' => false,
                'message' => 'Voucher tidak valid atau sudah kedaluwarsa.'
            ]);
        }

        // Hitung jumlah penggunaan voucher di tabel orders
        $totalUsed = Order::where('voucher', $kode)->count();

        // Cek kuota apakah sudah habis
        if ($totalUsed >= $voucher->quota) {
            return response()->json([
                'status' => false,
                'message' => 'Kuota voucher sudah habis.'
            ]);
        }

        // Setelah memverifikasi, kita return informasi voucher
        return response()->json([
            'status' => true,
            'message' => 'Voucher valid.',
            'tipe' => $voucher->discount_type,
            'diskon' => $voucher->discount_value,
        ]);
    }
}
