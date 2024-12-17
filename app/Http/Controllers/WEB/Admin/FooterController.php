<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use Image;
use File;
class FooterController extends Controller
{
    

    public function index(){
        $footer = Footer::first();
        return view('admin.website_footer', compact('footer'));
    }

    public function update(Request $request, $id){
        
        $rules = [
            'email' =>'required',
            'phone' =>'required',
            'phone2' => 'required',
            'address' =>'required',
            'copyright' =>'required',
            'open'     => 'required',
            'holiday'  => 'required',
            'first_column' =>'',
            'second_column' =>'',
            'third_column' =>'',
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'phone2.required' => trans('admin_validation.Phone2 is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'copyright.required' => trans('admin_validation.Copyright is required'),
            'open.required' => trans('admin_validation.Open Office Time is required'),
            'holiday.required' => trans('admin_validation.Holiday is required'),
            'first_column.required' => trans('admin_validation.First column title is required'),
            'second_column.required' => trans('admin_validation.Second column title is required'),
            'third_column.required' => trans('admin_validation.Third column title is required'),
        ];
        $this->validate($request, $rules,$customMessages);
        
        $footer = Footer::first();
        
        Footer::where(['id' => 1])->update([
        'email' => $request->email,
        'phone' => $request->phone,
        'phone2' => $request->phone2,
        'open' => $request->open,
        'holiday' => $request->holiday,
        'address' => $request->address,
        'copyright' => $request->copyright,
        'first_column' => $request->first_column,
        'second_column' => $request->second_column,
        'third_column' => $request->third_column
        ]);
        
        // $footer->email = $request->email;
        // $footer->phone = $request->phone;
        // $footer->phone2 = $request->phone2;
        // $footer->open = $request->open;
        // $footer->holiday = $request->holiday;
        // $footer->address = $request->address;
        // $footer->copyright = $request->copyright;
        // $footer->first_column = $request->first_column;
        // $footer->second_column = $request->second_column;
        // $footer->third_column = $request->third_column;
        // dd($footer);
        // $footer->save();
        
        if($request->card_image){
            $old_logo=$footer->background_image;
            $image=$request->card_image;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'payment-card-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $footer->background_image=$logo_name;
            $footer->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
