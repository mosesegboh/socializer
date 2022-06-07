<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the followers for a single user.
     */
    public function followers()
    {
        return $this->hasMany(Follower::class);
    }

     /**
     * Get the followers for a single user.
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /*
    *increments or decrement table column based on passed parameter
    *
    *@params String $followed the followed
    *@params String $follower the folllower
    *@params Int $by increment by
    *@params Bool $increase increase or decrease
    *@return Bool
    */
   public static function adjustFollowStatus($followed,$follower, $by, $increase=true)
   {
       if ($increase == true) {
            Self::where('id', $followed)->increment('followers', $by);
            Self::where('id', $follower)->increment('following', $by);
            return true;
       }

       if ($increase == false) {
            Self::where('id', $followed)->decrement('followers', $by);
            Self::where('id', $follower)->decrement('following', $by);
            return true;
        }  
    }
}
