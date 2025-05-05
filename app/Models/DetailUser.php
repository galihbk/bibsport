<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    protected $table = 'detail_users';
    protected $fillable = [
        'identity_id',
        'type_doc',
        'file_doc',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
