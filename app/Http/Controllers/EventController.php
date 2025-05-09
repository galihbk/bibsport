<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        return view('event.index');
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
}
