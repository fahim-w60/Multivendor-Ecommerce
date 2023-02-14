<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order1;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
   
    public function AddToCart(Request $request)
    {
        $products = Product::findOrFail($request->product_id);
        $cart = session()->get('cart');
        $cart[$products->id]=$request->qntity;
        session()->put('cart',$cart);
        $notification = array(
            'message' => 'Product Add In Cart Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification); 
    }
    public function UserCartDetails(){
        return view('user.shop_cart_deatails');
    }
    public function SessionProductDelete($id)
    {
       $product = session()->get('cart');
        unset($product[$id]);
        Session::put('cart', $product);
        $notification = array(
            'message' => 'Remove From Cart Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    public function ConfirmOrder()
    {
        $product = session()->get('cart');
        $count=0;
        foreach($product as $item => $pro)
        {
            $count++;
            $data = new Order1();
            $pro_details = Product::where('id',$item)->latest()->first();
            $data->user_id = Auth::user()->id;
            $data->product_id = $item;
            $data->quantity = $pro;
            $data->vendor_id = $pro_details->vendor_id;
            
            $data->total_amount = $pro*$pro_details->selling_price;
            $data->discount_amount = $pro*$pro_details->discount_price;
            $data->save();
            
        }
      
        Session::forget('cart');
        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
        
    }
}
