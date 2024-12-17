<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\Captcha;
use Auth;
use App\Mail\UserRegistration;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use App\Models\TwilioSms;
use Mail;
use Str;
use Exception;

use Twilio\Rest\Client;

class RegisterController extends Controller
{

    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest:api');
    }

    public function storeRegister(Request $request){
        
        $setting = Setting::first();
        $enable_phone_required = $setting->phone_number_required;

        $rules = [
            'name'=>'required',
            'agree'=>'required',
            'email'=>'required|unique:users',
            'phone'=> $enable_phone_required == 1 ? 'required|unique:users' : '',
            'password'=>'required|min:4|confirmed',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'name.required' => trans('Name is required'),
            'email.required' => trans('Email is required'),
            'email.unique' => trans('Email already exist'),
            'password.required' => trans('Password is required'),
            'password.min' => trans('Password must be 4 characters'),
            'password.confirmed' => trans('Confirm password does not match'),
            'agree.required' => trans('Consent filed is required'),
            'phone.required' => trans('Phone number is required'),
            'phone.unique' => trans('Phone number already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone ? $request->phone : '';
        $user->agree_policy = $request->agree ? 1 : 0;
        $user->password = Hash::make($request->password);
        $user->verify_token = random_int(100000, 999999);;
        $user->save();

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',4)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{user_name}}',$request->name,$message);
        Mail::to($user->email)->send(new UserRegistration($message,$subject,$user));

        if($enable_phone_required == 1){
            $template = SmsTemplate::where('id',1)->first();
            $message = $template->description;
            $message = str_replace('{{user_name}}',$user->name,$message);
            $message = str_replace('{{otp_code}}',$user->verify_token,$message);

            $twilio = TwilioSms::first();
            if($twilio->enable_register_sms == 1){
                try{
                    $account_sid = $twilio->account_sid;
                    $auth_token = $twilio->auth_token;
                    $twilio_number = $twilio->twilio_phone_number;
                    $recipients = $user->phone;
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($recipients,
                            ['from' => $twilio_number, 'body' => $message] );
                }catch(Exception $ex){

                }
            }
        }

        // $notification = trans('Register Successfully. Please Verify your email');
        return back()->with("Register Successfully. Please Login");
        // return response()->json(['notification' => $notification]);
    }

    public function resendRegisterCode(Request $request){

        $setting = Setting::first();
        $enable_phone_required = $setting->phone_number_required;

        $rules = [
            'email'=>'required',
            'phone'=> $enable_phone_required == 1 ? 'required' : '',
            'phone.required' => trans('Phone number is required'),
        ];

        $customMessages = [
            'email.required' => trans('Email is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('email', $request->email)->first();
        if($user){
            if($user->email_verified == 0){
                MailHelper::setMailConfig();

                $template=EmailTemplate::where('id',4)->first();
                $subject=$template->subject;
                $message=$template->description;
                $message = str_replace('{{user_name}}',$user->name,$message);
                Mail::to($user->email)->send(new UserRegistration($message,$subject,$user));

                if($enable_phone_required == 1){
                    $template=SmsTemplate::where('id',1)->first();
                    $message=$template->description;
                    $message = str_replace('{{user_name}}',$user->name,$message);
                    $message = str_replace('{{otp_code}}',$user->verify_token,$message);

                    $twilio = TwilioSms::first();
                    if($twilio->enable_register_sms == 1){
                        try{
                            $account_sid = $twilio->account_sid;
                            $auth_token = $twilio->auth_token;
                            $twilio_number = $twilio->twilio_phone_number;
                            $recipients = $user->phone;
                            $client = new Client($account_sid, $auth_token);
                            $client->messages->create($recipients,
                                    ['from' => $twilio_number, 'body' => $message] );
                        }catch(Exception $ex){

                        }
                    }
                }

                $notification = trans('Register Successfully. Please Verify your email');
                return response()->json(['notification' => $notification]);

            }else{
                $notification = trans('Already verfied your account');
                return response()->json(['notification' => $notification],402);
            }
        }else{
            $notification = trans('Email does not exist');
            return response()->json(['notification' => $notification],402);
        }

    }


    public function userVerification($token){
        $user = User::where('verify_token',$token)->first();
        if($user){
            $user->verify_token = null;
            $user->status = 1;
            $user->email_verified = 1;
            $user->save();
            $notification = trans('Verification Successfully');
            return response()->json(['notification' => $notification],200);
        }else{
            $notification = trans('Invalid token');
            return response()->json(['notification' => $notification],400);
        }
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
