<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\EventCategories;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use HTMLPurifier;
use Yajra\DataTables\Facades\DataTables;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\Log;
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

            Event::create([
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
                'description' => $purifier->purify($request->deskripsi), // CKEditor input
                'skb' => $purifier->purify($request->skb), // CKEditor input
            ]);

            return redirect()->route('event')->with('success', 'Event berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Catat error ke log
            Log::error('Gagal menyimpan event: ' . $e->getMessage());

            // Redirect balik ke form dengan error message
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
        $orders = Order::with(['ticket.eventCategory']);

        if ($request->ajax()) {
            return DataTables::eloquent($orders)
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
                    return optional($order->tanggal_pembayaran)->format('d/m/Y');
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
