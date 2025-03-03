<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = ['title', 'description', 'priority', 'os', 'software_id', 'status', 'user_id'];

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
