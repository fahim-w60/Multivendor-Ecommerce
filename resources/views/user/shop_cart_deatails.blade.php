@extends('dashboard')

@section('vendor')
<div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                    <div class="d-flex justify-content-between">
                            @php
                                $cart = session()->get('cart');
                                if($cart)
                                {
                                    $num =  count($cart);
                                }
                            @endphp
                        <h6 class="text-body">There are <span class="text-brand">@php if($cart) { echo $num; } @endphp</span> products in your cart</h6>
                                
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="end">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            
                            @php
                            $cart = session()->get('cart');
                            $sub_total = 0;
                            if($cart)
                                {
                            @endphp
                            @foreach($cart as $item => $value)
                                @php
                                $product = App\Models\Product::where('id',$item)->latest()->first();
                                $price = $product->selling_price * $value;
                                $sub_total = $sub_total + $price;
                                @endphp
                                <tr class="pt-30">
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">{{$product->product_name}}</a></h6>
                                        
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body">{{$product->selling_price}}</h4>
                                    </td>
                                    <td class="" data-title="Stock">
                                        <h4 class="text-body">{{$value}}</h4>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">{{$price}}</h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a href="{{route('session.product.delete',['id'=>$product->id])}}" class="text-body"><i class="fi-rs-trash" style="margin-left:-130px;"></i></a></td>
                                </tr>
                            @endforeach
                            @php
                                }
                            @endphp
                              
                            </tbody>
                        </table>
                    </div>
                   



                        <div class="col-md-8 offset-md-2">
                             <div class="divider-2 mb-30"></div>
                     


                            <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{$sub_total}}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Shipping</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">Free</h4</td> </tr> <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Estimate for</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">Bangladesh</h4</td> </tr> <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{$sub_total}}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <a href="{{route('confirm.order')}}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                        </div>


                    
                    </div>
                </div>
                 
            </div>
        </div>
@endsection