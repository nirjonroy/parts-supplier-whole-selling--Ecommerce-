<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\AboutUs;
use App\Models\ChildCategory;
use App\Models\FlashSaleProduct;
use App\Models\FooterLink;
use App\Models\Footer;
use App\Models\CustomPage;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $slider = Slider::where('status', 1)->get();
        // dd($slider);
        $offer = AboutUs::find('2');
        $feateuredCategories = featuredCategories();
         $popularCats = popularCategories();
    $popularProducts = [];

    foreach ($popularCats as $pCats) {
        $poProducts = Product::where('category_id', $pCats->category_id)->where('status', 1)->limit(12)->latest()->get();
        $popularProducts[$pCats->category_id] = $poProducts;
    }

        // dd($popularCats);
        // dd($feateuredCategories);
        $products = Product::with(['category', 'subCategory', 'childCategory'])
                                        ->latest()
                                        ->take(25)
                                        ->get();
        $comp_pro = Product::latest()->get();

        $products = Product::with('category', 'subCategory', 'childCategory', 'brand')
                                ->whereHas('brand', function($q){
                                    $q->whereSlug(request('slug'));
                                })
                                ->get();
        $cat_wise_prod = Category::with('subCategories', 'products', 'activeSubCategories')
                            ->has('products')
                            ->where('status', 1)
                            ->latest()
                            ->get();

                            // dd($cat_wise_prod);
        $about = DB::table('about_us')->first();
        // dd($about);

        $flashSell = FlashSaleProduct::with('product')->limit(10)->where('status', 1)->latest()->get();
        $firstColumns  = FooterLink::where('column', 1)->get();
        $secondColumns = FooterLink::where('column', 2)->get();
        $thirdColumns  = FooterLink::where('column', 3)->get();

        $title  = Footer::first();
        $brands = Brand::all();
        $cart = session()->get('cart', []);
        $feature_products = Product::where('is_featured', 1)->latest()->limit(20)->get();
        // dd($feature_products);
        $best_products = Product::where('is_best', 1)->latest()->limit(20)->get();

        // dd($feature_products);

        return view('frontend.home.index', compact(
                'slider', 'feateuredCategories', 'products',
                'firstColumns',
                'secondColumns',
                'thirdColumns',
                'title',
                'brands',
                'flashSell',
                'cat_wise_prod',
                'cart',
                'comp_pro',
                'about',
                'popularCats',
                'popularProducts',
                'offer',
                'feature_products',
                'best_products'
        ));
    }

    public function subCategoriesByCategory(Request $request)
    {
        if($request->type == 'subcategory')
        {
            $id = Category::whereSlug($request->slug)->first()->id;
            $categories = SubCategory::where(['category_id' => $id])->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }

            return view('frontend.category.sub-category', compact('categories'));
        }
        else if($request->type == 'childcategory')
        {
            $id = SubCategory::whereSlug($request->slug)->first()->id;
            $categories = ChildCategory::where(['sub_category_id' => $id])->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }

            return view('frontend.category.child-category', compact('categories'));
        }

    }

    public function shop(Request $request, $slug)
    {
        // dd('ok');
         $data = [];

        if(empty($data))
        {
            $data = Category::with('products')->whereSlug($request->slug)->first();
        }

        if(empty($data))
        {
            $data = SubCategory::with('products')->whereSlug($request->slug)->first();
        }

        if(empty($data))
        {
            $data = ChildCategory::with('products')->whereSlug($request->slug)->first();
        }

        if(empty($request->slug))
        {
            $services = Product::with(['category', 'subCategory', 'childCategory'])->orderBy('id', 'DESC')->where('status', 1)->take(30)->get();
            // dd($services);
        }

        else if($data){
            // dd($data);
            $services = $data->products;
        }

        else{
            $services = [];
        }

        // dd($services);
        // $slider = Slider::select(['id', 'title_one', 'title_two', 'image'])->where('status', 1)->first();
        $feateuredCategories = featuredCategories();
        // $category = Category::where('slug', $slug)->first();
        // $sub_category = SubCategory::with('products')->whereSlug($request->slug)->first();
        // // dd($category);
        // $services = Product::where('category_id', $sub_category->id)->get();
        // dd($services);

        return view('frontend.shop.index', compact('services', 'feateuredCategories'));
    }




    public function mostSellingProducts()
    {
        $products = Product::with(['category', 'subCategory', 'childCategory'])
                            ->leftJoin('order_products as op','products.id','=','op.product_id')
                            ->selectRaw('products.*, COALESCE(sum(op.qty),0) total')
                            ->groupBy('products.id')
                            ->orderBy('total','desc')
                            ->take(50)
                            ->get();

        return view('frontend.shop.most-selling', compact('products'));
    }

     public function flashSellProducts(Request $request)
    {
        $data = null;


    $products = Product::with(['category', 'subCategory', 'childCategory'])->take(30)->get();
       //dd($flashProd);
    // Apply price range filter

   $minPrice = $products->min('price');
    $maxPrice = $products->max('price');

    $minPriceFilter = $request->input('min_price', $minPrice);
    $maxPriceFilter = $request->input('max_price', $maxPrice);

    $filteredProducts = $products->whereBetween('price', [$minPriceFilter, $maxPriceFilter]);

    // Apply availability filter
    $inStock = $request->input('in_stock');
    $outOfStock = $request->input('out_of_stock');

    if ($request->input('in_stock')) {
        $filteredProducts = $filteredProducts->where('qty', '>', 0);
    }

    if ($request->input('out_of_stock')) {
        $filteredProducts = $filteredProducts->where('sold_qty', '==', 'qty');
    }

        $flashSell = FlashSaleProduct::with('product')->where('status', 1)->latest()->get();

        return view('frontend.shop.flash-sell', compact('flashSell', 'filteredProducts', 'minPrice', 'maxPrice'));
    }
    public function customPages($slug){
        $customPage=CustomPage::where('slug', $slug)->first();

        // dd($customPage);
        return view('frontend.pages', compact('customPage'));
    }

    public function all_category(){
        $allCats = Category::where('status', 1)->get();
        return view('frontend.category.all_category', compact('allCats'));
    }

}
