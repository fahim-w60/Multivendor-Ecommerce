<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard(){
        
        $id = Auth::user()->id;
        $userData = User::find($id);
       
        return view('index',compact('userData'));
    }
    public function UserProfileStore(Request $request)
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
            @unlink(public_path('upload/user_images'.$data->photo));
            $imageName = date('YmdHi').$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('upload/user_images'),$imageName);
            $data->photo = $imageName;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function UserLogout(Request $request): RedirectResponse
    {
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect(route('login'))->with($notification);
    }
    public function UserUpdatePassword(Request $request)
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
    public function VendorDetailsForUser($id)
    {
        $product = Product::where('vendor_id',$id)->latest()->get();
        $pro = count($product);
        $vendor = User::where('id',$id)->where('role','vendor')->latest()->first();
        
        return view('vendor.frontend.vendor_details',compact('product','pro','vendor'));
    }
}
