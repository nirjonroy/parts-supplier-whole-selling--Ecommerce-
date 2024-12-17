<?php
use App\Models\Category;
use App\Models\PopularCategory;
use App\Models\FeaturedCategory;
use App\Models\Setting;
use App\Models\Brand;

function custom_sanitize($content)
{
    $replace = array('<p>', '</p>');
    $response = str_replace($replace, '', $content);
    return $response;
}

function getOrderStatus($type=""){

    if($type != "")
      {
       return [''=> 'All', '0'=>'Pending','1'=>'Process','2'=>'Courier','5'=>'On Hold','3'=>'Complete','4'=>'Cancelled','6' => 'Return'];
      }

      return ['0'=>'Pending','1'=>'Process','2'=>'Courier','5'=>'On Hold','3'=>'Complete','4'=>'Cancelled','6' => 'Return'];

  }

function categories()
{
    $categories = Category::with('activeSubCategories')->where('status', 1)->orderBy('serial', 'ASC')->limit(12)->latest()->get();

    return $categories;
}

function featuredCategories()
{
    $feateuredCategories = FeaturedCategory::with('category')->orderBy('serial', 'DESC')->get();

    return $feateuredCategories;
}

function popularCategories()
{
    $popularCategories = PopularCategory::with('category')->orderBy('serial', 'ASC')->get();

    return $popularCategories;
}

function siteInfo()
{
    $setting = Setting::first();

    return $setting;
}

function calculateDiscountPercent($product)
{
    if(!empty($product->offer_price) && $product->price > $product->offer_price)
    {
        return (int) ( ( ($product->price - $product->offer_price) / $product->price) * 100 );
    }

    return 0;
}

function cartItems()
{
    $cart = session()->get('cart', []);

    return $cart;
}

function getCartProductArray(){
    $carts = session()->get('cart', []);
    $product_id=[];
    foreach($carts as $key=>$cart){
        $product_id[]=$key;

    }

    return $product_id;
}


function totalCartItems()
{
    $cart = cartItems();

    return count($cart);
}

function cartTotalAmount()
{
    $cart = cartItems();
    $total = 0;
    $total_qty = 0;
    foreach($cart as $key => $item)
    {
        $total += ($item['price'] * $item['quantity']);
        $total_qty += $item['quantity'];
    }

    return ['total_qty' => $total_qty, 'total'=> $total];
}

function getProductInfo($product){


	$price=($product->offer_price  > 0) ? $product->offer_price : $product->price;
// 	$discount_amount=$product->dicount_amount;

// 	$old_price=($product->offer_price > 0) ? $product->sell_price : $product->regular_price;
	$old_price=$product->price;

	return ['price'=>$price,'old_price'=>$old_price];
}

function brands()
{
    $brands = Brand::with('products')->where('status', 1)->get();

    return $brands;
}

function getImage($folder=null,$value=null){

	$url = asset('images/no_found.png');
	$path = public_path($folder.'/'.$value);
	if (!empty($folder) && (!empty($value))) {
		if(file_exists($path)){
			$url = asset($folder.'/'.$value);
		}
	}
	return $url;
}


function deleteImage($folder=null, $file=null){

    if (!empty($folder) && !empty($file)) {
        $path = public_path($folder.'/'.$file);
        $isExists = file_exists($path);
        if ($isExists) {
            unlink($path);
        }
    }
    return true;
}

function BanglaText($index)
{
  $bangla_text = array(
    "order"                 => "Order",
    "cart"                  => "Cart",
    "free"                  => "Free Shipping",
    "offer"                 => "Mega Offer",
    "cart_add"              => "add to cart",
    "cust_info"             =>"customer information",
    "instruction"           =>"To confirm the order enter your name, address, mobile number and click on confirm order button",
    "name"                  => "Your Name",
    "placeholder_name"      => "Your Name",
    "mobile"                => "Phone Number",
    "placeholder_mobile"    => "type your phone number",
    "address"               => "your address",
    "placeholder_address"   => "",
    "delivery_zone"         => "select delivery zone",
    "confirm_order"         => "confirm order",
    "order_information"     => "order information",
    "land_instruction"      => "to order fillup the bellow form",
    "login_account"         => "login ",
    "coupon_apply"          => "do you have any coupon"
    );
  return $bangla_text[$index];
}
