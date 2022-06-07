<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    
    /*
    * Get the user that owns the follower
    */
   public function user()
   {
       return $this->belongsTo(User::class);
   }

   /*
    * Gets number of entries based on passed parameter
    *@params Array $column_array Array of column names followed
    *@params mixed $is IsWhere clause parameter
    *@return Array
    */
    public static function getCount($column_array, $is)
    {
        $resultArray = array();
        foreach ($column_array as $key => $value) {
            $count = Follower::where($value, $is)->count();
            array_push($resultArray, $count);
        }
        return $resultArray;     
    }  
}
