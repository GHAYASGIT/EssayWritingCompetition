<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = Admin::latest()->paginate(8);
        return view('admin.admin_user.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::select('name')->where('guard_name', '=', 'web')->orderBy('name', 'ASC')->get();
        return view('admin.admin_user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(isset($request->role)){
            foreach($request->role as $role){
                $user->assignRole($role);
            }
        }

        return redirect('admin/adminuser/create')->with('success', 'User Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $user)
    {
        $roles = Role::select('name')->orderBy('name', 'ASC')->get();
        return view('admin.admin_user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $user)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
        ]);
        $data = [
            'name' => $request->name,
        ];

        if($user->email != $request->email){
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            ]);
            $data += [
                'email' => $request->email
            ];
        }

        if(isset($request->password)){
            $request->validate([
                'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);

        if(isset($request->role)){
            $user->syncRoles($request->role);
        }


        return redirect('admin/adminuser')->with('success', 'User Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $user)
    {
        $user->delete();

        return redirect('admin/adminuser')->with('success','User Deleted.');
    }
}
