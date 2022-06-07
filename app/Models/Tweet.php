<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    /**
    * Get the user that owns the tweet.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Get the likes for a single tweet.
    */
    public function likes()
    {
        return $this->hasMany(Follower::class);
    }
}
