<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('admin.profile.index', compact('user', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $user = Auth::user();
        $user_model = User::where('id', $user->id)->first();
        $profile = Profile::where('user_id', $user->id)->first();

        if(isset($request->name)){
            $request->validate([
                'name'      => ['string', 'max:255'],
            ]);
            $userdata = [
                'name' => $request->name,
            ];
            
            $user_model->update($userdata);
        }

        if(isset($request->avatar)){

            if(isset($profile->avatar)){
                File::delete(public_path('assets/img/avatars/'). $profile->avatar);
                File::delete(public_path('assets/img/avatars/thumbnail/'). $profile->avatar);
            }

            $request->validate([
                'avatar'      => ['image'],
            ]);

            $image = $request->avatar;
            $ext = $image->getClientOriginalExtension();
            $imagename = $user->id.'_'.time().'_'.fake()->randomNumber().'.'.$ext;
            $image->move(public_path('assets/img/avatars/'), $imagename);

            $profileavatar = [
                'avatar' => $imagename,
            ];

            if(isset($profile->id)){
                $profile->update($profileavatar);
            }else{
                $profileavatar += [
                    'user_id' => $user->id,
                ];
                Profile::create($profileavatar);
            }

            $manager = new ImageManager(Driver::class);
            $profile_image = $manager->read(public_path('assets/img/avatars/').$imagename);
            $profile_image->cover(200, 200);
            $profile_image->save(public_path('assets/img/avatars/thumbnail/').$imagename);
        }

        if(isset($request->street1)){
            $request->validate([
                'street1'   => 'string'
            ]);
            
            $address = $request->street1;
        }

        if(isset($request->street2)){
            $request->validate([
                'street2'   => 'string'
            ]);

            $address .= '|'.$request->street2;
        }

        if(!empty($address)){
            $profile_data['street'] = $address;
        }

        if(isset($request->gender)){
            $request->validate([
                'gender'   => 'string'
            ]);

            $profile_data['gender'] = $request->gender;
        }

        if(isset($request->city)){
            $request->validate([
                'city'   => 'string'
            ]);

            $profile_data['city'] = $request->city;
        }
        if(isset($request->state)){
            $request->validate([
                'state'   => 'string'
            ]);

            $profile_data['state'] = $request->state;
        }
        if(isset($request->zipcode)){
            $request->validate([
                'zipcode'   => 'string|max:6|min:6'
            ]);

            $profile_data['zip_code'] = $request->zipcode;
        }

        // dd($profile_data);
        if(isset($profile->id)){
            $profile->update($profile_data);
        }else{
            Profile::create($profile_data);
        }


        return redirect()->route('admin.profile')->with('success','Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();

        $user = Auth::user();
        $user_model = User::where('id', $user->id)->first();
        $user_model->delete();

        return redirect()->route('admin.profile')->with('success','Profile Deleted');
    }
}
