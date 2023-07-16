<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('index',compact('userData'));
    }
    public function userProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if($request->file('photo'))
        {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$user->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();

        $notification = array(
            "message" => "User Profile Updated Successfully",
            "alert-type" => "success",
        );

        return redirect()->back()->with($notification);

    }
    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            "message" => "User Logout Successfully",
            "alert-type" => "success",
        );
        return redirect('/login')->with($notification);
    }
    public function userUpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->current_password, auth::user()->password))
        {
            return back()->with('error', 'Invalid password');
        }

        // password updated

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('status', 'Password Updated Successfully');

    }
}
