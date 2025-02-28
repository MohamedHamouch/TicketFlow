<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

}
