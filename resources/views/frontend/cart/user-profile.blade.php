@extends('frontend.app')
@section('title', 'Home')

@section('content')

<section class="py-10 bg-gray-100 p-6 flex justify-center items-center">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8">
  
      <!-- Profile Header -->
      <div class="flex items-center space-x-4 border-b pb-6 mb-6">
        <img src="https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=" alt="Profile Picture" class="w-24 h-24 rounded-full border">
       <div class="flex flex-col lg:flex-row gap-5 justify-center items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{Auth()->user()->name}}</h2>
            <p class="text-gray-600">{{Auth()->user()->email}}</p>
            <p class="text-sm text-gray-500">Joined: {{Auth()->user()->created_at}}</p>
          </div>
          
       </div>
      </div>
  
      <!-- Profile Info Section -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Basic Information -->
        <div class="bg-gray-50 p-4 rounded-lg shadow">
          <a href="{{url('edituser-profile')}}"><i class="fas fa-edit"></i></a>
          <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic Information</h3>
          <p><span class="font-medium text-gray-700">Full Name:</span> {{Auth()->user()->name}}</p>
          <p><span class="font-medium text-gray-700">Phone:</span> {{Auth()->user()->phone}}</p>
          <p><span class="font-medium text-gray-700">Address:</span> {{Auth()->user()->address}}</p>
        </div>
  
        <!-- Account Settings -->
       
      </div>
  
      <!-- Recent Orders Section -->
      <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Orders</h3>
        <div class="space-y-4">
          
          <!-- Order 1 -->
          @forelse($orders as $order)
          <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
            <div>
              <p class="font-medium text-gray-700">Order #{{ $order->order_id }}</p>
              <p class="text-gray-600">Date: {{ \Carbon\Carbon::parse($order->created_at)->format('j M Y / H:i:s') }}</p>
              <p class="text-gray-600">Total Amount : ${{ $order->total_amount }}</p>
            </div>
            <a href="{{ route('front.order.show', [$order->id] ) }}">

                <button class="bg-blue-800 text-white px-2 py-2 lg:px-4 lg:py-2 text-sm lg:text-base rounded-md hover:bg-blue-700 transition duration-200">View Details</button>
            </a>
          </div>
          @empty
                <tr>
                    <td colspan="5">
                        <strong class="text-danger text-center">No orders are available!</strong>
                    </td>
                </tr>
                @endforelse
          
          
        </div>
      </div>
  
      <!-- Logout Button -->
      <div class="text-right">
        <a href="{{url('logout')}}" class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-500 transition duration-200">Logout</a>
      </div>
      
    </div>
  </section>


<!--              <div class="row">-->
<!--                 <div class="col-12">-->
<!--                    <div class="login-reg-tabs">-->
<!--                       <ul class="nav nav-tabs" id="myTab" role="tablist">-->

