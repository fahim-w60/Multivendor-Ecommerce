<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;
use Carbon\Carbon;
use Image;

class IndexController extends Controller
{
    public function index()
    {
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2 = Product::where('status',1)->where('category_id',$skip_category_2->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category_3 = Category::skip(3)->first();
        $skip_product_3 = Product::where('status',1)->where('category_id',$skip_category_3->id)->orderBy('id','DESC')->limit(5)->get();

        $hot_deals = Product::where('status',1)->where('hot_deals',1)->where('discount_price','!=', NULL)->orderBy('id','ASC')->limit(3)->get();
        $special_offer = Product::where('status',1)->where('special_offer',1)->where('discount_price','!=',NULL)->orderBy('id','ASC')->limit(3)->get();
        $special_deal = Product::where('status',1)->where('special_deals',1)->where('discount_price','!=',NULL)->orderBy('id','ASC')->limit(3)->get();
        $recent = Product::where('status',1)->where('discount_price','!=', NULL)->orderBy('id','ASC')->limit(3)->get();

        return view('frontend.index',compact('skip_category_0','skip_product_0','skip_category_2','skip_product_2','skip_category_3','skip_product_3','hot_deals','special_offer','special_deal','recent'));
    }
    public function ProductDetails($id,$slug)
    {
        $product = Product::findOrfail($id);
        $images = MultiImg::where('product_id',$product
        ->id)->get();
        return view('frontend.product.product_details',compact('product','images'));
    }

    public function ProductViewAjax($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $product_color = $product->product_color;
        $color = explode(',',$product_color);
        $product_size = $product->product_size;
        $size = explode(',',$product_size);
        return response()->json(array(
            'product' => $product,
            'color' => $color,
            'size' => $size,
        ));


    }
}
