<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PopularCategory;
use App\Models\ThreeColumnCategory;
use App\Models\MegaMenuSubCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSubCategory;
use App\Exports\ExportSubCategory;
use Image;
use File;
use Str;

class ProductSubCategoryController extends Controller
{


    public function index()
    {
        $subCategories=SubCategory::with('category','childCategories','products')->get();

        return view('admin.product_sub_category',compact('subCategories'));
    }


    public function create()
    {
        $categories=Category::all();
        return view('admin.create_product_sub_category',compact('categories'));
    }


    public function store(Request $request)
    {
        $rules = [
            'name'=>'required',
            'slug'=>'required|unique:sub_categories',
            'category'=>'required',
            'status'=>'required',
            'image'=> ''
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'category.required' => trans('admin_validation.Category is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $subCategory = new SubCategory();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $category_image = 'sub-category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $category_image = 'uploads/custom-images/'.$category_image;
            Image::make($request->image)
                ->save(public_path().'/'.$category_image);
            $subCategory->image = $category_image;
        }

        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = $request->slug;
        $subCategory->status = $request->status;
        $subCategory->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-sub-category.index')->with($notification);
    }

    public function show($id){
        $subCategory = SubCategory::find($id);
        return response()->json(['subCategory' => $subCategory],200);
    }

    public function edit($id)
    {
        $subCategory = SubCategory::find($id);
        $categories=Category::all();
        return view('admin.edit_product_sub_category',compact('subCategory','categories'));
    }


    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::find($id);
        $rules = [
            'name'=>'required',
            'slug'=>'required|unique:sub_categories,slug,'.$subCategory->id,
            'category'=>'required',
            'status'=>'required'
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'category.required' => trans('admin_validation.Category is required'),
        ];
        $this->validate($request, $rules,$customMessages);
        if($request->image){
            $existing_image = $subCategory->image;
            $extention = $request->image->getClientOriginalExtension();
            $category_image = 'sub-category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $category_image = 'uploads/custom-images/'.$category_image;
            Image::make($request->image)
                ->save(public_path().'/'.$category_image);
            $subCategory->image = $category_image;
            $subCategory->save();

            if($existing_image){
                if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
            }

        }
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = $request->slug;
        $subCategory->status = $request->status;
        $subCategory->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-sub-category.index')->with($notification);
    }


    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        MegaMenuSubCategory::where('sub_category_id',$id)->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-sub-category.index')->with($notification);
    }

    public function changeStatus($id){
        $subCategory = SubCategory::find($id);
        if($subCategory->status==1){
            $subCategory->status=0;
            $subCategory->save();
            $message = trans('admin_validation.InActive Successfully');
        }else{
            $subCategory->status=1;
            $subCategory->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function exportSubCategory(Request $request){
        return Excel::download(new ExportSubCategory, 'subCategory.xlsx');
    }


    public function importSubCategory(Request $request){

        Excel::import(new ImportSubCategory,
                      $request->file('file'));
        return redirect()->back();

    }



}
