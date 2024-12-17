<?php

namespace App\Http\Controllers\User;
use App\Providers\PusherConfig;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BannerImage;
use App\Models\Message;
use App\Models\PusherCredentail;
use App\Models\Vendor;
use Pusher;
use Auth;
use App\Events\UserToSellerMessage;

class MessageController extends Controller
{

    public function __construct(){
        $this->middleware('auth:web');
    }
    public function index(){
        $auth = Auth::guard('web')->user();
        $defaultProfile = BannerImage::whereId('15')->first();
        $sellers = Message::with('seller')->where(['customer_id' => $auth->id])->select('seller_id')->groupBy('seller_id')->orderBy('id','desc')->get();

        return view('user.chat_list',compact('sellers','defaultProfile','auth'));
    }

    public function sendMessage(Request $request){

        $auth = Auth::guard('web')->user();
        $message = new Message();
        $message->seller_id = $request->seller_id;
        $message->customer_id = $auth->id;
        $message->message = $request->message;
        $message->send_customer = $auth->id;
        $message->save();

        $data = ['seller_id' => $request->seller_id, 'customer_id' => $auth->id];
        $user = User::find($request->seller_id);
        event(new UserToSellerMessage($user, $data));
        $id = $request->seller_id;
        $seller = User::find($id);
        $messages = Message::where(['customer_id' => $auth->id, 'seller_id'=> $request->seller_id])->get();
        $defaultProfile = BannerImage::whereId('15')->first();

        return view('user.chat_message_list', compact('seller','auth','messages','defaultProfile'));

    }

    public function loadNewMessage($id){
        $auth = Auth::guard('web')->user();
        $seller = User::find($id);
        $unRead = Message::where(['customer_id' => $auth->id, 'seller_id' => $seller->id])->update(['customer_read_msg' => 1]);

        $messages = Message::where(['customer_id' => $auth->id, 'seller_id'=>$id])->get();
        $defaultProfile = BannerImage::whereId('15')->first();
        return view('user.chat_message_list', compact('seller','auth','messages','defaultProfile'));
    }


    public function loadChatBox($id){
        $seller = User::find($id);
        $auth = Auth::guard('web')->user();
        $unRead = Message::where(['customer_id' => $auth->id, 'seller_id' => $seller->id])->update(['customer_read_msg' => 1]);
        $messages = Message::where(['customer_id' => $auth->id, 'seller_id'=>$id])->get();
        $defaultProfile = BannerImage::whereId('15')->first();
        return view('user.chat_box', compact('seller','auth','messages','defaultProfile'));
    }

    public function chatWithSeller($slug){
        $auth = Auth::guard('web')->user();
        $seller = Vendor::where('slug', $slug)->first();
        if($auth->id == $seller->user_id){
            $notification = trans('Something Went Wrong');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back();
        }else{
            $message = new Message();
            $message->seller_id = $seller->user_id;
            $message->customer_id = $auth->id;
            $message->message = $seller->greeting_msg;
            $message->send_seller = $seller->user_id;
            $message->save();
            return redirect()->route('user.message');
        }
    }
}
