<?php

namespace App\Http\Controllers\WEB\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Auth, Hash, Image, File, Str;
class AuthController extends Controller
{
  
    public function login1(Request $request)
    {
      
        $data = $request->validate([          
           'phone' => ['required']
        ]);      
      
        
        $user=User::where('phone', request()->phone)->first();
      
        if($user)
        {
        	$date = date('Y-m-d H:i:s');
        $date = strtotime($date);
        $date = strtotime("+3 minute", $date);
        $new_date=date('Y-m-d H:i:s', $date);
        $otp=rand(100000,999999);     
      
      
        $data['otp_verify']=$otp;
        $data['exp_time']=$new_date;
        
        session()->put('user_data', $data);        
        $number=request('phone');        
        $msg='Your One-Time PIN is '.$otp.'. It will expire in 3 minutes.Visit softitsecurity.com';     
        
     
          
         $data =[
            'apikey' => '4ead72bf4b389811',
            'secretkey' => 'd62f0867',
            'callerID' => '1234',
            'toUser' => $number,
            'messageContent' => $msg
    ];      
      
        $query = http_build_query($data);
        $url = "http://217.172.190.215/sendtext?$query";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $done =  curl_exec($ch);    
        curl_close($ch);
        $res = json_decode($done);   
       
       
        if (isset($res->Status) && ($res->Status =='0')) {
          return response()->json([
          	 'status' => true,
             'msg' => 'Success'             
          ]);
            
        }else{
            dd('failure');die();
        } 
        } else {
          	return response()->json([
            	'status' => false,
                'msg' => 'Wrong Information'
            ]);
        }     
       
      
    }
   
    public function optVerify(Request $request){           
      
        $user_data=session()->get('user_data');
        date_default_timezone_set("Asia/Dhaka");        
        
        if(empty($user_data)){
            return redirect()->route('login');
        }
        
        $exp_date = date('Y-m-d H:i:s');   
       
        if(request('submit_button')=='Save'){
           
            request()->validate([
                'otp_verify' => 'required',
            ]);
            
            if($user_data['otp_verify'] != request('otp_verify')){
               
              	return response()->json([
                  'status' => false,
                  'msg' => 'PIN Is Not Match. please try again !',
                ]);
              
            }
            
            if($user_data['exp_time']<$exp_date){
              	return response()->json([
                  'status' => false,
                  'msg' => 'Time Is Expired !',
                ]);
            }
            
            $user=User::where('phone', $user_data['phone'])->first();

            if($user){              
                
                Auth::loginUsingId($user->id);
                session()->put('user_data',[]);
                
                if(auth()->user()->type=='1'){
                    session()->put('cart',[]);
                } 
              
                
                return response()->json([
                  'status' => true,
                  'msg' => 'Login success',
                  'url' => route('front.home')
                ]);
                //return redirect(url('/checkouts'))->with('success_msg', 'Login Success!');              
              
            }else{
                $user=$this->createUser($user_data);
                if($user){
                    Auth::loginUsingId($user->id);
                    session()->put('user_data',[]);
                    return response()->json([
                    	'status' => true,
                        'msg' => 'Login Success',
                        'url' => url('/checkouts')
                    ]);
                    // return redirect(url('/checkouts'))->with('success_msg', 'Login Success!');
                }else{                    
                    return back()->with('error_msg', 'Something Went Wrong . try again !');
                }
            }
        } else if(request('submit_button')=='Resend'){          
            
            $date = date('Y-m-d H:i:s');
            $date = strtotime($date);
            $date = strtotime("+3 minute", $date);
            $new_date=date('Y-m-d H:i:s', $date);
            $otp=rand(100000,999999);
            $user_data['exp_time']=$new_date;
            $user_data['otp_verify']=$otp;
            session()->put('user_data', $user_data);
            $number=$user_data['phone'];
            $msg='Your One-Time PIN is '.$otp.'. It will expire in 3 minutes.Visit softitsecurity.com';
          
            $data =[
            'apikey' => '4ead72bf4b389811',
            'secretkey' => 'd62f0867',
            'callerID' => '1234',
            'toUser' => $number,
            'messageContent' => $msg
    ];      
      
        $query = http_build_query($data);
        $url = "http://217.172.190.215/sendtext?$query";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $done =  curl_exec($ch);    
        curl_close($ch);
        $res = json_decode($done);       
    
          
          
          	if (isset($res->Status) && ($res->Status =='0')) {
                return response()->json([
                	'status' => true,
                    'msg' => 'PIN Is Send Check Your Phone',
                	'url' => route('front.getOpt')
                ]);
           		// return redirect()->route('front.getOpt')->with('status','PIN Is Send Check Your Phone');
            }else{
              return response()->json([
              		'error_msg' => 'OTP Is Send Check Your Phone'
              ]);
            //  return back()->with('error_msg','OTP Is Send Check Your Phone');
          	}       
            
            
        }
    }
  
    function SendSms($number=null,$message=null){
  	$data =[
            'apikey' => '4ead72bf4b389811',
            'secretkey' => 'd62f0867',
            'callerID' => '1234',
            'toUser' => $number,
            'messageContent' => $message
    ];
    
    $query = http_build_query($data);
    $url = "http://217.172.190.215/sendtext?$query";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $done =  curl_exec($ch);
    
    
    curl_close($ch);
    return $done;
    
}

    public function logout(Request $request)
    {
        Auth::logout();
        
        return redirect()->route('front.home');
    }
    
    
    
    public function logpage(){
        return view('frontend.cart.user-log');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }
    
        // Return back with a session error message
        return redirect()->back()->with('error', 'Invalid email or password')->withInput();
    }
    
    public function regpage(){
        return view('frontend.cart.user-reg');
    }
    
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if($user)
        {
            Auth::login($user);

            // return response()->json([
            //     'status' => true,
            //     'msg' => 'Register success',
            //     'url' => route('front.home'),
            // ], 200);
            
            return redirect()->route('front.home');
        
        }

        return response()->json([
            'status' => false,
            'msg' => 'Something went wrong!',
        ], 422);
        // return back()->route('front.home');

    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        if(Hash::check($request->old_password, Auth::user()->password))
        {
            $user = User::findOrFail(Auth::id());
            $data = $user->update([
                'password' => Hash::make($request->password)
            ]);

            // dd($data);

            return response()->json([
                'status' => true,
                'msg' => 'Password updated',
            ], 200);

        }

        return response()->json([
            'status' => false,
            'msg' => 'Old password is incorrect!',
        ]);

    }    
    
    public function user_profile(){
        $orders = Order::with('orderProducts')->where('user_id', Auth::id())->latest()->limit(5)->get();
        return view('frontend.cart.user-profile', compact('orders'));
    }

    public function editUser_profile(){
        return view('frontend.cart.editUser-profile');
    }
    
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', 'unique:users,phone,'.Auth()->user()->id],
            'address' => ['required'],
        ]);

        if($request->hasFile('image'))
        {
            $old_image = Auth::user()->image;
            $user_image = $request->image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $data['image'] = $image_name;

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $user = User::findOrFail(Auth::id());
        $user->update($data);

        return response()->json([
            'status' => true,
            'msg' => 'Profile Updated',
        ], 200);

    }
}
