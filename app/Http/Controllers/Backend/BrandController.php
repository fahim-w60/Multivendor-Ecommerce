<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brandData = Brand::all();
        return view('backend.brand.brand_all',compact('brandData'));
    }
    public function AddBrand()
    {
        return view('backend.brand.add_brand');
    }
    public function StoreBrand(Request $request){

        $image = $request->file('brand_image');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$imageName);
        $url = 'upload/brand/'.$imageName;


        $data = new Brand();
        $data->brand_name = $request->brand_name;
        $data->brand_slug = strtolower(str_replace(' ','-',$request->brand_name));
        $data->brand_image = $url;
        $data->save();
        
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.brand')->with($notification);
    }
    public function EditBrand($id)
    {
        $brandData = Brand::find($id);
        return view('backend.brand.brand_edit',compact('brandData'));
    }
    public function UpdateBrand(Request $request){
        
        $brandId = $request->brand_id;
        $old_image = $request->old_image;
        if($request->file('brand_image'))
        {
            $image = $request->file('brand_image');
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$imageName);
            $url = 'upload/brand/'.$imageName;
            if(file_exists('old_image'))
            {
                unlink('old_image');
            }
            $data = Brand::find($brandId);
            $data->brand_name = $request->brand_name;
            $data->brand_slug = strtolower(str_replace(' ','-',$request->brand_name));
            $data->brand_image = $url;
            $data->save();
            
            $notification = array(
                'message' => 'Brand Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }
        else{
            $data = Brand::find($brandId);
            $data->brand_name = $request->brand_name;
            $data->brand_slug = strtolower(str_replace(' ','-',$request->brand_name));
           
            $data->save();
            
            $notification = array(
                'message' => 'Brand Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);

        }
        
    }
    public function DeleteBrand($id){
        $data = Brand::find($id);
        $img = $data->brand_image;
        unlink($img);
        $data->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
