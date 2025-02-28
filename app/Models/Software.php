<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
