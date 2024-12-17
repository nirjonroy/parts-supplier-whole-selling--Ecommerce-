<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Setting;

class InventoryController extends Controller
{
    


    public function index(){
      if(!auth()->user()->can('product.inventory.index')){
            abort(403, 'Unauthorized action.');
        } 
        $products = Product::where(['vendor_id' => 0])->orderBy('id','desc')->get();

        $setting = Setting::first();

        return view('admin.inventory')->with(['products' => $products, 'setting' => $setting]);
    }

    public function show_inventory($id){
      if(!auth()->user()->can('product.inventory.show')){
            abort(403, 'Unauthorized action.');
        } 
        $product = Product::where('id', $id)->first();

        $histories = Inventory::where('product_id', $id)->orderBy('id','desc')->get();

        return view('admin.stock_history')->with(['product' => $product, 'histories' => $histories]);
    }

    public function add_stock(Request $request){
      
       if(!auth()->user()->can('product.inventory.addStock')){
            abort(403, 'Unauthorized action.');
        } 
      
        $rules = [
            'product_id' =>'required',
            'stock_in' =>'required',
        ];
        $customMessages = [
            'product_id.required' => trans('Product is required'),
            'stock_in.required' => trans('Quantity is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $inventory = new Inventory();
        $inventory->product_id = $request->product_id;
        $inventory->stock_in = $request->stock_in;
        $inventory->save();

        $product = Product::where('id', $request->product_id)->first();
        $product->qty = $product->qty + $request->stock_in;
        $product->save();

        $notification=trans('Added Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function delete_stock($id){
      
      if(!auth()->user()->can('product.inventory.deleteStock')){
            abort(403, 'Unauthorized action.');
        } 
      
        $inventory = Inventory::find($id);
        $product = Product::where('id', $inventory->product_id)->first();
        $update_qty = $product->qty - $inventory->stock_in;
        $product->qty = $update_qty < 0 ? 0 : $update_qty;
        $product->save();
        $inventory->delete();

        $notification=trans('Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
