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
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'event_categories_id');
    }
}
