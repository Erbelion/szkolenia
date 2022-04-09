<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
