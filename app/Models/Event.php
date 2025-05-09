<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'slug',
        'description',
        'skb',
        'location_event',
        'location_rpc',
        'maps_event',
        'maps_rpc',
        'start_date_event',
        'end_date_event',
        'start_date_rpc',
        'end_date_rpc',
        'event_type',
        'instagram',
        'poster_url',
        'user_id'
    ];

    public function categories()
    {
        return $this->hasMany(TicketCatgeori::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
