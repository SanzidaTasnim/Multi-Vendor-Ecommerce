<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function vendorDashboard()
    {
        return view('vendor.index');
    }
    public function vendorLogin()
    {
        return view('vendor.vendor_login');
    }
    public function vendorLogout(Request $request)
    {
        $notification = array(
            "message" => "Vendor Profile Logout Successfully",
            "alert-type" => "success",
        );
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('vendor/login')->with($notification);
    }
    public function vendorProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('vendor.vendor_profile_view',compact('user'));
    }
    public function vendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->vendor_join_date = $request->vendor_join_date;
        $user->vendor_info = $request->vendor_info;

        if($request->file('photo'))
        {
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/'.$user->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();

        $notification = array(
            "message" => "Vendor Profile Updated Successfully",
            "alert-type" => "success",
        );

        return redirect()->back()->with($notification);

    }
    public function vendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    }
    public function vendorUpdatePassword(Request $request)
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
