<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Categories::with('user')->orderBy('name')->latest()->paginate(8);
        return view('event_categories.index', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('event_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:50',
            'note'  => 'string|max:255',
            'status'=> 'required|string|in:active,inactive',
        ]);

        $user = Auth::user();

        Categories::create([
            'user_id'   =>  $user->id,
            'name'      =>  $request->name,
            'status'    =>  $request->status,
            'notes'     =>  $request->note
        ]);

        return redirect('categories/create')->with('success', 'Category Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        return view('event_categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'note' => 'required|string|max:255',
            'status'=> 'required|string|in:active,inactive',
        ]);

        $category->update([
            'name'      =>  $request->name,
            'notes'     =>  $request->note,
            'status'    =>  $request->status
        ]);

        return redirect('categories')->with('success', 'Category Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        $categories->delete();
        return redirect('categories')->with('success', 'Category Deleted.');
    }
}
