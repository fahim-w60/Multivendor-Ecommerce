@extends('vendor.vendor-dashboard')
@section('title')
	Vendor All Product
@endsection
@section('vendor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tables</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item">
            <a href="javascript:;">
              <i class="bx bx-home-alt"></i>
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Data Table</li>
          
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        
        <a href="{{route('add.vendor.product')}}" class="btn btn-primary">Add Vendor Product</a>
      </div>
    </div>
  </div>
  <!--end breadcrumb-->
  
  <h6 class="breadcrumb-item active" aria-current="page">Vendor All Product  <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span> </h6>
  <hr />
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Sl</th>
              <th>Image</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Discount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody> 
            @foreach($products as $key => $item) 
            {
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img src="{{asset($item->product_thumbnail)}}" style="width:70px; height:40px;" alt=""></td>
                   <td>{{$item->product_name}}</td>
                   <td>{{$item->selling_price}}</td>
                   <td>{{$item->product_qty}}</td>
                   <td>{{$item->discount_price}}</td>
                   <td>
                      @if($item->status == 1)
                          <span class="badge rounded-pill bg-success">Active</span>
                      @elseif($item->status == 0)
                          <span class="badge rounded-pill bg-danger">InActive</span>
                      @endif
                  </td>
                    <td class="d-flex">
                    <a href="{{route('vendor.edit.product',$item->id)}}" class="btn btn-info" title="Edit Data"> <i class="fa fa-pencil"></i> </a>

                    <a href="{{route('vendor.delete.product',$item->id)}}" class="btn btn-danger" id="delete" title="Delete Data" ><i class="fa fa-trash"></i></a>

                    @if($item->status == 1)
                        <a href="{{ route('vendor.product.inactive',$item->id) }}" class="btn btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-down"></i> </a>
                    @else
                        <a href="{{ route('vendor.product.active',$item->id) }}" class="btn btn-primary" title="Active"> <i class="fa-solid fa-thumbs-up"></i> </a>
                    @endif

                  </td>
                </tr>
            }
            @endforeach
             
        
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection