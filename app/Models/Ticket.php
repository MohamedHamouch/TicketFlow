<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function software()
    {
        return $this->belongsTo(Software::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
