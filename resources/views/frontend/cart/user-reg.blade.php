@extends('frontend.app')
@section('title', 'Home')

@section('content')
<section class="flex items-center justify-center py-10 bg-gray-100 px-4">
  <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Create Your Account</h2>

    <form action="{{url('register')}}" method="POST">
      @csrf
      <!-- Full Name Input -->
      <div class="mb-4">
        <label for="fullname" class="block text-gray-700 font-semibold mb-2">Full Name</label>
        <input type="text" id="fullname" name="name" required class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="John Doe">
        @if ($errors->has('name'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>

      <div class="mb-4">
        <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone</label>
        <input type="text" id="phone" name="phone" required class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="912xxxxxxxxxxxxxx">
        @if ($errors->has('phone'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
      </div>

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
      
      <div class="mb-4">
        <label for="address" class="block text-gray-700 font-semibold mb-2">address</label>
        
        <textarea name="address" class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your Address" id="" cols="40" rows="10"></textarea>
        @if ($errors->has('address'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
      </div>

      <!-- Password Input -->
      <div class="mb-4">
        <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
        <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your password">
      </div>

      <!-- Confirm Password Input -->
      <div class="mb-6">
        <label for="confirm_password" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
        <input type="password" id="confirm_password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Confirm your password">
      </div>
      @if ($errors->has('password_confirmation'))
          <span class="help-block text-danger">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
          </span>
      @endif
      <!-- Register Button -->
      <button type="submit" class="w-full bg-blue-800 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">Register</button>
    </form>

    <!-- Login Link for Existing Users -->
    <div class="mt-6 text-center">
      <p class="text-gray-700">Already have an account? 
        <a href="{{route('front.user-log')}}" class="text-blue-600 font-semibold hover:underline">Log in here</a>
      </p>
    </div>
  </div>
</section>
			


@endsection

@push('js')
{{-- <script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script> --}}

@endpush