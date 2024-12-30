<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Events;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        try{
            $event = Events::findOrFail($request->event_id);
            $is_booking = Booking::where('user_id', Auth::user()->id)->where('event_id', $request->event_id)->exists();
            if($is_booking){
                return back()->with('info', "You have already inrolled on this event : $event->name");
            }
            if($event->status == 'inactive'){
                return back()->with('info', "Sorry! Enrollment for this event : $event->name, is closed.");
            }
            $booking = Booking::create([
                'booking_no'    => $this->generateBookingNo(),
                'user_id'       => Auth::user()->id,
                'event_id'      => $request->event_id,
            ]);
            
            return back()->with('success', 'Booking is created with id : '.$booking->booking_no);
        }catch(ModelNotFoundException $e){
            return back()->with('error', 'Somthing went wrong. Please contact to website support.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function generateBookingNo()
    {
        $bookingObj = Booking::select('booking_no')->latest('id')->first();
        if ($bookingObj) {
            $bookingNr = $bookingObj->booking_no;
            $removed1char = substr($bookingNr, 1);
            $generateBooking_nr = '#' . str_pad($removed1char + 1, 8, "0", STR_PAD_LEFT);
        } else {
            $generateBooking_nr = '#' . str_pad(1, 8, "0", STR_PAD_LEFT);
        }
        return $generateBooking_nr;
    }    
}
