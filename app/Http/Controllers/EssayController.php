<?php

namespace App\Http\Controllers;

use App\Models\Essay;
use App\Models\Events;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EssayController extends Controller
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
    public function create(Request $request)
    {
        try{
            $event = Events::findOrFail($request->id);
            if($event->end_at <= now()->format('Y-m-d H:i:s')){
                return back()->with('info', 'Event is closed now.');
            }
            $booking = $event->getUserBookingByEventId($request->id);
            $essay = $event->essayIsDrafted($request->id);
            if($booking){
                if($essay){
                    return view('essay.create', compact('event', 'essay'));
                }
                return view('essay.create', compact('event'));
            }else{
                return back()->with('info', 'First enroll to the event and then try to start the event.');
            }
        }catch(ModelNotFoundException $e){
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'essay_content' => 'required|string'
        ]);

        if($request->is_drafted){
            $exists = Essay::where([
                'user_id'   => Auth::user()->id,
                'event_id'  => $request->event_id,
            ])->exists();

            if($exists){
                Essay::where([
                    'user_id'   => Auth::user()->id,
                    'event_id'  => $request->event_id,
                ])->update([
                    'content' => $request->essay_content,
                    'is_drafted'    => '1',
                    'is_submitted'  => '0'
                ]);

                return redirect()->route('home.index')->with('success', 'Your essay has been drafted.');
            }else{
                Essay::create([
                    'user_id'       => Auth::user()->id,
                    'event_id'      => $request->event_id,
                    'content'       => $request->essay_content,
                    'is_drafted'    => '1',
                    'is_submitted'  => '0'
                ]);

                return redirect()->route('home.index')->with('success', 'Your essay has been drafted.');
            }
        }else{
            $exists = Essay::where([
                'user_id'   => Auth::user()->id,
                'event_id'  => $request->event_id,
            ])->exists();

            if($exists){
                Essay::where([
                    'user_id'   => Auth::user()->id,
                    'event_id'  => $request->event_id,
                ])->update([
                    'content' => $request->essay_content,
                    'is_drafted'    => '0',
                    'is_submitted'  => '1'
                ]);

                return redirect()->route('home.index')->with('success', 'Your essay has been submitted.');
            }else{
                Essay::create([
                    'user_id'       => Auth::user()->id,
                    'event_id'      => $request->event_id,
                    'content'       => $request->essay_content,
                    'is_drafted'    => '0',
                    'is_submitted'  => '1'
                ]);

                return redirect()->route('home.index')->with('success', 'Your essay has been submitted.');
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Essay $essay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Essay $essay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Essay $essay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Essay $essay)
    {
        //
    }
}
