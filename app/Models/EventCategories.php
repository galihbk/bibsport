<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategories extends Model
{
    protected $fillable = [
        'event_id',
        'category_event',
        'distance',
        'poster_category',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class); // Relasi ke Event
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class); // Relasi ke Ticket
    }
}
