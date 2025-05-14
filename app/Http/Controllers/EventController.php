<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\EventCategories;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use HTMLPurifier;
use Yajra\DataTables\Facades\DataTables;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Translation\Dumper\DumperInterface;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(6);
        return view('event.index', compact('events'));
    }
    public function addEvent()
    {
        return view('event.add-event');
    }
    public function store(Request $request)
    {
        $customMessages = [
            'nama_event.required' => 'Nama event wajib diisi.',
            'jenis_event.required' => 'Jenis event harus dipilih.',
            'lokasi_event.required' => 'Lokasi event tidak boleh kosong.',
            'maps_event.required' => 'Link Google Maps event tidak boleh kosong.',
            'lokasi_rpc.required' => 'Lokasi RPC tidak boleh kosong.',
            'maps_rpc.required' => 'Link Google Maps RPC tidak boleh kosong.',
            'instagram.required' => 'Akun Instagram wajib diisi.',
            'poster.required' => 'Poster wajib diunggah.',
            'poster.image' => 'Poster harus berupa file gambar.',
            'poster.mimes' => 'Poster harus dalam format JPG, JPEG, atau PNG.',
            'poster.max' => 'Ukuran poster maksimal 2MB.',
            'tanggal_mulai.required' => 'Tanggal mulai event wajib diisi.',
            'tanggal_akhir.required' => 'Tanggal akhir event wajib diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.',
            'tanggal_mulai_rpc.required' => 'Tanggal mulai RPC wajib diisi.',
            'tanggal_akhir_rpc.required' => 'Tanggal akhir RPC wajib diisi.',
            'tanggal_akhir_rpc.after_or_equal' => 'Tanggal akhir RPC tidak boleh lebih awal dari tanggal mulai RPC.',
            'deskripsi.required' => 'Deskripsi event harus diisi.',
            'skb.required' => 'Syarat dan ketentuan event wajib diisi.',
        ];

        $request->validate([
            'nama_event' => 'required|string|max:255',
            'jenis_event' => 'required|string',
            'lokasi_event' => 'required|string',
            'maps_event' => 'required|string',
            'lokasi_rpc' => 'required|string',
            'maps_rpc' => 'required|string',
            'instagram' => 'required|string',
            'poster' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'tanggal_mulai_rpc' => 'required|date',
            'tanggal_akhir_rpc' => 'required|date|after_or_equal:tanggal_mulai_rpc',
            'deskripsi' => 'required|string',
            'skb' => 'required|string',
        ], $customMessages);
        try {
            $poster = $request->file('poster');
            $filename = time() . '-' . $poster->getClientOriginalName();
            $poster->storeAs('posters', $filename, 'public');

            $config = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($config);

            $event = Event::create([
                'event_name' => strip_tags($request->nama_event),
                'slug' => Str::slug($request->nama_event) . '-' . Str::random(5),
                'event_type' => strip_tags($request->jenis_event),
                'location_event' => strip_tags($request->lokasi_event),
                'location_rpc' => strip_tags($request->lokasi_rpc),
                'maps_event' => strip_tags($request->maps_event),
                'maps_rpc' => strip_tags($request->maps_rpc),
                'start_date_event' => $request->tanggal_mulai,
                'end_date_event' => $request->tanggal_akhir,
                'start_date_rpc' => $request->tanggal_mulai_rpc,
                'end_date_rpc' => $request->tanggal_akhir_rpc,
                'instagram' => strip_tags($request->instagram),
                'poster_url' => $filename,
                'user_id' => auth()->user()->id,
                'description' => $purifier->purify($request->deskripsi),
                'skb' => $purifier->purify($request->skb),
            ]);
            Mail::to('admin@example.com')->queue(new AdminNotificationMail($event->id, 'daftar event'));

            return redirect()->route('event')->with('success', 'Event berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan event: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan event. Silakan coba lagi.');
        }
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        $events = Event::where('event_name', 'like', '%' . $query . '%')
            ->latest()
            ->paginate(6);

        return view('partials.card-event-admin', compact('events'))->render();
    }
    public function getDataScan(Request $request)
    {
        $order_id = $request->barcode;

        $order = Order::where('order_id', $order_id)->first();

        if ($order) {
            $statusText = $order->status_racepack == 1 ? 'Sudah diambil' : 'Belum diambil';
            $badgeClass = $order->status_racepack == 1 ? 'success' : 'danger';
            $buttonText = $order->status_racepack == 1 ? 'Scan Ulang' : 'Ambil Racepack';
            $butonFunc = $order->status_racepack == 1
                ? 'onclick="scanUlang()"'
                : 'onclick="ambilRacepack(\'' . $order->order_id . '\')"';

            $html = '
                <div class="col-lg-12">
                    <h5 class="text-center">Data Peserta</h5>
                    <div class="d-flex my-3">
                        <ul class="me-2 list-unstyled">
                            <li><strong>BIB</strong></li>
                            <li><strong>Nama</strong></li>
                            <li><strong>Ukuran Jersey</strong></li>
                            <li><strong>Pendaftaran</strong></li>
                            <li><strong>Racepack</strong></li>
                        </ul>
                        <ul id="show-data" class="list-unstyled">
                            <li>: ' . $order->bib . '</li>
                            <li>: ' . $order->nama_lengkap . '</li>
                            <li>: ' . $order->ukuran_jersey . '</li>
                            <li>: ' . $order->tanggal_pembayaran . '</li>
                            <li>: <span class="badge bg-' . $badgeClass . '">' . $statusText . '</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary w-100" ' . $butonFunc . '>' . $buttonText . '</button>
                    </div>
                </div>
            ';

            return response()->json([
                'success' => true,
                'data' => $html
            ]);
        }
        $html = '<div class="alert alert-danger solid alert-dismissible fade show">
									<svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
									<strong>Error!</strong> Peserta tidak terdaftar.
                                </div>';
        return response()->json([
            'success' => false,
            'data' => $html
        ]);
    }

    public function changeStatusRacepack(Request $request)
    {
        $order_id = $request->barcode;

        $order = Order::where('order_id', $order_id)->first();

        if ($order) {
            $order->status_racepack = 1;
            if ($order->save()) {
                $html = '<div class="alert alert-success solid alert-dismissible fade show">
									<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
									<strong>Berhasil!</strong> Status pengambilan racepack berhasil diubah.
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>';
                return response()->json([
                    'success' => true,
                    'message' => $html
                ]);
            }
        }
        $html = '<div class="alert alert-danger solid alert-dismissible fade show">
									<svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
									<strong>Gagal!</strong> Data gagal diubah, silahkan coba lagi atau refresh halaman.
                                </div>';
        return response()->json([
            'success' => false,
            'message' => $html
        ]);
    }
    public function eventDetail($id)
    {
        $event = Event::findOrFail($id);
        if ($event->user_id !== Auth::id()) {
            abort(404);
        }

        return view('event.detail', compact('event'));
    }
    public function categoryStore(Request $request)
    {
        $request->validate([
            'category_event' => 'required',
            'distance' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $poster = $request->file('poster');
        $filename = time() . '-' . $poster->getClientOriginalName();
        $poster->storeAs('posters', $filename, 'public');

        EventCategories::create([
            'event_id' => $request->event_id,
            'category_event' => $request->category_event,
            'distance' => $request->distance,
            'poster_category' => $filename,
        ]);

        return response()->json(['message' => 'Kategori berhasil ditambahkan!']);
    }
    public function categories(Request $request)
    {
        $eventId = $request->get('event_id');

        $events = EventCategories::with(['tickets.orders'])->where('event_id', $eventId)->get();

        foreach ($events as $category) {
            $totalPendaftar = 0;
            $totalL = 0;
            $totalP = 0;

            foreach ($category->tickets as $ticket) {
                foreach ($ticket->orders as $order) {
                    $totalPendaftar++;

                    if ($order->jenis_kelamin == 'L') {
                        $totalL++;
                    } elseif ($order->jenis_kelamin == 'P') {
                        $totalP++;
                    }
                }
            }
        }


        return view('partials.card-event-categories-admin', compact('events', 'totalPendaftar', 'totalP', 'totalL'))->render();
    }
    public function getPesertaTerdaftar(Request $request)
    {
        $orders = Order::with(['ticket.eventCategory'])->where('status_pembayaran', 'paid');

        if ($request->ajax()) {
            return DataTables::eloquent($orders)
                ->addColumn('kategori_event', function ($order) {
                    return $order->ticket->eventCategory->category_event ?? '-';
                })
                ->addColumn('nama_tiket', function ($order) {
                    return $order->ticket->name_ticket ?? '-';
                })
                ->addColumn('jenis_kelamin', function ($order) {
                    if ($order->jenis_kelamin == 'L') {
                        return 'Laki-laki';
                    } elseif ($order->jenis_kelamin == 'P') {
                        return 'Perempuan';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($order) {
                    return '<div class="dropdown">
														<button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown" aria-expanded="false">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
														</button>
														<div class="dropdown-menu" style="">
															<a class="dropdown-item" href="#">Detail</a>
															<a class="dropdown-item" href="#">Tandai racepack diambil</a>
														</div>
													</div>';
                })
                ->editColumn('tanggal_terdaftar', function ($order) {
                    return optional(Carbon::parse($order->tanggal_pembayaran))->format('d/m/Y');
                })
                ->make(true);
        }
    }
    public function getPesertaTidakTerdaftar(Request $request)
    {
        $orders = Order::with(['ticket.eventCategory'])->where('status_pembayaran', '<>', 'paid');

        if ($request->ajax()) {
            return DataTables::eloquent($orders)
                ->addIndexColumn() // Tambah kolom nomor otomatis
                ->addColumn('kategori_event', function ($order) {
                    return $order->ticket->eventCategory->category_event ?? '-';
                })
                ->addColumn('nama_tiket', function ($order) {
                    return $order->ticket->name_ticket ?? '-';
                })
                ->addColumn('action', function ($order) {
                    return '<button class="btn btn-primary">Action</button>';
                })
                ->editColumn('tanggal_terdaftar', function ($order) {
                    return optional($order->created_at)->format('d/m/Y');
                })
                ->make(true);
        }
    }


    public function ticketStore(Request $request)
    {
        $request->validate([
            'name_ticket'    => 'required',
            'price'          => 'required',
            'quota'          => 'required|integer',
            'ticket_start'   => 'required|date',
            'ticket_end'     => 'required|date|after_or_equal:ticket_start',
            'event_category_id' => 'required|exists:event_categories,id',
        ]);

        $price = preg_replace('/[^0-9]/', '', $request->price);

        Ticket::create([
            'event_categories_id' => $request->event_category_id,
            'name_ticket'       => $request->name_ticket,
            'price'             => $price,
            'quota'             => $request->quota,
            'ticket_start'      => $request->ticket_start,
            'ticket_end'        => $request->ticket_end,
        ]);

        return response()->json(['message' => 'Tiket berhasil ditambahkan!']);
    }
    public function voucherStore(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code',
            'voucher_type' => 'required|in:fixed,percent',
            'fixed_amount' => 'required_if:voucher_type,fixed|nullable',
            'percent_amount' => 'required_if:voucher_type,percent|nullable|numeric',
            'quota' => 'required|integer|min:1',
            'voucher_end' => 'required|date',
        ]);
        if ($request->voucher_type == 'percent') {
            $percentAmount = preg_replace('/[^0-9]/', '', $request->percent_amount);
            if ($percentAmount == '10') {
                $value = $percentAmount;
            } else {
                $value = preg_replace('/[^0-9]/', '', $request->percent_amount);
            }
        } else if ($request->voucher_type == 'fixed') {
            $value = preg_replace('/[^0-9]/', '', $request->fixed_amount);
        }

        Voucher::create([
            'ticket_id' => $request->ticket_id,
            'code'       => $request->code,
            'discount_type'             => $request->voucher_type,
            'discount_value'             => $value,
            'quota'             => $request->quota,
            'discount_end'        => $request->voucher_end,
        ]);

        return response()->json(['message' => 'Voucher berhasil ditambahkan!']);
    }
}
