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
        
        $subcategorie = Subcategory::all();
        $activeVendor = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('backend.product.product_add',compact('brands','categories','subcategorie','activeVendor'));
    }
}
