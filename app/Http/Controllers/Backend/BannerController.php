<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{
    public function AllBanner()
    {
        $banners = Banner::all();
        return view('backend.banner.banner_all',compact('banners'));
    }
    public function AddBanner()
    {
        return view('backend.banner.add_banner');
    }

    public function StoreBanner(Request $request){


        $image = $request->file('banner_image');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$imageName);
        $url = 'upload/banner/'.$imageName;


        $data = new Banner();
        $data->banner_title = $request->banner_title;
        $data->banner_url = $request->banner_url;
        $data->banner_image = $url;
        $data->save();
        
        $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.banner')->with($notification);
    }
}
