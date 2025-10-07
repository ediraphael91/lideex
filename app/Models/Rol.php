<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
