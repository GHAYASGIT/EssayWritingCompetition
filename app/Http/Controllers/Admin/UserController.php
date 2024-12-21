<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::latest()->paginate(8);
        return view('admin.user.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 8);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::select('name')->where('guard_name', '=', 'web')->orderBy('name', 'ASC')->get();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(isset($request->role)){
            foreach($request->role as $role){
                $user->assignRole($role);
            }
        }

        return redirect('admin/user/create')->with('success', 'User Created.');
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
    public function edit(User $user)
    {
        $roles = Role::select('name')->where('guard_name', '=', 'web')->orderBy('name', 'ASC')->get();
        return view('admin.user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
        ]);
        $data = [
            'name' => $request->name,
        ];

        if($user->email != $request->email){
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
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


        return redirect('admin/user')->with('success', 'User Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('admin/user')->with('success','User Deleted.');
    }
}
