<?php

namespace App\Http\Controllers\WEB\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\BillingAddress;
use App\Models\ShippingAddress;
use App\Models\User;
use Str;
class CountryController extends Controller
{
    

    public function index()
    {
        $countries = Country::with('countryStates','addressCountires')->get();

        return view('admin.country', compact('countries'));
    }


    public function create()
    {
        return view('admin.create_country');
    }


    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|unique:countries',
            'status'=>'required'
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $country=new Country();
        $country->name = $request->name;
        $country->slug = Str::slug($request->name);
        $country->status = $request->status;
        $country->save();

        $notification=trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function show($id)
    {
        $country = Country::find($id);
        return response()->json(['country' => $country], 200);
    }

    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.edit_country', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $rules = [
            'name'=>'required|unique:countries,name,'.$country->id,
            'status'=>'required'
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $country->name = $request->name;
        $country->slug = Str::slug($request->name);
        $country->status = $request->status;
        $country->save();

        $notification=trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.country.index')->with($notification);
    }


    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        $notification=trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.country.index')->with($notification);
    }

    public function changeStatus($id){
        $country = Country::find($id);
        if($country->status==1){
            $country->status=0;
            $country->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $country->status=1;
            $country->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
