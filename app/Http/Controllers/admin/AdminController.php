<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.index');
    }
    public function adminLogin()
    {
        return view('admin.admin_login');
    }
    public function adminLogout(Request $request)
    {
        $notification = array(
            "message" => "Admin Profile Logout Successfully",
            "alert-type" => "success",
        );
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login')->with($notification);
    }
    public function adminProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('admin.admin_profile_view',compact('user'));
    }
    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if($request->file('photo'))
        {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$user->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();

        $notification = array(
            "message" => "Admin Profile Updated Successfully",
            "alert-type" => "success",
        );

        return redirect()->back()->with($notification);

    }
    public function adminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function adminUpdatePassword(Request $request)
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
