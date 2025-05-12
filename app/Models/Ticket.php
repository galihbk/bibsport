<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'event_categories_id',
        'name_ticket',
        'price',
        'quota',
        'ticket_start',
        'ticket_end',
    ];

    public function eventCategory()
    {
        return $this->belongsTo(EventCategories::class, 'event_categories_id'); // Relasi ke EventCategories
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class); // Relasi ke Voucher
    }
    public function orders()
    {
        return $this->hasMany(Order::class); // Relasi ke Ticket
    }
}
