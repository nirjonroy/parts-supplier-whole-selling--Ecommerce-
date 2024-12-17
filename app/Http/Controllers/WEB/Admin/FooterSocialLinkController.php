<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterSocialLink;
class FooterSocialLinkController extends Controller
{
    

    public function index(){
        if(!auth()->user()->can('social.index')){
            abort(403, 'Unauthorized action.');
        } 
        $links = FooterSocialLink::all();
        return view('admin.footer_social_link', compact('links'));
    }

    public function store(Request $request){
        if(!auth()->user()->can('social.store')){
            abort(403, 'Unauthorized action.');
        } 
        $rules = [
            'link' =>'required',
            'icon' =>'required',
        ];
        $customMessages = [
            'link.required' => trans('admin_validation.Link is required'),
            'icon.required' => trans('admin_validation.Icon is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $link = new FooterSocialLink();
        $link->link = $request->link;
        $link->icon = $request->icon;
        $link->save();

        $notification=trans('admin_validation.Create Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function show($id){
        if(!auth()->user()->can('social.show')){
            abort(403, 'Unauthorized action.');
        } 
        $link = FooterSocialLink::find($id);
        return response()->json(['link' => $link], 200);
    }

    public function update(Request $request, $id){
        if(!auth()->user()->can('social.update')){
            abort(403, 'Unauthorized action.');
        } 
        $rules = [
            'link' =>'required',
            'icon' =>'required',
        ];
        $customMessages = [
            'link.required' => trans('admin_validation.Link is required'),
            'icon.required' => trans('admin_validation.Icon is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $link = FooterSocialLink::find($id);
        $link->link = $request->link;
        $link->icon = $request->icon;
        $link->save();

        $notification=trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){
         if(!auth()->user()->can('social.destroy')){
            abort(403, 'Unauthorized action.');
        } 
        $link = FooterSocialLink::find($id);
        $link->delete();
        $notification=trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
