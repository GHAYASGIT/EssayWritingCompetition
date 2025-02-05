<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\QuestionOptions;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QuestionOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $event_id = $request->event;
        $question_options = QuestionOptions::where('event_id', $event_id)->orderBy('id')->latest()->paginate(8);
        return view('admin.mcqs.index', compact('event_id', 'question_options'))->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $event_id = $request->event;
        return view('admin.mcqs.create', compact('event_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question'      => 'required|string',
            'options'       => 'array',
            'event_id'      => 'required|numeric',
            'correct_option'=> 'required|numeric'
        ]);
        
        try{
            $questionOptions = QuestionOptions::create([
                'event_id'      => $request->event_id,
                'question'      => $request->question,
                'options'       => Json::encode($request->options),
                'correct_option'=> $request->correct_option
            ]);
        }catch(\Exception $e){
            return back()->with('error', 'Somthing went wrong. Please contect to customer support.');
        }

        return back()->with('success', 'Question Added');

    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionOptions $questionOptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        return view('admin.mcqs.edit', compact('questionOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestionOptions $questionOptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionOptions $questionOptions)
    {
        //
    }
}
