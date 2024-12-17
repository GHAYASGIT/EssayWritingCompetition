<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Events::with(['user','category'])->orderBy('name')->latest()->paginate(8);
        return view('events.index', compact('events'))->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Categories::select(['id','name'])->get();
        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [];

        $request->validate([
            'name'          => 'required|string|max:50',
            'category_id'   => 'required|exists:categories,id',
            'started_at'    => 'required|date',
            'end_at'        => 'required|date|after:started_at',
            'status'        => 'required|string|in:active,inactive',
            'subscribers'    => 'required|integer|min:0'
        ]);

        if(isset($request->description)){
            $request->validate([
                'description' => 'string|max:250'
            ]);

            $data += ['description' => $request->description];
        }

        if(isset($request->event_image)){
            $request->validate([
                'event_image' => 'image|max:1024'
            ]);

            $path = $request->file('event_image')->store('events','public');
            
            $data += ['image' => $path];
        }        

        $user = Auth::user();
        
        $data += [
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'started_at'    => $request->started_at,
            'end_at'        => $request->end_at,
            'status'        => $request->status,
            'subscribers'    => $request->subscribers,
            'user_id'       => $user->id
        ];

        Events::create($data);

        return redirect('events/create')->with('success', 'Event Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $event)
    {
        $categories = Categories::select(['id','name'])->get();
        return view('events.edit', compact('event','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $event)
    {
        $data = [];

        $request->validate([
            'name'          => 'required|string|max:50',
            'category_id'   => 'required|exists:categories,id',
            'started_at'    => 'required|date',
            'end_at'        => 'required|date|after:started_at',
            'status'        => 'required|string|in:active,inactive',
            'subscribers'    => 'required|integer|min:0'
        ]);

        if(isset($request->description)){
            $request->validate([
                'description' => 'string|max:250'
            ]);

            $data += ['description' => $request->description];
        }

        if(isset($request->event_image)){

            $image_path = public_path("storage/").$event->image;

            if(file_exists($image_path)){
                @unlink($image_path);
            }

            $request->validate([
                'event_image' => 'image|max:1024'
            ]);

            $path = $request->file('event_image')->store('events','public');
            
            $data += ['image' => $path];
        }        

        $user = Auth::user();
        
        $data += [
            'name'          => $request->name,
            'category_id'   => $request->category_id,
            'started_at'    => $request->started_at,
            'end_at'        => $request->end_at,
            'status'        => $request->status,
            'subscribers'    => $request->subscribers,
            'user_id'       => $user->id
        ];

        $event->update($data);

        return redirect('events')->with('success', 'Event Created.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $event)
    {
        $image_path = public_path("storage/").$event->image;

        if(file_exists($image_path)){
            @unlink($image_path);
        }

        $event->delete();
        return redirect('events')->with('success', 'Event Deleted.');
    }

    public function active($id)
    {
        try{
            $event = Events::findOrFail($id);
            $event->update(['status' => 'active']);
            return redirect('events')->with('success', 'Event Activated.');    
        }catch(ModelNotFoundException $e){
            return redirect('events')->with('error', 'No record found for the given value.');
        }
    }

    public function inactive($id)
    {
        try{
            $event = Events::findOrFail($id);
            $event->update(['status' => 'inactive']);
            return redirect('events')->with('success', 'Event is inactive.');    
        }catch(ModelNotFoundException $e){
            return redirect('events')->with('error', 'No record found for the given value.');
        }
    }
}
