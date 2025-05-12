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
        return $this->belongsTo(EventCategories::class, 'event_category_id');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'ticket_id');
    }
}
