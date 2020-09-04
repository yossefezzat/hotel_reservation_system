<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class ShowRoomsController extends Controller
{
    public function showRooms(Request $request ){
        $rooms = DB::table('rooms')->get();
        if($request->query('id') != null){
            $rooms = $rooms->where('room_type_id' , $request->query('id'));
        }
        return view('rooms.index' , ['rooms' => $rooms]);
    }
}
