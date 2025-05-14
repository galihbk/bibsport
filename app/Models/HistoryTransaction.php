<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryTransaction extends Model
{
    protected $fillable = [
        'order_id',
        'nama',
        'voucher',
        'price',
        'ticket_name',
        'event_name',
        'category_name',
        'pay_method',
        'status',
    ];
}
