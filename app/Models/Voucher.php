<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'ticket_id',
        'code',
        'discount_type',
        'discount_value',
        'quota',
        'quota_used',
        'discount_start',
        'discount_end',
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
