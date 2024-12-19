<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->paginate(8);
        return view('admin.role-permission.roles.index', compact('roles'))->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $guards = array_keys(config('auth.guards'));
        return view('admin.role-permission.roles.create', compact('permissions', 'guards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|unique:roles,name',
            'guard' => 'required|string'
        ]);

        $role = Role::create([
            'name'          => $request->name,
            'guard_name'    => $request->guard
        ]);

        if(!empty($request->permission)){
            foreach($request->permission as $permission){
                $role->givePermissionTo($permission);
            }
        }

        return redirect('admin/role/create')->with('success', 'Role Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.role-permission.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $guards = array_keys(config('auth.guards'));
        return view('admin.role-permission.roles.edit', compact('role','permissions','guards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        if(!empty($request->permission)){
            $role->syncPermissions($request->permission);
        }
        
        return redirect('admin/role')->with('success', 'Role Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect('admin/role')->with('success','Role Deleted.');
    }
}
