<?php

namespace App\Http\Controllers;

use App\Models\QuestionOptions;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QuestionOptionsController extends Controller
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
    public function create(): View
    {
        
        return view('admin.mcqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'option' => 'required|string',
            'event_id' => 'required|numeric'
        ]);

        $questionOptions = QuestionOptions::create([
            'question'  => $request->question,
            'option'    => $request->option,
            'event_id'  => $request->event_id
        ]);

        return Response::json(['data'=>'done'], '200');
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
    public function edit(QuestionOptions $questionOptions)
    {
        //
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
