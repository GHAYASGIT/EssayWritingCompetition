<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\EventFeedback;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDatetime = Carbon::now();
        
        // Event counts and latest events
        $active_events_count = Events::where('status', 'active')->count();
        $latest_events = Events::with(['category', 'booking'])
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        // Event categories
        $ongoing_events = Events::with('booking')
            ->where('started_at', '<=', $currentDatetime)
            ->where('end_at', '>=', $currentDatetime)
            ->where('status', '=', 'active')
            ->latest()
            ->get();

        $upcomming_events = Events::with('booking')
            ->where('started_at', '>=', $currentDatetime)
            ->where('status', '=', 'active')
            ->latest()
            ->get();

        $closed_events = Events::with('booking')
            ->where('end_at', '<', $currentDatetime)
            ->orWhere('status', '=', 'inactive')
            ->latest()
            ->limit(4)
            ->get();

        return view('welcome', compact(
            'ongoing_events',
            'upcomming_events',
            'closed_events',
            'active_events_count',
            'latest_events'
        ));
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
    public function show(string $id): View
    {
        // $event = Events::find($id);
        // return view('event.show', compact('event'));
        $event = Events::find($id);

        $topEvents = Events::withAvg('feedback', 'rating')
            ->orderBy('feedback_avg_rating', 'desc')
            ->take(3)
            ->get();

        return view('event.show', [
            'event' => $event,
            'topEvents' => $topEvents
        ]);        
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
