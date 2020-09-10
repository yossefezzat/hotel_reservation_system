<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey= 'id';
    public $timestamps = 'true';

    function scopeByType($query , $roomType= null){

        if(!is_null($roomType)){
            $query->where('room_type_id' , $roomType);
        }
        return $query;
    }

    public function roomType(){
        return $this->belongsTo('App\RoomType', 'room_type_id', 'id');
    }

}
