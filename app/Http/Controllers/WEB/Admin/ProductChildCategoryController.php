<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\PopularCategory;
use App\Models\ThreeColumnCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportChildCategory;
use Image;
use File;
use Str;

class ProductChildCategoryController extends Controller
{


    public function index()
    {

  		if(!auth()->user()->can('product-child-category.index')){
            abort(403, 'Unauthorized action.');
        }

        $childCategories=ChildCategory::with('subCategory','category','products')->get();

        return view('admin.product_child_category',compact('childCategories'));
    }


    public function create()
    {
      if(!auth()->user()->can('product-child-category.create')){
            abort(403, 'Unauthorized action.');
        }
        $categories=Category::all();
        $SubCategories=SubCategory::all();
        return view('admin.create_product_child_category',compact('categories','SubCategories'));
    }

    public function getSubcategoryByCategory($id){

        $subCategories=SubCategory::where('category_id',$id)->get();
        $response="<option value=''>".trans('admin_validation.Select sub category')."</option>";
        foreach($subCategories as $subCategory){
            $response .= "<option value=".$subCategory->id.">".$subCategory->name."</option>";
        }
        return response()->json(['subCategories'=>$response]);
    }

    public function getChildcategoryBySubCategory($id){
        $childCategories=ChildCategory::where('sub_category_id',$id)->get();
        $response='<option value="">'.trans('admin_validation.Select Child Category').'</option>';
        foreach($childCategories as $childCategory){
            $response .= "<option value=".$childCategory->id.">".$childCategory->name."</option>";
        }
        return response()->json(['childCategories'=>$response]);
    }



    public function store(Request $request)
    {
      if(!auth()->user()->can('product-child-category.store')){
            abort(403, 'Unauthorized action.');
        }

        $rules = [
            'name'=>'required',
            'category'=>'required',
            'sub_category'=>'required',
            'slug'=>'required|unique:child_categories',
            'status'=>'required'
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'category.required' => trans('admin_validation.Category is required'),
            'sub_category.required' => trans('admin_validation.Sub category is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $childCategory = new ChildCategory();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $category_image = 'child-category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $category_image = 'uploads/custom-images/'.$category_image;
            Image::make($request->image)
                ->save(public_path().'/'.$category_image);
            $childCategory->image = $category_image;
        }

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = $request->slug;
        $childCategory->status = $request->status;
        $childCategory->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-child-category.index')->with($notification);
    }


    public function show($id){

      if(!auth()->user()->can('product-child-category.show')){
            abort(403, 'Unauthorized action.');
        }


        $childCategory = ChildCategory::find($id);
        return response()->json(['childCategory' => $childCategory],200);
    }

    public function edit($id)
    {
      if(!auth()->user()->can('product-child-category.edit')){
            abort(403, 'Unauthorized action.');
        }

        $childCategory = ChildCategory::find($id);
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id',$childCategory->category_id)->get();
        return view('admin.edit_product_child_category',compact('childCategory','categories','subCategories'));
    }


    public function update(Request $request, $id)
    {
      if(!auth()->user()->can('product-child-category.update')){
            abort(403, 'Unauthorized action.');
        }

        $childCategory = ChildCategory::find($id);
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'slug' => 'required|unique:child_categories,slug,'.$childCategory->id,
            'status' => 'required',

        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'category.required' => trans('admin_validation.Category is required'),
            'sub_category.required' => trans('admin_validation.Sub category is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        if($request->image){
            $existing_image = $childCategory->image;
            $extention = $request->image->getClientOriginalExtension();
            $category_image = 'child-category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $category_image = 'uploads/custom-images/'.$category_image;
            Image::make($request->image)
                ->save(public_path().'/'.$category_image);
            $childCategory->image = $category_image;
            $childCategory->save();

            if($existing_image){
                if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
            }

        }

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = $request->slug;
        $childCategory->status = $request->status;
        $childCategory->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-child-category.index')->with($notification);
    }


    public function destroy($id)
    {
      if(!auth()->user()->can('product-child-category.delete')){
            abort(403, 'Unauthorized action.');
        }

        $childCategory = ChildCategory::find($id);
        $childCategory->delete();
        $notification = trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-child-category.index')->with($notification);
    }

    public function changeStatus($id){
      if(!auth()->user()->can('product-child-category.changeStatus')){
            abort(403, 'Unauthorized action.');
        }
        $childCategory = ChildCategory::find($id);
        if($childCategory->status==1){
            $childCategory->status=0;
            $childCategory->save();
            $message = trans('admin_validation.InActive Successfully');
        }else{
            $childCategory->status=1;
            $childCategory->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function importchildCategory(Request $request){

        Excel::import(new ImportChildCategory,
                      $request->file('file'));
        return redirect()->back();

    }
}
