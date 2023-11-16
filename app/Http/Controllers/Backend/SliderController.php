<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = Slider::all();
        return view('backend.slider.slider_all',compact('sliders'));
    }

    public function AddSlider()
    {
        return view('backend.slider.add_slider');
    }

    public function StoreSlider(Request $request){


        $image = $request->file('slider_image');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('upload/slider/'.$imageName);
        $url = 'upload/slider/'.$imageName;


        $data = new Slider();
        $data->slider_title = $request->slider_title;
        $data->short_title = $request->short_title;
        $data->slider_image = $url;
        $data->save();
        
        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.slider')->with($notification);
    }

}
