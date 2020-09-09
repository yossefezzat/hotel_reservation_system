<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class ShowRoomsController extends Controller
{
    public function showRooms(Request $request , $roomType = null ){
        if( isset($roomType)){
            $rooms = Room::where('room_type_id' , $roomType)->paginate(4);
        } else {
            $rooms = Room::paginate(5);
        }
        return view('rooms.index' , ['rooms' => $rooms]);
    }
}
