<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categoryData = Category::all();
        return view('backend.category.category_all',compact('categoryData'));
    }
    public function AddCategory()
    {
        return view('backend.category.add_category');
    }
    public function StoreCategory(Request $request){

        $image = $request->file('category_image');
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/category_images/'.$imageName);
        $url = 'upload/category_images/'.$imageName;


        $data = new Category();
        $data->category_name = $request->category_name;
        $data->category_slug = strtolower(str_replace(' ','-',$request->category_name));
        $data->category_image = $url;
        $data->save();
        
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.category')->with($notification);
    }
    public function EditCategory($id)
    {
        $categoryData = Category::find($id);
        return view('backend.category.category_edit',compact('categoryData'));
    }
    public function UpdateCategory(Request $request){
        
        $categoryId = $request->category_id;
        $old_image = $request->old_image;
        if($request->file('category_image'))
        {
            $image = $request->file('category_image');
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/category_images/'.$imageName);
            $url = 'upload/category_images/'.$imageName;
            if(file_exists('old_image'))
            {
                unlink('old_image');
            }
            $data = Category::find($categoryId);
            $data->category_name = $request->category_name;
            $data->category_slug = strtolower(str_replace(' ','-',$request->category_slug));
            $data->category_image = $url;
            $data->save();
            
            $notification = array(
                'message' => 'Category Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        }
        else{
            $data = Category::find($categoryId);
            $data->category_name = $request->category_name;
            $data->category_slug = strtolower(str_replace(' ','-',$request->category_name));
           
            $data->save();
            
            $notification = array(
                'message' => 'Category Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);

        }
        
    }
    public function DeleteCategory($id){
        $data = Category::find($id);
        $img = $data->category_image;
        unlink($img);
        $data->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
