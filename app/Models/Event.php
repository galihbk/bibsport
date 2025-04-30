<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'location',
        'start_date',
        'end_date',
        'event_type',
        'poster_url',
        'bib_format',
        'max_participants',
        'registration_fee',
        'registration_start',
        'registration_end',
        'status',
        'admin_email'
    ];

    public function categories()
    {
        return $this->hasMany(EventCategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_email', 'email');
    }
}
