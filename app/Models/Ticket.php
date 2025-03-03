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

    public function currentAssignment()
    {
        return $this->hasOne(Assignment::class)->latest();
    }

    public function currentDeveloper()
    {
        return $this->hasOneThrough(
            User::class,
            Assignment::class,
            'ticket_id', // Foreign key on assignments table
            'id',        // Foreign key on users table
            'id',        // Local key on tickets table
            'developer_id' // Local key on assignments table
        )->latest('assignments.created_at');
    }
}
