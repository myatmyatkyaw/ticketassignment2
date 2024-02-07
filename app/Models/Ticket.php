<?php

namespace App\Models;

use App\Models\User;
use App\Models\Label;
<<<<<<< HEAD
use App\Models\Comment;
=======
>>>>>>> 4f6e6fb0aba077bf7c03627090d7dc4c36d33b3c
use App\Models\Category;
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

<<<<<<< HEAD
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
=======
>>>>>>> 4f6e6fb0aba077bf7c03627090d7dc4c36d33b3c
    // protected $fillable = [
    //     '_token', // Add _token to allow mass assignment
    //     // other fillable attributes...
    // ];

}


