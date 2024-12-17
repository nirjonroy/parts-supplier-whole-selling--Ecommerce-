<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Product;
use App\Models\ProductReport;
use App\Models\ProductReview;
use App\Models\Vendor;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Brand;
use App\Models\OrderDetails;

use App\Models\OrderProduct;
use App\Models\OrderProductVariant;

use Carbon\Carbon;
class DashboardController extends Controller
{
    
    public function __construct() 
    {
      $this->middleware('auth');
    }
    

    public function dashobard(){
        if(!auth()->user()->can('admin.dashboard')){
            return redirect()->route('admin.login');
            // abort(403, 'Unauthorized action.');
        }
        $todayOrders = Order::with('user','orderProducts','orderAddress')->orderBy('id','desc')->get();
        $today_orders = Order::whereDate('created_at', date('Y-m-d'))->get();
        $today_pending_orders = Order::whereDate('created_at', date('Y-m-d'))->where('order_status', 0)->get();
        $today_total_orders = $today_orders->count();
        $today_total_pending_orders = $today_pending_orders->count();
        $todayTotalOrder = $todayOrders->count();
        
        $todayPendingOrder = $todayOrders->where('order_status',0)->count();
        $todayEarning = round($todayOrders->sum('amount_real_currency'),2);
        $todayPendingEarning = round($todayOrders->where('payment_status',0)->sum('amount_real_currency'),2);
        $todayProductSale = $todayOrders->where('order_status',3)->sum('product_qty');


        $totalOrders = Order::with('user','orderProducts','orderAddress', 'assign')->orderBy('id','desc')->get();
        $totalOrder = $totalOrders->count();
        $totalPendingOrder = $totalOrders->where('order_status',0)->count();
        $totalDeclinedOrder = $totalOrders->where('order_status',4)->count();
        $totalCompleteOrder = $totalOrders->where('order_status',3)->count();
        $totalEarning = round($totalOrders->sum('amount_real_currency'),2);
        $totalProductSale = $totalOrders->where('order_status',3)->sum('product_qty');



        $monthlyOrders = Order::with('user','orderProducts','orderAddress')->orderBy('id','desc')->whereMonth('created_at', now()->month)->get();
        $thisMonthEarning = round($monthlyOrders->sum('amount_real_currency'),2);
        $thisMonthProductSale = $monthlyOrders->where('order_status',3)->sum('product_qty');


        $yearlyOrders = Order::with('user','orderProducts','orderAddress')->orderBy('id','desc')->whereYear('created_at', now()->year)->get();
        $thisYearEarning = round($yearlyOrders->sum('amount_real_currency'),2);
        $thisYearProductSale = $yearlyOrders->where('order_status',3)->sum('product_qty');

        $setting = Setting::first();
        $products = Product::all();
        $reviews = ProductReview::all();
        $reports = ProductReport::all();
        $users = User::all();
        $sellers = Vendor::all();
        $subscribers = Subscriber::where('is_verified',1)->get();
        $blogs = Blog::all();
        $categories = Category::get();
        $brands = Brand::get();


        return view('admin.dashboard')->with([
            'todayOrders' => $todayOrders,
            'todayTotalOrder' => $todayTotalOrder,
            'todayPendingOrder' => $todayPendingOrder,
            'todayEarning' => $todayEarning,
            'todayPendingEarning' => $todayPendingEarning,
            'todayProductSale' => $todayProductSale,
            'thisMonthOrder' => $monthlyOrders->count(),
            'thisMonthEarning' => $thisMonthEarning,
            'thisMonthProductSale' => $thisMonthProductSale,
            'thisYearOrder' => $yearlyOrders->count(),
            'thisYearEarning' => $thisYearEarning,
            'thisYearProductSale' => $thisYearProductSale,
            'totalOrder' => $totalOrder,
            'totalPendingOrder' => $totalPendingOrder,
            'totalDeclinedOrder' => $totalDeclinedOrder,
            'totalCompleteOrder' => $totalCompleteOrder,
            'totalEarning' => $totalEarning,
            'totalProductSale' => $totalProductSale,
            'setting' => $setting,
            'totalProduct' => $products->count(),
            'reviews' => $reviews->count(),
            'reports' => $reports->count(),
            'users' => $users->count(),
            'sellers' => $sellers->count(),
            'subscribers' => $subscribers->count(),
            'blogs' => $blogs->count(),
            'categories' => $categories->count(),
            'brands' => $brands->count(),
            'today_total_orders' => $today_total_orders,
            'today_total_pending_orders' => $today_total_pending_orders
        ]);

    }

