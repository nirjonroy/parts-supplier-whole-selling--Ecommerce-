@extends('frontend.app')
@section('title')
{{$customPage->page_name}}
@endsection


@section('content')



<main class="pt-32">

    <div class="mb-4 md:mb-0 w-full max-w-screen-md mx-auto relative" style="height: 24em;">
      <div class="absolute left-0 bottom-0 w-full h-full z-10"
        ></div>
      {{-- <img src="images/university/3.png" class="absolute left-0 top-0 w-full rounded-lg h-full z-0 object-cover" /> --}}
      <div class="p-4 absolute bottom-0 left-0 z-20">
       
        <h2 class="text-4xl font-semibold text-black-800 leading-tight">
            {{$customPage->page_name}}
        </h2>
        
      </div>
    </div>

    <div class="px-4 lg:px-0 mt-12 text-gray-700 max-w-screen-md mx-auto text-lg leading-relaxed">
      <p class="pb-6">{!!$customPage->description!!}</p>



    </div>
  </main>


@endsection