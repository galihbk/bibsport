<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'distance',
        'quota',
        'bib_prefix',
        'price'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
