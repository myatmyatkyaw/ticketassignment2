<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketFile extends Model
{
    use HasFactory;
    protected $fillable = ['file_name'];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
