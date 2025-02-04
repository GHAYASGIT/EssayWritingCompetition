<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $permissions = Permission::orderBy('name')->latest()->paginate(8);
        return view('admin.role-permission.permission.index', compact('permissions'))->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $guards = array_keys(config('auth.guards'));
        return view('admin.role-permission.permission.create', compact('guards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'guard' => 'required|string'
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name'    => $request->guard
        ]);

        return redirect('admin/permission/create')->with('success', 'Permisssion Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('admin.role-permission.permission.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): View
    {
        $guards = array_keys(config('auth.guards'));
        return view('admin.role-permission.permission.edit', compact('permission', 'guards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,'.$permission->id,
            'guard' => 'required|string'
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name'    => $request->guard
        ]);
        
        return redirect('admin/permission')->with('success', 'Permission Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect('admin/permission')->with('success','Permission Deleted.');
    }
}
