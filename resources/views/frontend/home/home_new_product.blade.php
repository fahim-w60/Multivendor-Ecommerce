@php
$products = App\Models\Product::where('status', 1)->orderBy('id', 'ASC')->limit(10)->get();
$categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
@endphp

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>New Products</h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                        type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @foreach ($categories as $category)
                <li class="nav-item" role="presentation">
                    {{-- <a class="nav-link" href="#category{{ $category->id }}" role="tab" aria-controls="tab-two"
                        aria-selected="false">{{ $category->category_name }}</a> --}}
                        <a class="nav-link" data-bs-toggle="tab" href="#category{{ $category->id }}" role="tab" aria-controls="category{{ $category->id }}" aria-selected="false">{{ $category->category_name }}</a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-5">
                    @foreach ($products as $item)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="{{ asset($item->product_thumbnail) }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$item->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>
                                @php
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = ($amount/$item->selling_price)*100;
                                @endphp
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($item->discount_price == NULL)
                                    <span class="new">New</span>
                                    @else
                                    <span class="hot">{{ round($discount) }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
                                </div>
                                <h2><a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                @if ($item->vendor_id == NULL)
                                    <div>
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                    </div>
                                    @else
                                    <div>
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
                                    </div>
                                    @endif
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            @if ($item->discount_price == NULL)
                                            <span>{{ $item->selling_price }}</span>
                                            @else
                                            <span>{{ $item->selling_price }}</span>
                                            <span class="old-price">{{ $item->discount_price }}</span>
                                            @endif
                                        </div>
                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                </div>
            </div>
            @foreach ($categories as $category)
             <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="category{{ $category->id }}">
                <div class="row product-grid-4">
                    @php
                    $catwiseProducts = App\Models\Product::where('category_id', $category->id)
                        ->orderBy('id', 'DESC')
                        ->get();
                    @endphp
                    @if (count($catwiseProducts) > 0)
                    @foreach ($catwiseProducts as $item)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <img class="default-img" src="{{ asset($item->product_thumbnail) }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                @php
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = ($amount/$item->selling_price)*100;
                                @endphp
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($item->discount_price == NULL)
                                    <span class="new">New</span>
                                    @else
                                    <span class="hot">{{ round($discount) }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $item['category']['category_name'] }}</a>
                                </div>
                                <h2><a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                @if ($item->vendor_id == NULL)
                                    <div>
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                    </div>
                                    @else
                                    <div>
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
                                    </div>
                                    @endif
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            @if ($item->discount_price == NULL)
                                            <span>{{ $item->selling_price }}</span>
                                            @else
                                            <span>{{ $item->selling_price }}</span>
                                            <span class="old-price">{{ $item->discount_price }}</span>
                                            @endif
                                        </div>
                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col-12">
                        <h5 class="text-danger">No Product Found</h5>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