    public function order_report()
    {
         $orders = Order::with('user','orderProducts','orderAddress')->get();
         $setting = Setting::all();
         
         $order_products = OrderProduct::with(['order.orderAddress', 'product', 'orderProductVariants'])
          ->whereHas('order', function($q){
            $q->whereNotNull('order_id');
          }) 
          ->whereHas('order.orderAddress', function($q){
            $q->whereNotNull('shipping_name');
          }) 
          ->whereHas('product', function($q){
            $q->whereNotNull('name');
          })
          ->latest()->get();
        //   dd($order_products);
        
         $users = User::with('roles')->get();
        // dd($users);/**/
        $users = User::with("roles")->whereHas("roles", function($q) {
                    $q->whereIn("name", ["Admin", "Employee"]);
                })->get();
 
        return view('admin.reports.order', compact('orders', 'setting', 'order_products', 'users'));
    }
    
    
     public function filterOrder(Request $request)
    {    
        
        
      /*
      $details = OrderDetails::join('orders as o', 'order_details.order_id', 'o.id')
                                ->join('products as p', 'order_details.product_id', 'p.id')
                                ->join('variations as v', 'order_details.variation_id', 'v.id')
                                ->select('o.*', 'order_details.*', 'p.*', 'v.*')
                                ->where('o.date', '2023-03-15')
                                ->where('status', 'on_the_way')
                                ->paginate(20);
                                */
    
        $order_products = OrderProduct::join('orders as o', 'order_products.order_id', 'o.id')
                                ->join('products as p', 'order_products.product_id', 'p.id')
                                ->join('order_addresses as oad','order_products.order_id', 'oad.order_id')
                                // ->join('order_product_variants as v', 'order_products.variation_id', 'v.id')
                                ->select('o.*', 'order_products.*', 'p.*')
                                ->where(function($query){
                                   if(!empty(request()->status))
                                    {
                                        $query->where('o.order_status', request()->status);
                                    }  
                                    
                                    if(!empty(request()->input('query')))
                                    {
                                        $query->where('o.order_id', 'like', '%'.request()->input('query').'%')
                                                ->orWhere('oad.shipping_name', 'like', '%'.request()->input('query').'%')
                                                ->orWhere('oad.shipping_address', 'like', '%'.request()->input('query').'%')
                                                ->orWhere('oad.shipping_phone', 'like', '%'.request()->input('query').'%')
                                                ->orWhere('p.name', 'like', '%'.request()->input('query').'%');
                                    }        
                                    
                                    if(!empty(request()->from && request()->to))
                                    {
                                         $query->whereBetween('o.created_at', [request()->from, request()->to]);
                                    }        
                                    
                                    if(!empty(request()->assign))
                                    {
                                        $query->where('o.assign_id', request()->assign);
                                    }                                    
                                    
                                    
                                })
                                ->paginate(10)
                                ->appends($request->all()); 
                                
  
        // dd($order_products);
        $users = User::with('roles')->get();
        
        $users = User::with("roles")->whereHas("roles", function($q) {
                    $q->whereIn("name", ["Admin", "Employee"]);
                })->get();
                
        // $couriers = Courier::all();
        
        return view('admin.reports.order', compact( 'users', 'order_products'));        
      
    }

}
