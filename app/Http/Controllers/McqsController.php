<?php

namespace App\Http\Controllers;

use App\Models\Mcqs;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Models\QuestionOptions;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class McqsController extends Controller
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
            if($event->category->name == 'MCQs'){
                if($event->end_at <= now()->format('Y-m-d H:i:s')){
                    return back()->with('info', 'Event is closed now.');
                }
                $booking = $event->getUserBookingByEventId($request->id);
                $mcqs = QuestionOptions::select('id', 'event_id', 'question', 'options')->where('event_id', $event->id)->get();

                // $mcq = $event->eventIsDrafted($request->id, $event->category->name);
                if($booking){
                    // if($mcq){
                    //     return view('mcq.create', compact('event', 'mcq'));
                    // }
                    return view('mcq.create', compact('event', 'mcqs'));
                }else{
                    return back()->with('info', 'First enroll to the event and then try to start the event.');
                }
            }else{
                return back()->with('info', 'You are not allowd.');
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
            'event_id'  => 'required|string',
            'question'  => 'required|array'
        ]);

        Mcqs::create([
            'user_id'       => Auth::user()->id,
            'event_id'      => $request->event_id,
            'content'       => Json::encode($request->question),
            'is_drafted'    => '0',
            'is_submitted'  => '1'
        ]);

        return redirect()->route('home.index')->with('success', 'Your event has been submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mcqs $mcq)
    {
        if($mcq->user_id == Auth::user()->id){

            foreach(json_decode($mcq->content) as $key => $value){
                $qo = QuestionOptions::find($key);
                $data[] = [
                    'qus' => $qo->question,
                    'option' => Json::decode($qo->options)[$value->option] ?? null
                ];
            }

            return view('mcq.show', compact('data'));
        }else{
            return back()->with('error', 'You are not allowed to access another essays.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mcqs $mcqs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mcqs $mcqs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mcqs $mcqs)
    {
        //
    }
}
