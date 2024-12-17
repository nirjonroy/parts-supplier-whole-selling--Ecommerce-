<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function create_color(){
       if(!auth()->user()->can('product.color.index')){
            abort(403, 'Unauthorized action.');
        } 
        $all_color = Color::all();
        return view('admin.Attribute.color-create', compact('all_color'));
    }

    public function store_color(Request $request){

      if(!auth()->user()->can('product.color.store')){
            abort(403, 'Unauthorized action.');
        } 
        $isExist = Color::count();

        $rules = [
            "name" => ($isExist == 0) ? "required" : "required|unique:colors",
        ];
        $customMessages = [
            "name.required" => trans("admin_validation.Category is required"),

        ];

        $this->validate($request, $rules, $customMessages);

        Color::create(['name' => $request->name, 'code' => $request->code]);
        // dd($color);
        $notification = trans("admin_validation.Create Successfully");
        return redirect()->back()->with(['message' => $notification, 'alert-type' => 'success']);

    }


    public function create_size(){
      if(!auth()->user()->can('product.size.index')){
            abort(403, 'Unauthorized action.');
        } 
        $all_size = Size::all();
        return view('admin.Attribute.size-create', compact('all_size'));
    }


    public function store_size(Request $request){
	
      if(!auth()->user()->can('product.size.store')){
            abort(403, 'Unauthorized action.');
        } 
        $isExist = Size::count();

        $rules = [
            "title" => ($isExist == 0) ? "required" : "required|unique:sizes",
        ];
        $customMessages = [
            "title.required" => trans("admin_validation.Category is required"),

        ];

        $this->validate($request, $rules, $customMessages);

        Size::create(['title' => $request->title]);
        // dd($color);
        $notification = trans("admin_validation.Create Successfully");
        return redirect()->back()->with(['message' => $notification, 'alert-type' => 'success']);

    }

}
