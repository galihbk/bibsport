<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
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
        'user_id',
        'event_type'
    ];

    public function eventCategories()
    {
        return $this->hasMany(EventCategories::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke Event
    }
}
