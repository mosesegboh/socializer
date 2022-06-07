<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /*
    * Get the user that owns the likes.
    */
   public function tweet()
   {
       return $this->belongsTo(Tweet::class);
   }
}
