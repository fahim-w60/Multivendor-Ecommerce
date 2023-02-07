@extends('admin.admin-dashboard')
@section('title')
	All Subcaategory
@endsection
@section('admin')
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
        
        <a href="{{route('add.subcategory')}}" class="btn btn-primary">Add Subcategory</a>
      </div>
    </div>
  </div>
  <!--end breadcrumb-->
  <h6 class="mb-0 text-uppercase">All Subcategory</h6>
  <hr />
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Sl</th>
              <th>Category Name</th>
              <th>Subcategory name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody> 
            @foreach($subcategoryData as $key => $item) 
            {
                <tr>
                    
                    <td>{{$key+1}}</td>
                    
                    @if($item['category']['category_name'])
                    <td>{{$item['category']['category_name']}}</td>
                    @else
                    <td></td>
                    @endif
                    <td>
                        {{$item->subcategory_name}}
                    </td>
                    <td class="d-flex">
                        <a href="{{route('edit.subcategory',['id' => $item->id])}}" class="btn btn-info mx-2">Edit</a>
                        <a href="{{route('delete.subcategory',['id' => $item->id])}}" class="btn btn-danger" id="delete">Delete</a>
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