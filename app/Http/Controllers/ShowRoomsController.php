<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class ShowRoomsController extends Controller
{
    public function showRooms(Request $request , \App\RoomType $roomType = null ){
        $rooms = Room::byType($roomType->id)->get(); 
        return view('rooms.index' , ['rooms' => $rooms]);
    }
}
