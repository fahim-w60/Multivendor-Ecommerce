{{-- <div class="modal fade custom-modal" id="quickViewModal_{{$p->id}}" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">


                                <!-- MAIN SLIDES -->

                                <!-- THUMBNAILS -->
        <div class="slider-nav-thumbnails">
            <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-3.jpg') }}" alt="product image" /></div>
            <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-4.jpg') }}" alt="product image" /></div>
            <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-5.jpg') }}" alt="product image" /></div>
            <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-6.jpg') }}" alt="product image" /></div>
            <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-7.jpg') }}" alt="product image" /></div>
            <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-8.jpg') }}" alt="product image" /></div>
            <div><img src="{{ asset('frontend/assets/imgs/shop/thumbnail-9.jpg') }}" alt="product image" /></div>
        </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">

                            <h5 class="title-detail"><a href=" " class="text-heading" id="pname">{{$p->product_name}}</a></h5>

<div class="attr-detail attr-size mb-30"  id="sizeArea">
        <strong class="mr-10" style="width:60px;">Size : </strong>
        <select class="form-control unicase-form-control" id="size" name="size">
        @php
            $sizes = explode(',',$p->product_size);
        @endphp

        @foreach($sizes as $size)
            <option>{{$size}}</option>
        @endforeach
        </select>
</div>
<div class="attr-detail attr-size mb-30" id="colorArea">
 <strong class="mr-10" style="width:60px;">Color : </strong>
 <select class="form-control unicase-form-control" id="color" name="color">

    @php
    $colors = explode(',',$p->product_color);
    @endphp

        @foreach($colors as $color)
            <option>{{$color}}</option>
        @endforeach


</select>

</div>
@php
$price = $p->selling_price-$p->discount_price;
$brand_id = $p->brand_id;
$brand = App\Models\Brand::where('id',$brand_id)->latest()->first();
$category = App\Models\Category::where('id',$p->category_id)->latest()->first();
@endphp

                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand" id="pprice">{{$price}}</span>
                                        <span>
                                            <span class="old-price font-md ml-15" id="oldprice">{{$p->selling_price}}</span>
                                        </span>
                                    </div>
                                </div>

                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="qty" id="qty_{{$p->id}}" class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>

                                    <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart" data-productId="{{$p->id}}" onclick="addToCart('{{$p->id}}')"><i class="fi-rs-shopping-cart"></i>Add to cart</button>

                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul>
                                        <li class="mb-5">Brand: <span class="text-brand" id="pbrand">{{$brand->brand_name}}</span></li>
                                        <li class="mb-5">Category:<span class="text-brand" id="pcategory">{{$category->category_name}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