<!--                          <li class="nav-item" role="presentation"><button class="nav-link" id="reg-tab" data-bs-toggle="tab" data-bs-target="#reg-tab-pane" type="button" role="tab" aria-controls="reg-tab-pane" aria-selected="true">Update Profile</button></li>-->
<!--                       </ul>-->
<!--                       <div class="tab-content" id="myTabContent">-->
<!--                          {{-- <div class="tab-pane fade active show" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">-->
<!--                             <form action="{{url('login')}}" method="POST">-->
<!--                                @csrf-->
<!--                                <div class="form-group">-->
<!--                                    <input type="email" name="email" class="form-control" placeholder="Enter email / phone number">-->
<!--                                    @if($errors->has('email'))-->
<!--                                        <span class="help-block text-danger">-->
<!--                                            <strong>{{ $errors->first('email') }}</strong>-->
<!--                                        </span>-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <input type="password" class="form-control" id="psw" name="password"  required>-->
<!--                                    @if($errors->has('password'))-->
<!--                                        <span class="help-block text-danger">-->
<!--                                            <strong>{{ $errors->first('password') }}</strong>-->
<!--                                        </span>-->
<!--                                    @endif-->
<!--                                </div>-->
<!--                                <input type="checkbox" name="remember" id="remember" class=""> &nbsp; Keep me logged in-->
<!--                                <button type="submit" class="btn btn-primary login-btn">Login Now</button>-->
<!--                                <div class="w-100 text-center">-->
<!--                                    <a class="forget-pass" data-bs-toggle="modal" href="#forget-pass">Forgot your password?</a>-->
<!--</button>-->
<!--                                </div>-->
<!--                             </form>-->
<!--                             <div class="modal fade" id="forget-pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">-->
<!--                                <div class="modal-dialog">-->
<!--                                   <div class="modal-content">-->
<!--                                      <div class="modal-header">-->
<!--                                         <h1 class="modal-title fs-5" id="staticBackdropLabel">Forgot Password</h1>-->
<!--                                      </div>-->
<!--                                      <div class="modal-body" id="forgot_modal_body">-->
<!--                                         <label for="">Email/Phone</label><input type="text" name="email_or_phone" class="form-control" placeholder="Enter email / phone number">-->
<!--                                         <div class="text-danger"></div>-->
<!--                                         <small>please enter the email/phone that register here.</small>-->
<!--                                      </div>-->
<!--                                      <div class="modal-footer" id="forgot_modal_footer"><button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-outline-dark">Send Code</button></div>-->
<!--                                   </div>-->
<!--                                </div>-->
<!--                             </div>-->
<!--                             <ul class="nav social-login-nav">-->
<!--                                <li class="nav-item"></li>-->
<!--                             </ul>-->
<!--                          </div> --}}-->
<!--                          <div class="tab-pane fade active show" id="reg-tab-pane" role="tabpanel" aria-labelledby="reg-tab" tabindex="0">-->
<!--                             <form action="{{url('profile-update')}}" method="POST">-->
<!--                                @csrf-->
<!--                                <div class="row g-0">-->
<!--                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">-->
<!--                                       <input type="text" class="form-control mb-0" placeholder="Enter Your name" name="name" value="{{Auth()->user()->name}}">-->
<!--                                        @if ($errors->has('name'))-->
<!--                                            <span class="help-block text-danger">-->
<!--                                                <strong>{{ $errors->first('name') }}</strong>-->
<!--                                            </span>-->
<!--                                        @endif-->
<!--                                        <div class="text-danger mb-3"></div>-->
<!--                                    </div>-->
<!--                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 " id="phone-code">-->
<!--                                       <input type="text" class="form-control mb-0" placeholder="01XXXXXXXXX" name="phone" value="{{Auth()->user()->phone}}">-->
<!--                                       @if ($errors->has('phone'))-->
<!--                                            <span class="help-block text-danger">-->
<!--                                                <strong>{{ $errors->first('phone') }}</strong>-->
<!--                                            </span>-->
<!--                                        @endif-->
<!--                                        <div class="text-danger mb-3"></div>-->
<!--                                    </div>-->
<!--                                   <div class="col-md-12 " id="email">-->
<!--                                      <input type="email" name="email" class="form-control " placeholder="Enter email address (example@example.com)" value="{{Auth()->user()->email}}">-->
<!--                                        @if ($errors->has('email'))-->
<!--                                            <span class="help-block text-danger">-->
<!--                                                <strong>{{ $errors->first('email') }}</strong>-->
<!--                                            </span>-->
<!--                                        @endif-->
<!--                                   </div>-->
<!--                                   <div class="text-danger"></div>-->

<!--                                   <div class="col-md-12 " id="address">-->
<!--                                    <textarea name="address" id="" cols="50" rows="10">-->
<!--                                        {{Auth()->user()->address}}-->
<!--                                    </textarea>-->
<!--                                      @if ($errors->has('address'))-->
<!--                                          <span class="help-block text-danger">-->
<!--                                              <strong>{{ $errors->first('address') }}</strong>-->
<!--                                          </span>-->
<!--                                      @endif-->
<!--                                 </div>-->
<!--                                 <div class="text-danger"></div>-->

<!--                                </div>-->
<!--                                {{-- <div class="form-group">-->
<!--                                   <input type="password" name="password" class="form-control" id="psw" placeholder="Enter Password (Minimum 8 Charactar)"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>-->

<!--                                   @if ($errors->has('password_confirmation'))-->
<!--                                        <span class="help-block text-danger">-->
<!--                                            <strong>{{ $errors->first('password_confirmation') }}</strong>-->
<!--                                        </span>-->
<!--                                    @endif-->
<!--                                    <div class="text-danger mb-3"></div>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <input type="password" name="password_confirmation" class="form-control" id="psw" placeholder="Enter confirm-password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>-->
<!--                                </div> --}}-->
<!--                                <button type="submit" class="btn btn-primary login-btn mt-0">create account</button>-->
<!--                             </form>-->
<!--                             <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">-->
<!--                                <div class="modal-dialog">-->
<!--                                   <div class="modal-content">-->
<!--                                      <div class="modal-header">-->
<!--                                         <h1 class="modal-title fs-5" id="staticBackdropLabel">Verification Code</h1>-->
<!--                                      </div>-->
<!--                                      <div class="modal-body">-->
<!--                                         <label for="">Code</label><input type="text" class="form-control" placeholder="verification code">-->
<!--                                         <div class="text-danger"></div>-->
<!--                                         <small>please check your number for the verification code.</small>-->
<!--                                      </div>-->
<!--                                      <div class="modal-footer"><button type="button" class="btn btn-outline-dark">Resend</button><button type="button" class="btn btn-outline-dark">Verify</button></div>-->
<!--                                   </div>-->
<!--                                </div>-->
<!--                             </div>-->
<!--                          </div>-->
<!--                       </div>-->
<!--                    </div>-->
<!--                 </div>-->
<!--              </div>-->



@endsection

@push('js')


@endpush
