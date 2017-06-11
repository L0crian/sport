<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class ProfilesController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profiles.show', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',
        ]);
        $user = Auth::user();
        if($request->hasFile('avatar'))
        {
            $avatar = $request->avatar;
            $avatar_new_name = time() . $avatar->getClientOriginalName();
            $avatar->move('avatars', $avatar_new_name);
            $user->avatar = 'avatars/' . $avatar_new_name ;
            $user->save();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->save();
        if($request->has('password'))
        {
            $user->password = bcrypt($request->password);

            $user->save();
        }
        Session::flash('success', 'Account profile updated.');
        return redirect()->back();
    }


}
