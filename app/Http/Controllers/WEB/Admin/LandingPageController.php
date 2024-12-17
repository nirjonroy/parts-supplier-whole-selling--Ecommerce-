<?php

namespace App\Http\Controllers\web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\LandingPage;
use App\Models\LandingPageSlider;
use App\Models\Shipping;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
    //   if(auth()->user()->can('product.landingPage.index')){
    //         abort(403, 'Unauthorized action.');
    //     } 
        $items=LandingPage::with('product')->get();
        return view('admin.LandingPage.index', compact('items'));
    }
    
    public function create(){
       

        return view('admin.LandingPage.create');
    }
    
    
    public function store(Request $request)
    {
    //   if(auth()->user()->can('product.landingPage.store')){
    //         abort(403, 'Unauthorized action.');
    //     } 
        // dd($request->all());
        $data=$request->validate([
             'title1'=> 'required',
             'title2'=> 'required',
             'video_url'=> '',
             'des1' => 'required',
             'feature' => 'required',
             'old_price' => '',
             'new_price' => '',
             'phone' => '',
             'des3' => '',
             'pay_text' => '',
             'product_id' => ''
        ]);
        
            if($request->hasFile('image'))
            {
                $originName = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
                $request->file('image')->move(public_path('landing_pages'), $fileName);
                $data['image']=$fileName;
            }

            $landPage = LandingPage::create($data);
            if(isset($request->sliderimage)) {

            $image_data=[];
            $fileName='';
            foreach ($request->sliderimage as $key => $image) {
                $originName = $image->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;

                $image->move(public_path('landing_sliders'), $fileName);
                $image_data[]=['image'=>$fileName];
            }

            if (!empty($image_data)) {
                   $landPage->images()->createMany($image_data);
            }
        }

        $notification=trans('admin_validation.Landing Page Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

        // return response()->json([
        //     'status' => true,
        //     'msg'    => 'Landing Page Created Successfully..!!'
        // ]);

    }


     public function getOrderProduct(Request $request)
    {
        $data = Product::
                    
        where('products.name', 'LIKE', '%'. $request->get('search'). '%')
        ->get();

return response()->json($data);

    }
    
    public function getOrderProduct2(Request $request){

        $data = Product::
                    
                    where('products.name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();

        return response()->json($data);

    }
    
    public function orderProductEntry(Request $request){ 

        $id=$request->id;
        $variation=Product::find($id);
        $data=Product::all;

        if ($variation) { 
            $html='<tr><td><img src="/products/'.$variation->thumb_image.'" height="50" width="50"/></td>
            		<td>'.$variation->name.'</td>
                    
                  
                    <td class="row_total">'.$data['price'].'</td>
                    <td>
                        <a class="remove btn btn-sm btn-danger"> <i class="mdi mdi-delete"></i> </a>
                    </td>
                    </tr> ';

            return response()->json(['success'=>true,'html'=>$html]);
        }else{
            return response()->json(['success'=>false,'msg'=>'Product Note Found !!']);
        }
    }
    
    public function landingProductEntry(Request $request){

        $id=$request->id;
        $variation=Product::find($id);
        $pr_id = $variation->id;
        $data=Product::all();

        if ($variation) {
            $html = '<table class="table table-centered table-nowrap mb-0" id="product_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>price</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody id="data">
                                   <tr><td><img src="/products/'.$variation->thumb_image.'" height="50" width="50"/></td>
            		<td>'.$variation->name.'</td>
                    <td>'.$variation->price.'</td>
                    
                    
                        <a class="remove btn btn-sm btn-danger"> <i class="mdi mdi-delete"></i> </a>
                    </td>
                    </tr>
                                </tbody>
                            </table>';




            $htmldfhgdf='<tr><td><img src="$variation->thumb_image" height="50" width="50"/></td>
            		<td>'.$variation->name.'</td>
                    
                    <td>
                        <a class="remove btn btn-sm btn-danger"> <i class="mdi mdi-delete"></i> </a>
                    </td>
                    </tr> ';

            return response()->json(['success'=>true,'html'=>$html,'pr_id' => $pr_id]);
        }else{
            return response()->json(['success'=>false,'msg'=>'Product Note Found !!']);
        }
    }


    public function fileUpload(Request $request){

        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('ck-images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('ck-images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }

    }

    public function landing_page($id)
    {
        $ln_pg = LandingPage::with('product')->where('id', $id)->first();
        $shippings = Shipping::with('city')->orderBy('id', 'asc')->get();
        // dd($ln_pg);
        return view('admin.LandingPage.land_page', compact('ln_pg', 'shippings'));
    }


    public function landing_page_edit($id)
    {
    //   if(!auth()->user()->can('product.landingPage.edit')){
    //         abort(403, 'Unauthorized action.');
    //     } 
        $item=LandingPage::with('product')->find($id);
        $single_product = Product::find($item->product_id);
        // dd($single_product);
        return view('admin.LandingPage.edit', compact('item', 'single_product'));
    }

    

    public function update(Request $request, $id)
    {
    //   if(!auth()->user()->can('product.landingPage.update')){
    //         abort(403, 'Unauthorized action.');
    //     } 

        $updatePage = LandingPage::find($id);
        $data=$request->validate([
            'title1'=> 'required',
             'title2'=> 'required',
             'video_url'=> '',
             'des1' => 'required',
             'feature' => 'required',
             'old_price' => '',
             'new_price' => '',
             'phone' => '',
             'des3' => '',
             'pay_text' => '',
             'product_id' => ''
       ]);
       
       if($request->new_product_id != null)
      {
          $data['product_id'] = $request->new_product_id;
      }

           if(isset($request->sliderimage)) {

           $image_data=[];
           $fileName='';
           foreach ($request->sliderimage as $key => $image) {
               $originName = $image->getClientOriginalName();
               $fileName = pathinfo($originName, PATHINFO_FILENAME);
               $extension = $image->getClientOriginalExtension();
               $fileName =$fileName.time().'.'.$extension;

               $image->move(public_path('landing_sliders'), $fileName);
               $image_data[]=['image'=>$fileName];
           }

           if (!empty($image_data)) {
                $updatePage->images()->createMany($image_data);
           }

       }

       $updatePage->update($data);
       
       $notification = trans('admin_validation.Update Successfully');
       $notification = array('messege'=>$notification,'alert-type'=>'success');
       return redirect()->back()->with($notification);
    }


    public function destroy(Request $request, $id)
    {
      	if(auth()->user()->can('product.landingPage.delete')){
            abort(403, 'Unauthorized action.');
        } 
      
        $single_page = LandingPage::with('images')->find($id);

        if($single_page)
        {
            deleteImage('landing_pages', $single_page->image);
        }

        if ($single_page->images()->count() >= 1) {
            foreach ($single_page->images as $key => $slider_image) {
               deleteImage('landing_sliders', $slider_image);
            }
        }

        $single_page->delete();
        
        $notification = trans('admin_validation.Deleted Successfully');
       $notification = array('messege'=>$notification,'alert-type'=>'success');
       return redirect()->back()->with($notification);

        

    }
    
}
