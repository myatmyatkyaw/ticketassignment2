<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Label extends Model
{
    use HasFactory;
    public function ticket()
<<<<<<< HEAD
    {
        return $this->belongsToMany(Ticket::class);
    }
=======
{
    return $this->belongsToMany(Ticket::class);
}
>>>>>>> 4f6e6fb0aba077bf7c03627090d7dc4c36d33b3c
}
