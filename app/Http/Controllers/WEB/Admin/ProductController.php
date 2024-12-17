<?php

namespace App\Http\Controllers\WEB\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\ProductGallery;
use App\Models\Brand;
use App\Models\ProductSpecificationKey;
use App\Models\ProductSpecification;
use App\Models\OrderProduct;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\OrderProductVariant;
use App\Models\ProductReport;
use App\Models\ProductReview;
use App\Models\Wishlist;
use App\Models\Size;
use App\Models\Color;
use App\Models\Setting;
use App\Models\FlashSaleProduct;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartVariant;
use App\Models\CompareProduct;
use App\Models\productColorVariation;
use App\Models\FacebookPixel;
use App\Models\SitePixel;
use App\Models\GoogleAnalytic;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProduct;
use Image;
use File;
use Str;

class ProductController extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
       $q = $request->q;

        $query = Product::with('category', 'brand');

        if (!empty($q)) {
            $query->where(function ($row) use ($q) {
                $row->where('name', 'like', '%' . $q . '%');

            });
        }

        $products = $query->latest()
            ->paginate(30);

        $orderProducts = OrderProduct::all();
        $categories = Category::all();
        $setting = Setting::first();
        $frontend_url = $setting->frontend_url;
        $frontend_view = $frontend_url.'single-product?slug=';

        return view('admin.product',compact('products','orderProducts','setting','frontend_view','categories'));
    }

    public function sellerProduct(){

        $products = Product::with('category','seller','brand')->where('vendor_id','!=',0)->where('status',1)->get();
        $orderProducts = OrderProduct::all();
        $setting = Setting::first();
        $frontend_url = $setting->frontend_url;
        $frontend_view = $frontend_url.'single-product?slug=';
        return view('admin.product',compact('products','orderProducts','setting','frontend_view'));
    }

    public function cat_wise_product(Request $request) {
        $cat_id = $request->category_id;
        $cat_product = Product::with('category','seller', 'brand')->where('category_id', $request->category_id)->where(['vendor_id' => 0])->orderBy('id', 'desc')->get();
        $setting = Setting::first();
        $orderProducts = OrderProduct::all();
        $frontend_url = $setting->frontend_url;
        $frontend_view = $frontend_url.'single-product?slug=';
        $categories = Category::all();

        // $html_view = view('admin.query_product', compact('cat_product','setting','orderProducts'))->render();

        return view('admin.cat_product',compact('cat_product','orderProducts','setting','frontend_view','categories','cat_id'));
    }

    public function sellerPendingProduct(){
        $products = Product::with('category','seller','brand')->where('vendor_id','!=',0)->where('approve_by_admin',0)->get();
        $orderProducts = OrderProduct::all();
        $setting = Setting::first();

        return view('admin.pending_product',compact('products','orderProducts','setting'));

    }

    public function stockoutProduct(){
      if(!auth()->user()->can('product.stockProduct')){
            abort(403, 'Unauthorized action.');
        }
        $products = Product::with('category','seller','brand')->where('vendor_id',0)->where('qty',0)->get();
        $orderProducts = OrderProduct::all();
        $setting = Setting::first();

        $frontend_url = $setting->frontend_url;
        $frontend_view = $frontend_url.'single-product?slug=';

        return view('admin.stockout_product',compact('products','orderProducts','setting','frontend_view'));

    }



    public function create()
    {
      if(!auth()->user()->can('product.create')){
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors= Color::all();
      	//dd($colors);
        $specificationKeys = ProductSpecificationKey::all();

        return view('admin.create_product',compact('categories','brands','specificationKeys', 'sizes', 'colors'));
    }

    public function store(Request $request)    {
       if(!auth()->user()->can('product.store')){
            abort(403, 'Unauthorized action.');
        }
         //dd($request->all());
        $rules = [
            'short_name' => '',
            'name' => 'required',
            'slug' => 'required|unique:products',
            'thumb_image' => 'required',
            'image' => '',
            'type' => '',
            'product_id' => '',
            'category' => 'required',
            'short_description' => '',
            'long_description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'weight' => '',
            'video_link' => '',
            'quantity' => 'required|numeric',
        ];
        $customMessages = [
            // 'short_name.required' => trans('admin_validation.Short name is required'),
            // 'short_name.unique' => trans('admin_validation.Short name is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'category.required' => trans('admin_validation.Category is required'),
            'thumb_image.required' => trans('admin_validation.thumbnail is required'),
            // 'short_description.required' => trans('admin_validation.Short description is required'),
            'long_description.required' => trans('admin_validation.Long description is required'),
            'price.required' => trans('admin_validation.Price is required'),
            'status.required' => trans('admin_validation.Status is required'),
            'quantity.required' => trans('admin_validation.Quantity is required'),
            // 'weight.required' => trans('admin_validation.Weight is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $product = new Product();
        if($request->thumb_image){
            $image = Image::make($request->file('thumb_image'));
            $extention = $request->thumb_image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;


            $destation_path1 = 'uploads/custom-images/'.$image_name;
            $image->resize(700,700);
            $image->save(public_path().'/'.$destation_path1);

            // For Main Image
            $destation_path = 'uploads/custom-images2/'.$image_name;
            $image->resize(200,200);
            $image->save(public_path().'/'.$destation_path);
            $product->thumb_image=$image_name;
        }
$discount_price = '';
        if($request->offer_price != null) {
           $discount_price =  $request->price - $request->offer_price;
        } else {

        }

        // $product->short_name = $request->short_name;

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category ? $request->sub_category : 0;
        $product->child_category_id = $request->child_category ? $request->child_category : 0;
        $product->brand_id = $request->brand ? $request->brand : 0;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->discount_price = $discount_price;
        $product->qty = $request->quantity ? $request->quantity : 0;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        $product->type = 'single';
      	$product->prod_color = 'sincolor';
        // $product->weight = $request->weight;
        $product->video_link = $request->video_link;
        $product->measure = $request->measure;
        $product->tags = $request->tags;
        $product->is_undefine = 1;
        $product->is_specification = $request->is_specification ? 1 : 0;
        $product->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $product->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $product->is_top = $request->top_product ? 1 : 0;
        $product->new_product = $request->new_arrival ? 1 : 0;
        $product->is_best = $request->best_product ? 1 : 0;
        $product->is_featured = $request->is_featured ? 1 : 0;
        $product->approve_by_admin = 1;
        $product->save();

       if ($request->hasFile('images')) {
    $imageData = [];
    foreach ($request->file('images') as $key => $image) {

        $extention = $image->getClientOriginalExtension();
        $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image = Image::make($image);

        $destation_path_another = 'uploads/custom-images/'.$image_name;
        $image->resize(700,700);
        $image->save(public_path().'/'.$destation_path_another);

        $imageData[] = ['image' => $destation_path_another, 'product_id' => $product->id];

    }

    if (!empty($imageData)) {
        // Associate images with the product using the gallery relationship
        $product->gallery()->createMany($imageData);
    }
}

        if($request->is_specification){
            $exist_specifications=[];
            if($request->keys){
                foreach($request->keys as $index => $key){
                    if($key){
                        if($request->specifications[$index]){
                            if(!in_array($key, $exist_specifications)){
                                $productSpecification= new ProductSpecification();
                                $productSpecification->product_id = $product->id;
                                $productSpecification->product_specification_key_id = $key;
                                $productSpecification->specification = $request->specifications[$index];
                                $productSpecification->save();
                            }
                            $exist_specifications[] = $key;
                        }
                    }
                }
            }
        }

        if ($request->type == 'variable') {

            $variable_data=[];
            // $variable_data[] = [
            //     'size_id'=>$request->size_id,
            //     'sell_price'=>$request->sell_price,
            // ];

            foreach ($request->size_id as $key => $size) {

               $variable_data[]=[
                    'size_id' => $size,
                    'sell_price' => $request->sell_price[$key],
               ];
            }

            if (!empty($variable_data)) {
                $product->variations()->createMany($variable_data);
            }

        } else {
            $variable_data=[];

            $variable_data[] = [
                'size_id'=>"1",
                'sell_price'=>$request->sell_price,

            ];

        }


    if ($request->prod_color == 'varcolor') {
    $colors = $request->color_id;

    $images = $request->var_images;


    // Validate and process each color variation with its images
    $colorVariationsData = [];

    foreach ($colors as $key => $colorId) {
        $color = Color::find($colorId);

        if ($color) {
            // Store the images for this color variation
            if (isset($images[$key])) {

                    $ext = $images[$key]->getClientOriginalExtension();

                    // Generate a unique image name using a combination of color name, color ID, and a timestamp
                    $imageName = Str::slug($color->name) . '_color_' . $colorId . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $ext;
                    $destinationPath = 'uploads/custom-images/' . $imageName;

                    // Resize and save the image
                    $image = Image::make($images[$key]);
                    $image->resize(700, 700);
                    $image->save(public_path() . '/' . $destinationPath);

                    $colorVariationsData[] = [
                        'color_id' => $colorId,
                        'var_images' => $destinationPath,
                    ];
            }
            else {
                dd('notttt');
            }

        }
    }
    //  dd($colorVariationsData);


    if (!empty($colorVariationsData)) {
        // Create a new color variation and associate it with the product
        $product->colorVariations()->createMany($colorVariationsData);
    }

    // dd($colorVariationsData);


} else {
    // dd('no reached');
}

//  dd('last');


        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product.index')->with($notification);
    }

    public function show($id)
    {
        $product = Product::with('category','brand','gallery','specifications','reviews','variants','variantItems')->find($id);
        if($product->vendor_id == 0){
            $notification = 'Something went wrong';
            return response()->json(['error'=>$notification],403);
        }

        return response()->json(['product' => $product], 200);
    }


    public function edit($id)
    {
      if(!auth()->user()->can('product.edit')){
            abort(403, 'Unauthorized action.');
        }
        $product = Product::with('category','brand','gallery','variants','variantItems', 'variations')->find($id);
        $sizes=Size::all();
      	$colors = Color::all();
        // $types=Type::all();
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id',$product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $brands = Brand::all();
        $specificationKeys = ProductSpecificationKey::all();
        $productSpecifications = ProductSpecification::where('product_id',$product->id)->get();

        return view('admin.edit_product',compact('colors','sizes','categories','brands','specificationKeys','product','subCategories','childCategories','productSpecifications'));

    }


    public function update(Request $request, $id)
    {
      if(!auth()->user()->can('product.update')){
            abort(403, 'Unauthorized action.');
        }
      //dd($request->all());
        $product = Product::find($id);
        $rules = [
            'short_name' => '',
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$product->id,
            'category' => 'required',
            'short_description' => '',
            'long_description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'weight' => '',
            'video_link' => '',
        ];
        $customMessages = [
            // 'short_name.required' => trans('admin_validation.Short name is required'),
            // 'short_name.unique' => trans('admin_validation.Short name is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'category.required' => trans('admin_validation.Category is required'),
            'thumb_image.required' => trans('admin_validation.thumbnail is required'),
            'banner_image.required' => trans('admin_validation.Banner is required'),
            // 'short_description.required' => trans('admin_validation.Short description is required'),
            'long_description.required' => trans('admin_validation.Long description is required'),
            'brand.required' => trans('admin_validation.Brand is required'),
            'price.required' => trans('admin_validation.Price is required'),
            'quantity.required' => trans('admin_validation.Quantity is required'),
            'status.required' => trans('admin_validation.Status is required'),
            // 'weight.required' => trans('admin_validation.Weight is required'),
        ];
        $this->validate($request, $rules,$customMessages);

         if($request->thumb_image){
            $old_thumbnail = $product->thumb_image;
            $image = Image::make($request->file('thumb_image'));
            $extention = $request->thumb_image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;

            $destation_path1 = 'uploads/custom-images/'.$image_name;
            $image->resize(700,700);
            $image->save(public_path().'/'.$destation_path1);

            $destation_path2 = 'uploads/custom-images2/'.$image_name;
            $image->resize(200,200);
            $image->save(public_path().'/'.$destation_path2);

            $product->thumb_image=$image_name;
            $product->save();
            if($old_thumbnail){
                if(File::exists(public_path().'/uploads/custom-images/'.$old_thumbnail))unlink(public_path().'/uploads/custom-images/'.$old_thumbnail);
                if(File::exists(public_path().'/uploads/main-image/'.$old_thumbnail))unlink(public_path().'/uploads/main-image/'.$old_thumbnail);
            }
        }


        // $product->short_name = $request->short_name;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category ? $request->sub_category : 0;
        $product->child_category_id = $request->child_category ? $request->child_category : 0;
        $product->brand_id = $request->brand ? $request->brand : 0;
        $product->sold_qty = 0;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->tags = $request->tags;
        $product->status = $request->status;
        // $product->weight = $request->weight;
        $product->video_link = $request->video_link;
        $product->measure = $request->measure;
        $product->is_specification = $request->is_specification ? 1 : 0;
        $product->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $product->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $product->is_top = $request->top_product ? 1 : 0;
        $product->new_product = $request->new_arrival ? 1 : 0;
        $product->is_best = $request->best_product ? 1 : 0;
        $product->is_featured = $request->is_featured ? 1 : 0;
        if($product->vendor_id != 0){
            $product->approve_by_admin = $request->approve_by_admin;
        }
        $product->save();

          if ($request->hasFile('images')) {
    $imageData = [];
    foreach ($request->file('images') as $key => $image) {

        $extention = $image->getClientOriginalExtension();
        $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image = Image::make($image);

        $destation_path_another = 'uploads/custom-images/'.$image_name;
        $image->resize(700,700);
        $image->save(public_path().'/'.$destation_path_another);
        $imageData[] = ['image' => $destation_path_another, 'product_id' => $product->id];

    }

    if (!empty($imageData)) {
        // Associate images with the product using the gallery relationship
        $product->gallery()->createMany($imageData);
    }
}

        $exist_specifications=[];
        if($request->keys){
            foreach($request->keys as $index => $key){
                if($key){
                    if($request->specifications[$index]){
                        if(!in_array($key, $exist_specifications)){
                            $existSroductSpecification = ProductSpecification::where(['product_id' => $product->id,'product_specification_key_id' => $key])->first();
                            if($existSroductSpecification){
                                $existSroductSpecification->specification = $request->specifications[$index];
                                $existSroductSpecification->save();
                            }else{
                                $productSpecification = new ProductSpecification();
                                $productSpecification->product_id = $product->id;
                                $productSpecification->product_specification_key_id = $key;
                                $productSpecification->specification = $request->specifications[$index];
                                $productSpecification->save();
                            }
                        }
                        $exist_specifications[] = $key;
                    }
                }
            }
        }


        if (isset($request->size_id)) {

            $variable_data=[];
            foreach ($request->size_id as $key => $size) {

                 $delete_variations = ProductVariant::where('product_id', $product->id)->whereNotIn('id',  $request->variation_id)->get();
                  if($delete_variations->count()) {
                     foreach ($delete_variations as $key => $dvariation) {
                         $dvariation->delete();
                     }
                  }

                if (isset($request->variation_id[$key])) {
                    $variable=ProductVariant::find($request->variation_id[$key]);
                    $variable->size_id=$size;
                    $variable->sell_price= $request->sell_price[$key];
                    $variable->save();
                }else{
                    $variable_data[]=[
                        'size_id'=>$size,
                        'sell_price' => $request->sell_price[$key],
                    ];
                }
            }

            if (!empty($variable_data)) {
                $product->variations()->createMany($variable_data);
            }

        }



      	if (isset($request->color_id)) {



		//dd($request->color_variation_id);
            $variable_color_data=[];
            foreach ($request->color_id as $key => $color) {
              //dd($request->var_images);

             $delete_variations = productColorVariation::where('product_id', $product->id)->whereNotIn('id',  $request->color_variation_id)->get();

                  if($delete_variations->count()) {
                     foreach ($delete_variations as $key => $dvariation) {
                         $dvariation->delete();
                     }
                  }

              $variable=productColorVariation::find($color);

                if (isset($request->color_variation_id[$key])) {
                  if(isset($request->var_images[$key])){

                    $variable=productColorVariation::find($request->color_variation_id[$key]);
                    $variable->color_id=$color;


                    $ext = $request->var_images[$key]->getClientOriginalExtension();

                    // Generate a unique image name using a combination of color name, color ID, and a timestamp
                    $imageName = Str::slug('try') . '_color_'  . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $ext;
                    $destinationPath = 'uploads/custom-images/' . $imageName;

                    // Resize and save the image
                    $image = Image::make($request->var_images[$key]);


                    $image->resize(700, 700);

                    $image->save(public_path() . '/' . $destinationPath);
                    $variable->var_images = $destinationPath;

                    $variable->save();

                  }
                  else{
                    $variable=productColorVariation::find($request->color_variation_id[$key]);
                    $variable->color_id=$color;

                    $variable->save();
                  }
                }else{
                    $variable_color_data[]=[
                        'color_id'=>$color,

                    ];
                }
            }

            if (!empty($variable_color_data)) {
              //dd($variable_color_data);
                $product->colorVariations()->createMany($variable_color_data);
            }



        }



    //   if ($product->type == 'variable') {

    //       if(isset($request->size_id)) {
    //          $variable_data = [];

    //           foreach ($request->size_id as $key => $size) {

    //         //     $delete_variations = ProductVariant::where('product_id', $product->id)->whereNotIn('id',  $request->variation_id)->get();

    //         //   if($delete_variations->count()) {
    //         //       foreach ($delete_variations as $key => $dvariation) {
    //         //         $dvariation->delete();
    //         //         }
    //         //   }

    //           $variable_data[]=[
    //                 'size_id' => $size,
    //                 'sell_price' => $request->sell_price[$key],
    //           ];

    //         }

    //         if (!empty($variable_data)) {
    //             $product->variations()->createMany($variable_data);
    //         }
    //       }

    //     } else {
    //         $variable_data=[];

    //         $variable_data[] = [
    //             'size_id'=>"1",
    //             'sell_price'=>$request->sell_price
    //         ];

    //     }

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product.index')->with($notification);
    }

    public function destroy($id)
    {
      if(!auth()->user()->can('product.destroy')){
            abort(403, 'Unauthorized action.');
        }

        $product = Product::find($id);
        $gallery = $product->gallery;
        $old_thumbnail = $product->thumb_image;
        $product->delete();
        if($old_thumbnail){
            if(File::exists(public_path().'/'.$old_thumbnail))unlink(public_path().'/'.$old_thumbnail);
        }
        foreach($gallery as $image){
            $old_image = $image->image;
            $image->delete();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }
        ProductVariant::where('product_id',$id)->delete();
        ProductVariantItem::where('product_id',$id)->delete();
        FlashSaleProduct::where('product_id',$id)->delete();
        ProductReport::where('product_id',$id)->delete();
        ProductReview::where('product_id',$id)->delete();
        ProductSpecification::where('product_id',$id)->delete();
        Wishlist::where('product_id',$id)->delete();
        $cartProducts = ShoppingCart::where('product_id',$id)->get();
        foreach($cartProducts as $cartProduct){
            ShoppingCartVariant::where('shopping_cart_id', $cartProduct->id)->delete();
            $cartProduct->delete();
        }
        CompareProduct::where('product_id',$id)->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product.index')->with($notification);
    }

    public function changeStatus($id){
        if(!auth()->user()->can('product.changeStatus')){
              abort(403, 'Unauthorized action.');
          }
          $product = Product::find($id);
          if($product->is_recommended == 1){
              $product->is_recommended = 0;
              $product->save();
              $message = trans('admin_validation.InActive Successfully');
          }else{

              $product->is_recommended = 1;
              $product->save();
              $message = trans('admin_validation.Active Successfully');
          }
          return response()->json($message);
      }

      public function best_status($id){
        if(!auth()->user()->can('product.changeStatus')){
              abort(403, 'Unauthorized action.');
          }
          $product = Product::find($id);
          if($product->is_best == 1){
              $product->is_best = 0;
              $product->save();
              $message = trans('admin_validation.InActive Successfully');
          }else{

              $product->is_best = 1;
              $product->save();
              $message = trans('admin_validation.Active Successfully');
          }
          return response()->json($message);
      }

      public function change_Status($id){
        if(!auth()->user()->can('product.changeStatus')){
              abort(403, 'Unauthorized action.');
          }
          $product = Product::find($id);
          if($product->status == 1){
              $product->status = 0;
              $product->save();
              $message = trans('admin_validation.InActive Successfully');
          }else{

              $product->status = 1;
              $product->save();
              $message = trans('admin_validation.Active Successfully');
          }
          return response()->json($message);
      }

    public function productApproved($id){



        $product = Product::find($id);
        if($product->approve_by_admin == 1){
            $product->approve_by_admin = 0;
            $product->save();
            $message = trans('admin_validation.Reject Successfully');
        }else{
            $product->approve_by_admin = 1;
            $product->save();
            $message = trans('admin_validation.Approved Successfully');
        }
        return response()->json($message);
    }



    public function removedProductExistSpecification($id){
        $productSpecification = ProductSpecification::find($id);
        $productSpecification->delete();
        $message = trans('admin_validation.Removed Successfully');
        return response()->json($message);
    }

    public function fshippingdestroy(Request $request) {
        $product = Product::find($request->product_id);
        $data=[
             'is_free_shipping'=> null
        ];
        $product->update($data);
        return response()->json(['status'=>true ,'msg'=>'Free Shipping Is Deleted !!']);
    }


    public function free_shipping()
    {
      if(!auth()->user()->can('product.free-shipping')){
            abort(403, 'Unauthorized action.');
        }

        $items=Product::whereNotNull('is_free_shipping')->paginate(30);
        return view('admin.free_shipping.index', compact('items'));
    }

    public function create_free_shipping() {
        return view('admin.free_shipping.create_free_shipping');
    }

    public function store_free_shipping(Request $request) {
      if(!auth()->user()->can('product.free-shipping-store')){
            abort(403, 'Unauthorized action.');
        }

        if (isset($request->product_id)) {

            foreach ($request->product_id as $key => $product_id) {
                $product=Product::find($product_id);
                $data=[
                        'is_free_shipping'=>1
                ];
                $product->update($data);
            }
        }

        return response()->json(['status'=>true ,'msg'=>'Free Shipping Added Successfully !!','url'=>route('admin.free_shipping')]);
    }

    public function getDiscountProduct(Request $request){

        $data = Product::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();

        return response()->json($data);

    }

    public function productEntry2(Request $request){

        $product = Product::select("*")
                    ->where('id',$request->get('product_id'))
                    ->get();

        if ($product) {
            $html='';
            foreach ($product as $key => $item) {
               $html.='<tr>
                        <td>'.$item->name.'</td>
                        <td>'.$item->category->name.'</td>
                        <td class="sell_price">'.$item->price.'</td>

                        <td>
                            <input type="hidden" name="product_id[]" value="'.$item->id.'">
                        </td>

                        <td>
                            <a class="remove action-icon"> <i class="mdi mdi-delete"></i></a>
                        </td>
                    </tr>';
            }
            return response()->json(['data'=>$html]);

        }else{
            return response()->json(['data'=>'']);
        }
    }

    public function productEntry(Request $request){

        $product = Product::select("*")
                    ->where('id',$request->get('product_id'))
                    ->get();

        if ($product) {
            $html='';
            foreach ($product as $key => $item) {
               $html.='<tr>
                        <td>'.$item->name.'</td>
                        <td>'.$item->category->name.'</td>
                        <td class="sell_price">'.$item->price.'</td>

                        <td>
                            <select class="form-control dicount_type" name="dicount_type[]">
                                <option value="fixed">Fixed</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" step="any" name="dicount_amount[]" class="form-control dicount_amount" value="0">
                            <input type="hidden" name="product_id[]" value="'.$item->id.'">
                        </td>

                        <td>
                            <input type="number" step="any" name="after_discount[]" class="form-control after_discount" value="0">
                        </td>

                        <td>
                            <a class="remove action-icon"> Delete</a>
                        </td>
                    </tr>';
            }
            return response()->json(['data'=>$html]);

        }else{
            return response()->json(['data'=>'']);
        }
    }

    public function get_variant_price(Request $request) {
        $size_id = $request->size_id;
        $size_data = Size::where('id', $size_id)->first();
        $size_name = $size_data->title;
        $pro_id = $request->pro_id;

        $data = ProductVariant::where('product_id', $pro_id)->where('size_id', $size_id)->first();
        $price = $data->sell_price;
        return response()->json([
            'status' => true,
            'size_name' => $size_name,
            'price'  => $price
        ]);
    }

    public function updateFacebookPixel(Request $request){

        $rules = [
            'allow_facebook_pixel' => '',
            'app_id' => $request->allow_facebook_pixel ?  '' : '',
        ];
        $customMessages = [
            // 'app_id.required' => trans('admin_validation.App id is required'),
        ];
        $this->validate($request, $rules,$customMessages);




        $facebookPixel = FacebookPixel::first();
        $facebookPixel->app_id = $request->app_id;
        $facebookPixel->status = $request->allow_facebook_pixel ? 1 : 0;
        $facebookPixel->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateGoogleAnalytic(Request $request){
        $rules = [
            'allow' => '',
            'analytic_id' => $request->allow == 1 ?  '' : ''
        ];
        $customMessages = [
            // 'allow.required' => trans('admin_validation.Allow is required'),
            // 'analytic_id.required' => trans('admin_validation.Analytic id is required'),
        ];

        $this->validate($request, $rules,$customMessages);
        $googleAnalytic = GoogleAnalytic::first();
        $googleAnalytic->status = $request->allow;
        $googleAnalytic->analytic_id = $request->analytic_id;
        $googleAnalytic->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateSitePixel(Request $request){

        $rules = [
            'status' => '',
            'pixel_id' => $request->pixel_id ?  '' : '',
        ];
        $customMessages = [
            // 'pixel_id.required' => trans('admin_validation.pixel_id id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $sitePixel = SitePixel::first();
        $sitePixel->pixel_id = $request->pixel_id;
        $sitePixel->status = $request->allow_facebook_pixel ? 1 : 0;
        $sitePixel->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
    
     public function ImportProduct(Request $request){

        Excel::import(new ImportProduct,
                      $request->file('file'));
        return redirect()->back();

    }

}
