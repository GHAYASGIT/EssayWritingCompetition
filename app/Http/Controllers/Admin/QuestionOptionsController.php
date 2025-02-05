<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuestionOptions;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request): View
    // {
    //     $event_id = $request->event;
    //     $question_options = QuestionOptions::where('event_id', $event_id)->orderBy('id')->latest()->paginate(8);
    //     return view('admin.mcqs.index', compact('event_id', 'question_options'))->with('i', (request()->input('page', 1) - 1) * 8);
    // }

    public function viewQuestion(Request $request) : View {
        $event_id = $request->event;
        $question_options = QuestionOptions::where('event_id', $event_id)->orderBy('id')->latest()->paginate(8);
        return view('admin.mcqs.index', compact('event_id', 'question_options'))->with('i', (request()->input('page', 1) - 1) * 8);        
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request): View
    // {
    //     $event_id = $request->event;
    //     return view('admin.mcqs.create', compact('event_id'));
    // }

    public function createQuestion(Request $request): View
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
            QuestionOptions::create([
                'event_id'      => $request->event_id,
                'question'      => $request->question,
                'options'       => Json::encode(array_values(array_filter($request->options))),
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
    public function edit(QuestionOptions $questionoption): View
    {
        return view('admin.mcqs.edit', compact('questionoption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestionOptions $questionoption)
    {
        $request->validate([
            'question'      => 'required|string',
            'options'       => 'array',
            'event_id'      => 'required|numeric',
            'correct_option'=> 'required|numeric'
        ]);
                
        try{
            $questionoption->update([
                'event_id'      => $request->event_id,
                'question'      => $request->question,
                'options'       => Json::encode(array_values(array_filter($request->options))),
                'correct_option'=> $request->correct_option
            ]);
        }catch(\Exception $e){
            return back()->with('error', 'Somthing went wrong. Please contect to customer support.');
        }

        return back()->with('success', 'Question Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionOptions $questionOptions)
    {
        //
    }
}
