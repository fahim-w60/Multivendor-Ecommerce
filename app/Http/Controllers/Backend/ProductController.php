<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $productData = Product::all();
        return view('backend.product.product_all',compact('productData'));
    }


    public function AddProduct()
    {
        $brands = Brand::all();
        $categories = Category::all();


        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.product.product_add',compact('brands','categories','activeVendor'));
    }


    public function StoreProduct(Request $request){

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
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        // Multiple Image Upload From here //

        // dd($product_id);
        $images = $request->file('multi_img');

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

        /// End Multiple Image Upload From her //////

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);

    }


    // End Method


    public function EditProduct($id){
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
         $brands = Brand::latest()->get();
         $categories = Category::latest()->get();
         $subcategory = SubCategory::latest()->get();
         $products = Product::findOrFail($id);
         return view('backend.product.product_edit',compact('brands','categories','activeVendor','products','subcategory'));
     }
     
     // End Method


     public function UpdateProduct(Request $request){


        $product_id = $request->id;
        $product = Product::findOrFail($product_id);
        if($request->product_thumbnail)
        {
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

        }


        Product::findOrFail($product_id)->update([

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


       'vendor_id' => $request->vendor_id,
       'status' => 1,
       'updated_at' => Carbon::now(),
   ]);

           // Multiple Image Updated From here //



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
       'message' => 'Product Updated Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('all.product')->with($notification);

}// End Method


    public function deleteProduct($id)
    {
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

        return redirect()->route('all.product')->with($notification);
    }
}


