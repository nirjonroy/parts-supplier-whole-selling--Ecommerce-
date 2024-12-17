<!DOCTYPE html>
<html lang="en">
    @include('frontend.partials.head')

    
<body>

    @include('frontend.partials.header')
    @php $cart = session()->get('cart', []); @endphp
    <!-- @include('frontend.partials.sidebar') -->
    <main>
        @yield('content')
    </main>
    

    @include('frontend.partials.footer')

