<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function type()
    {
        return $this->belongsTo('App\RoomType', 'room_type_id', 'id');
    }
    
    public function reservations()
    {
        return $this->belongsToMany('App\Reservation','reservation_room');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }

    public function scopecheck_in_checkOut($query,$check_in,$check_out,$city_id,$room_size)
    {
        $query->with(['type','hotel'])
            ->whereDoesntHave('reservations' , function($q) use ($check_in, $check_out) {
                    $q->where('check_out', '>', $check_in);
                    $q->where('check_in', '<', $check_out);
                })->whereHas('hotel.city',function($q) use ($city_id){
                    $q->where('id',$city_id);
                })
                ->whereHas('type',function($q)  use ($room_size){
                    $q->where('amount','>','0');
                    $q->where('size','=',$room_size);
                });

    }
    

    
}

