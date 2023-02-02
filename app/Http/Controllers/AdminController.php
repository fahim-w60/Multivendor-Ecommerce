<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        
        return view('admin.index');
    }
    public function AdminDestroy(Request $request): RedirectResponse
    {
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }
    public function AdminLogin()
    {
        return view('admin.admin-login');
    }
    public function AdminProfile(){
        
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin-profile',compact('adminData'));
    }
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if($request->file('photo'))
        {
            $image = $request->file('photo');
            @unlink(public_path('upload/admin_images'.$data->photo));
            $imageName = date('YmdHi').$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('upload/admin_images'),$imageName);
            $data->photo = $imageName;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }
    public function AdminChangePassword()
    {
        return view('admin.admin-change-password');
    }
    public function AdminUpdatePassword(Request $request)
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
