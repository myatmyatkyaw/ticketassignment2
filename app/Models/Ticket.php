<?php

namespace App\Models;

use App\Models\User;
 use App\Models\Label;

use App\Models\Comment;


 use App\Models\Category;
use App\Models\TicketFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
     use HasFactory;

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function label(){
        return $this->belongsToMany(Label::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
     }
     public function ticketFiles()
    {
        return $this->hasMany(TicketFile::class);
    }

 }

