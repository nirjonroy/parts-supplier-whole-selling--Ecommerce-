<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PopularCategory;
use App\Models\FeaturedCategory;
use App\Models\MegaMenuSubCategory;
use App\Models\MegaMenuCategory;
use Illuminate\Http\Request;
use Image;
use File;
use Str;
class ProductCategoryController extends Controller
{
    

    public function index()
    {
      	
        if(!auth()->user()->can('productcategory.index')){
            abort(403, 'Unauthorized action.');
        }  
        $categories = Category::with('subCategories','products')->latest()->get();


        return view('admin.product_category',compact('categories'));

    }


    public function create()
    {
      if(!auth()->user()->can('product-category-create')){
            abort(403, 'Unauthorized action.');
        }  
      
        return view('admin.create_product_category');
    }


    public function store(Request $request)
    {
        
       if(!auth()->user()->can('productCategory.store')){
            abort(403, 'Unauthorized action.');
        }  
        
        $rules = [
            'name'=>'required|unique:categories',
            'slug'=>'required|unique:categories',
            'status'=>'required',
            'icon'=>'',
          	'serial'=>'',
            'image'=>'',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            
        ];
        $this->validate($request, $rules,$customMessages);

        $category = new Category();
      
       
      	if($request->image){
            $image = Image::make($request->file('image'));
            $extention = $request->image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;


            $destation_path1 = 'uploads/custom-images/'.$image_name; 
            $image->resize(800,800);
            $image->save(public_path().'/'.$destation_path1);   

            // For Main Image
            $destation_path = 'uploads/custom-images2/'.$image_name;            
            $image->resize(48,48);
            $image->save(public_path().'/'.$destation_path);   
            //$product->thumb_image=$image_name;    
          	$category->image = $image_name;
        }
      
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->icon = $request->icon;
      	$category->serial = $request->serial;
        $category->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-category.index')->with($notification);
    }


    public function show($id){
      	if(!auth()->user()->can('productCategory.show')){
            abort(403, 'Unauthorized action.');
        }  
      
        $category = Category::find($id);
        return response()->json(['category' => $category],200);
    }

    public function edit($id)
    {
      if(!auth()->user()->can('productCategory.edit')){
            abort(403, 'Unauthorized action.');
        }  
      
        $category = Category::find($id);
        return view('admin.edit_product_category',compact('category'));
    }


    public function update(Request $request,$id)
    {
      if(!auth()->user()->can('productCategory.update')){
            abort(403, 'Unauthorized action.');
        }  
      
        $category = Category::find($id);
        $rules = [
            'name'=>'required|unique:categories,name,'.$category->id,
            'slug'=>'required|unique:categories,name,'.$category->id,
            'status'=>'required',
            'icon'=>'',
          	'serial'=>''
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            
        ];
        $this->validate($request, $rules,$customMessages);

        if($request->image){
            $old_thumbnail = $category->image;
            $image = Image::make($request->file('image'));
            $extention = $request->image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            
            $destation_path1 = 'uploads/custom-images/'.$image_name; 
            $image->resize(800,800);
            $image->save(public_path().'/'.$destation_path1); 

            $destation_path2 = 'uploads/custom-images2/'.$image_name; 
            $image->resize(48,48);
            $image->save(public_path().'/'.$destation_path2);

            $category->image=$image_name;
            $category->save();
            if($old_thumbnail){
                if(File::exists(public_path().'/uploads/custom-images/'.$old_thumbnail))unlink(public_path().'/uploads/custom-images/'.$old_thumbnail);
                if(File::exists(public_path().'/uploads/main-image/'.$old_thumbnail))unlink(public_path().'/uploads/main-image/'.$old_thumbnail);
            }
        }  
      
      	
      	

        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = $request->slug;
      	$category->serial = $request->serial;
        $category->status = $request->status;
        $category->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-category.index')->with($notification);
    }

    public function destroy($id)
    {
      if(!auth()->user()->can('productCategory.delete')){
            abort(403, 'Unauthorized action.');
        }  
      
        $category = Category::find($id);
        $category->delete();
        $megaMenuCategory = MegaMenuCategory::where('category_id',$id)->first();
        if($megaMenuCategory){
            $cat_id = $megaMenuCategory->id;
            $megaMenuCategory->delete();
            MegaMenuSubCategory::where('mega_menu_category_id',$cat_id)->delete();
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-category.index')->with($notification);
    }

    public function changeStatus($id){
      if(!auth()->user()->can('productCategory.changeStatus')){
            abort(403, 'Unauthorized action.');
        }  
      
        $category = Category::find($id);
        if($category->status==1){
            $category->status=0;
            $category->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $category->status=1;
            $category->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
