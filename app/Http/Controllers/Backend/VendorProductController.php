<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Models\Subcategory;
use Auth;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;
use Carbon\Carbon;
use Image;
use DB;

class VendorProductController extends Controller
{
    public function VendorAllProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all',compact('products'));
    }
    
    public function VendorAddProduct()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('vendor.backend.product.vendor_product_add',compact('brands','categories'));
    }
    public function VendorGetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
            return json_encode($subcat);
    }
    public function VendorStoreProduct(Request $request){

        // $image = $request->file('product_thambnail');
        // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
        // $save_url = 'upload/products/thambnail/'.$name_gen;



        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.time().'.'.date('Y-m-d').'.'.$image->getClientOriginalExtension();
        // $name_gen = time().'.'.$image;
        Image::make($image->getRealPath())->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        

        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp, 

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals, 

            'product_thumbnail' => $save_url,
            'vendor_id' => Auth::user()->id,
            'status' => 1,
            'created_at' => Carbon::now(), 

        ]);

        /// Multiple Image Upload From here //////
        $images = $request->file('multi_img');
        foreach($images as $img){
        $directory = 'upload/products/multi_img/';
        $imageName = rand().date('Y-m-d').time().'_image.'.$img->getClientOriginalExtension();    
        
        $img->move($directory,$imageName);
        MultiImg::insert([

            'product_id' => $product_id,
            'photo_name' => $directory.$imageName,
            'created_at' => Carbon::now(), 

        ]); 
        } // end foreach

        /// End Multiple Image Upload From her //////

        $notification = array(
            'message' => 'Vendor Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification); 
    }
    public function VendorEditProduct($id){

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('vendor.backend.product.vendor_product_edit',compact('brands','categories', 'products','subcategory'));
    }// End Method 



    public function VendorUpdateProduct(Request $request){
            // return $request;

            // $product_id = Product::find($request->id);

            // if($request->has('product_thambnail'))
            // {
            //     unlink($product_id->product_thumbnail);   
  
            //     $directory = 'upload/products/thambnail/';
            //     $image = $request->file('product_thambnail');  
            //     $imageName = rand().date('Y-m-d').time().'_image.'.$image->getClientOriginalExtension();         
            //     $save_url = $directory.$imageName;
            //     $image->move($directory,$imageName);
            // }

        $product_id = $request->id;
        $product = Product::findOrFail($product_id);
        
        if($request->product_thumbnail)
        {
            //dd($request->product_thumbnail);
            if($product->product_thumbnail!=null)
            {
                unlink($product->product_thumbnail);
            }

            $image = $request->file('product_thumbnail');

            $name_gen = hexdec(uniqid()).'.'.time().'.'.date('Y-m-d').'.'.$image->getClientOriginalExtension();
            // $name_gen = time().'.'.$image;
            Image::make($image->getRealPath())->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
            $save_url = 'upload/products/thambnail/'.$name_gen;

            Product::findOrFail($product_id)->update([
                'product_thumbnail' => $save_url,
            ]);
            //dd(save_url);
        }
      
            Product::where('id',$product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp, 
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,  
            'status' => 1,
            
        ]);

        
        /// Multiple Image Edit From here //////
        
    //     $products = MultiImg::where('product_id',$request->id)->latest()->get();
    //   // dd($products);
        
    //     if($request->has('multi_img')) 
    //     {   
    //         foreach($products as $product)
    //         {
    //             // unlink($product->photo_name);
    //         } 
    //         $images = $request->file('multi_img');
    //         foreach($images as $img){
    //        dd($images);
    //         $directory = 'upload/products/multi_img/';
    //         $imageName = rand().date('Y-m-d').time().'_image.'.$img->getClientOriginalExtension();    
    //         $img->move($directory,$imageName);
          
    //         MultiImg::where('product_id',$product_id)->update([
    //             'photo_name' => $directory.$imageName, 
    //         ]);
         
    //         } // end foreach
    //     }
    //         $imgs = $request->multi_img;
    //         foreach($imgs as $id => $img) {
    //         $imgDel = MultiImg::findOrFail($id);
    //         dd($imgDel);
    //         unlink($imgDel->photo_name);
            
    //         $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    //         Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
    //         $uploadPath = 'upload/products/multi-image/'.$make_name;
    //         MultiImg::where('id',$id)->update([
    //             'photo_name' => $uploadPath,
    //             'updated_at' => Carbon::now(),
    //         ]);        
    //     /// End Multiple Image Edited From here //////

    // } 
    $images = $request->file('multi_img');


    if($request->multi_img){
        $multiImages = MultiImg::where('product_id',$product_id)->get();
        foreach($multiImages as $multiImage)
        {
            $data = MultiImg::find($multiImage->id);
             unlink($multiImage->photo_name);
            $data->delete();
        }
        foreach($images as $image){

            $make_name = hexdec(uniqid()).'.'.time().'.'.date('Y-m-d').'.'.$image->getClientOriginalExtension();
            Image::make($image->getRealPath())->resize(800,800)->save('upload/products/multi_img/'.$make_name);
            // Image::make($image->getRealPath())->resize(800,800)->save('upload/products/thambnail/'.$name_gen);
            $uploadPath = 'upload/products/multi_img/'.$make_name;

        MultiImg::insert([

            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);
        } // end foreach
    }
        $notification = array(
            'message' => 'Vendor Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);
}

    public function DeleteVendorProduct($id)
    {
        // $data = Product::find($id);
        // $data->delete();

        $product = Product::findOrFail($id);
        $images = MultiImg::where('product_id',$id)->get();
        foreach($images as $image)
        {
            $data = MultiImg::find($image->id);
            unlink($image->photo_name);
            $data->delete();
        }
        unlink($product->product_thumbnail);
        $product->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.all.product')->with($notification);
    }
    public function vendorInactiveProduct($id)
    {
        Product::findOrfail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactivated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.all.product')->with($notification);
    }
    public function vendorActiveProduct($id)
    {
        Product::findOrfail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Activated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.all.product')->with($notification);
    }
}
