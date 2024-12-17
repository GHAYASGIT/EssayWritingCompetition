<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDatetime = Carbon::now();
        $ongoing_events = Events::where('started_at', '<=', $currentDatetime)->where('end_at', '>=', $currentDatetime)->where('status','=','active')->get();
        $upcomming_events = Events::where('started_at', '>=', $currentDatetime)->where('status','=','active')->get();

        return view('welcome', compact('ongoing_events', 'upcomming_events'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $events = Events::find($id);
        dd($events);        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
