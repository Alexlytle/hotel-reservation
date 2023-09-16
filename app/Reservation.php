<?php

namespace App;

use App\Room;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function rooms()
    {
        return $this->belongsToMany('App\Room','reservation_room','reservation_id','room_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function scopeDate($query,$last_date)
    {
       return $query->whereHas('rooms.hotel')->where('check_in','>=',$last_date);
    }



    // protected static function booted()
    // {
    //     static::addGlobalScope('user',function(Builder $builder){
    //         $builder->where('user_id',2);
    //     });
    // }
  

}
  
 