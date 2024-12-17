@extends('frontend.app')
@section('title', 'Home')
@push('css')

<link rel="stylesheet" href="{{asset('frontend/assets/css/login.css')}}">
@endpush
@section('content')

<!--<h3>Login User</h3>-->
<!--<p>Try to submit the form.</p>-->

<section class="flex items-center justify-center py-10 bg-gray-100 px-4">
   <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
     <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login to Your Account</h2>
     
     <form action="{{url('login')}}" method="POST">
      @csrf
       <!-- Email Input -->
       <div class="mb-4">
         <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
         <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="you@example.com">
         @if ($errors->has('email'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
 
       <!-- Password Input -->
       <div class="mb-6">
         <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
         <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your password">
         
         @if ($errors->has('password'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
 
       <!-- Login Button -->
       <button type="submit" class="w-full bg-blue-800 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">Log In</button>
       
      
     </form>
     
     <!-- Registration Link for New Users -->
     <div class="mt-6 text-center">
       <p class="text-gray-700">Don't have an account? 
         <a href="{{route('front.user-reg')}}" class="text-blue-600 font-semibold hover:underline">Register here</a>
       </p>
     </div>
   </div>
 </section>


@endsection

@push('js')


@endpush