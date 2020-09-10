<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Eager Loading for relationships
        $bookings = Booking::with(['room.roomType' , 'users:name'])->paginate(1);
        return view('bookings.index')
                ->with('bookings' , $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')->get()->pluck('name', 'id');
        $rooms = DB::table('rooms')->get()->pluck('number' , 'id');
        return view('bookings.create')
                ->with('users' , $users)
                ->with('rooms' , $rooms);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = Booking::create($request->input());
        $users = $booking->users()->attach($request->input('user_id'));
        return redirect()->action('BookingController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('bookings.show' , ['booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $users = DB::table('users')->get()->pluck('name', 'id')->prepend('none');
        $rooms = DB::table('rooms')->get()->pluck('number' , 'id');
        $bookingUser = DB::table('bookings_users')->where('booking_id' , $booking->id)->first();
        return view('bookings.edit')
                ->with('users' , $users)
                ->with('rooms' , $rooms)
                ->with('bookingsUser', $bookingUser)
                ->with('booking' , $booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $booking->fill($request->input());
        $booking->save();
        $booking->users()->sync([$request->input('user_id')]);
        return redirect()->action('BookingController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->users()->detach();
        $booking->delete();
        return redirect()->action('BookingController@index');
    }
}
