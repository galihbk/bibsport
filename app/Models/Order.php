<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'ticket_id',
        'bib',
        'nama_lengkap',
        'nama_panggilan',
        'jenis_kelamin',
        'tanggal_lahir',
        'gol_darah',
        'ukuran_jersey',
        'jenis_identitas',
        'nomor_identitas',
        'provinsi',
        'kabupaten',
        'alamat',
        'email',
        'no_wa',
        'nama_kontak_darurat',
        'no_kontak_darurat',
        'hubungan_kontak',
        'voucher',
        'order_id',
        'snap_token',
        'status_pembayaran',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'jumlah_bayar',
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id'); // Relasi ke EventCategories
    }
}
