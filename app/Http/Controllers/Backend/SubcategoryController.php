<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Image;


class SubcategoryController extends Controller
{
    public function AllSubCategory()
    {
        $subcategoryData = Subcategory::all();
        return view('backend.subcategory.subcategory_all',compact('subcategoryData'));
    }
    public function AddSubCategory()
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        return view('backend.subcategory.add_subcategory',compact('categories'));
    }
    public function StoreSubCategory(Request $request){
        $data = new Subcategory();
        $data->category_id = $request->category_id;
        $data->subcategory_name = $request->subcategory_name;
        $data->subcategory_slug = strtolower(str_replace(' ','-',$request->subcategory_name));
        $data->save();
        
        $notification = array(
            'message' => 'Sub Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.subcategory')->with($notification);
    }
    public function EditSubCategory($id)
    {
        $subcategoryData = Subcategory::find($id);
        $categories = Category::all();
        return view('backend.subcategory.subcategory_edit',compact('subcategoryData','categories'));
    }
    public function UpdateSubCategory(Request $request){
            $data = Subcategory::find($request->subcategory_id);
            $data->category_id = $request->category_id;
            $data->subcategory_name = $request->subcategory_name;
            $data->subcategory_slug = strtolower(str_replace(' ','-',$request->category_slug));       
            $data->save();
            $notification = array(
                'message' => 'Sub Category Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.subcategory')->with($notification);
    }  
    public function DeleteSubCategory($id){
        $data = Subcategory::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}