<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
	use SoftDeletes , Notifiable;
    
    protected $fillable = [
    	'room_id',
    	'start',
    	'end',
    	'is_reservation',
    	'is_paid',
    	'notes',
    ];

    public function room()
    {
    	return $this->belongsTo('App\Room');
    }

    public function users()
    {
    	return $this->belongsToMany('App\User', 'bookings_users', 'booking_id', 'user_id')->withTimestamps();
    }
}
