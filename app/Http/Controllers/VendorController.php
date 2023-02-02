<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        
        return view('vendor.index');
    }
    public function Vendor_Login()
    {
        return view('vendor.vendor-login');
    }
    public function VendorDestroy(Request $request): RedirectResponse
    {
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('vendor.login'));
    }
    public function VendorProfile(){
        
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        return view('vendor.vendor-profile',compact('vendorData'));
    }
    public function VendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;
        if($request->file('photo'))
        {
            $image = $request->file('photo');
            @unlink(public_path('upload/vendor_images'.$data->photo));
            $imageName = date('YmdHi').$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('upload/vendor_images'),$imageName);
            $data->photo = $imageName;
        }
        $data->save();

        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }
    public function VendorChangePassword()
    {
        return view('vendor.vendor-change-password');
    }
    public function VendorUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);

        if(!Hash::check($request->old_password,Auth::user()->password))
        {
            return back()->with("error","Old Password Doesn`t Match");
        }

        if($request->new_password_confirmation!=$request->new_password)
        {
            return back()->with("error","New Password Is Not Matching");
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        return back()->with("status","Password Changed Successfully");

    }
}
