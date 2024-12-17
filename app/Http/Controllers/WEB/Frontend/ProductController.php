<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ChildCategory;
use App\Models\FeaturedCategory;
use App\Models\FooterLink;
use App\Models\Footer;
use App\Models\ProductVariant;
use App\Models\productColorVariation;
use App\Models\ProductReview;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductGallery;

use DB;
class ProductController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        
        $firstColumns  = FooterLink::where('column', 1)->get();
        $secondColumns = FooterLink::where('column', 2)->get();
        $thirdColumns  = FooterLink::where('column', 3)->get();
        $title         = Footer::first();

        $product = Product::with('variantItems', 'category', 'subCategory', 'childCategory', 'brand', 'gallery', 'variations')

                            ->findOrFail($id);
                     //dd($product);
        $Specification = DB::table('product_specifications')
                            ->join('products', 'products.id', 'product_specifications.product_id' )
                            ->join('product_specification_keys', 'product_specification_keys.id', 'product_specifications.product_specification_key_id')
                            ->select('product_specifications.*', 'products.name', 'product_specification_keys.key')
                            ->where('product_specifications.product_id', $id)->get();
                            // dd($Specification);

        $relatedProducts = Product::with('variantItems', 'category', 'subCategory', 'childCategory', 'brand')
                              ->where('category_id', $product->category_id) // Assuming category_id is the column name
                              ->where('id', '<>', $product->id) // Exclude the current product
                              ->limit(5) // Limit to 5 results
                              ->get();

        $reviews=   ProductReview::with('user', 'product')
                                ->where('product_id', $product->id) // Assuming category_id is the column name
                              ->where('id', '<>', $product->id) // Exclude the current product
                              ->limit(5) // Limit to 5 results
                              ->get();




        // dd($reviews);

        // dd($product);

        return view('frontend.product.show', compact('product', 'firstColumns', 'secondColumns', 'thirdColumns', 'title', 'Specification', 'relatedProducts', 'reviews'));
    }


    public function get_variation_price(Request $request)
    {
        $price_value = ProductVariant::find($request->value)->sell_price;
      	

        return response()->json([
            'success' => true,
            'price'  =>  $price_value
        ]);
    }
  
  
  	 public function get_color_price(Request $request)
    {
        $variant_data = productColorVariation::where(['product_id' => $request->product_id, 'color_id' => $request->color_id])          					
          					->first();
       	

       	
       	
       	$image_array = $variant_data->var_images;
       
       
       //dd($image_array);
		$html = view('frontend.product.var_img', compact('image_array'))->render();
       //dd($html);
       	return response()->json([
        	'var_images' => $html
        ]);
        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function searchProduct(Request $request)
    {
        $products = Product::with('category', 'subCategory', 'childCategory')
                                ->where('name', 'like', '%'.$request->get('query').'%')
                                ->orWhere('slug','like', '%'.$request->get('query').'%')
                                ->get();


        return view('frontend.shop.search', compact('products'));

    }


    public function single_product(Request $request, $slug) {
        $s_product = Product::where('slug', $slug)->first();
        $id = $s_product->id;
        $firstColumns  = FooterLink::where('column', 1)->get();
        $secondColumns = FooterLink::where('column', 2)->get();
        $thirdColumns  = FooterLink::where('column', 3)->get();
        $title         = Footer::first();

        $product = Product::with('variantItems', 'category', 'subCategory', 'childCategory', 'brand', 'gallery', 'variations')

                            ->findOrFail($id);
                     //dd($product);
        $Specification = DB::table('product_specifications')
                            ->join('products', 'products.id', 'product_specifications.product_id' )
                            ->join('product_specification_keys', 'product_specification_keys.id', 'product_specifications.product_specification_key_id')
                            ->select('product_specifications.*', 'products.name', 'product_specification_keys.key')
                            ->where('product_specifications.product_id', $id)->get();
                            // dd($Specification);

        $relatedProducts = Product::with('variantItems', 'category', 'subCategory', 'childCategory', 'brand')
                              ->where('category_id', $product->category_id) // Assuming category_id is the column name
                              ->where('id', '<>', $product->id) // Exclude the current product
                              ->limit(5) // Limit to 5 results
                              ->get();

        $reviews=   ProductReview::with('user', 'product')
                                ->where('product_id', $product->id) // Assuming category_id is the column name
                              ->where('id', '<>', $product->id) // Exclude the current product
                              ->limit(5) // Limit to 5 results
                              ->get();




        // dd($reviews);

        // dd($product);

        return view('frontend.product.show', compact('product', 'firstColumns', 'secondColumns', 'thirdColumns', 'title', 'Specification', 'relatedProducts', 'reviews'));
    }


    public function brandWiseProduct()
    {
        $products = Product::with('category', 'subCategory', 'childCategory', 'brand')
                                ->whereHas('brand', function($q){
                                    $q->whereSlug(request('slug'));
                                })
                                ->get();


        return view('frontend.product.brand-wise-product', compact('products'));

    }

   public function compare(Request $request)
{
     $productId1 = $request->input('product1');
    $productId2 = $request->input('product2');

    $product1 = Product::with(['variantItems', 'category', 'subCategory', 'childCategory', 'brand'])
        ->findOrFail($productId1);

    $product2 = Product::with(['variantItems', 'category', 'subCategory', 'childCategory', 'brand'])
        ->findOrFail($productId2);

    $specifications1 = $product1->specifications()->with('key')->get();
    $specifications2 = $product2->specifications()->with('key')->get();

    // dd($specifications1);

    return view('frontend.product.compare-product', compact('product1', 'product2', 'specifications1', 'specifications2'));
}

public function reviews(Request $request){
     $request->validate([
        'product_id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:500',
    ]);

    ProductReview::create([
        'product_id' => $request->product_id,
        'user_id' => auth()->user()->id,
        'rating' => $request->rating,
        'review' => $request->review,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Review submitted successfully. It will be visible after approval.');
}

}
