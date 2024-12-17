<header
      class="border-b bg-white font-sans min-h-[60px] px-4 lg:px-10 py-3 relative tracking-wide relative z-50"
    >
      <div class="flex flex-wrap items-center max-lg:gap-y-6 max-sm:gap-x-4">
        <a href="{{ route('front.home') }}"
          ><img src="{{ asset(siteInfo()->logo) }}" alt="logo" class="w-32" />
        </a>

        <div
          id="collapseMenu"
          class="max-lg:hidden lg:!flex lg:items-center max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-40 max-lg:before:inset-0 max-lg:before:z-50"
        >
          <button
            id="toggleClose"
            class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-4 fill-black"
              viewBox="0 0 320.591 320.591"
            >
              <path
                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                data-original="#000000"
              ></path>
              <path
                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                data-original="#000000"
              ></path>
            </svg>
          </button>

          <ul
            class="lg:flex lg:items-center lg:justify-center lg:gap-x-10 lg:absolute lg:left-1/2 lg:-translate-x-1/2 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-2/3 max-lg:min-w-[350px] max-lg:top-0 max-lg:left-0 max-lg:px-10 max-lg:py-4 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50"
          >
            <!-- Logo for mobile -->
            <li class="mb-6 hidden max-lg:block">
              <a href="{{ route('front.home') }}"
                ><img src="{{ asset(siteInfo()->logo) }}" alt="logo" class="w-36"
              /></a>
            </li>
            @foreach(categories() as $category)
            <ul class="navbar">
                
                    <li class="nav-item">
                        
                        <a href="javascript:void(0)" class="nav-link">{{ $category->name }}+</a>
            
                        <!-- Subcategory dropdown (only shows on hover) -->
                        @if($category->activeSubCategories->isNotEmpty())
                            <ul class="submenu z-50">
                                @foreach($category->activeSubCategories as $subCategory)
                                    <li class="submenu-item w-32 lg:w-48">
                                        <a href="javascript:void(0)" class="submenu-link">{{ $subCategory->name }} +</a>
            
                                        <!-- Child category dropdown for each subcategory -->
                                        @if($subCategory->activeChildCategories->isNotEmpty())
                                            <ul class="childmenu font-semibold w-40 lg:w-48">
                                                @foreach($subCategory->activeChildCategories as $childCategory)
                                                    <li class="childmenu-item border-b">
                                                        <a href="{{ route('front.shop', ['slug' => $childCategory->slug]) }}" class="childmenu-link">
                                                            {{ $childCategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        
                    </li>
                
            </ul>
            @endforeach 

            <!-- LG main category -->
            
          </ul>
        </div>

        <div class="flex items-center ml-auto space-x-8">
          {{-- <span class="relative">
            <i class="fa-solid fa-heart text-2xl"></i>
            <span
              class="absolute left-auto -ml-1 -top-1 rounded-full bg-red-500 px-1 py-0 text-xs text-white"
              >0</span
            >
          </span> --}}
          @php
                $cart = session()->get('cart', []);

                @endphp
          <a href="{{ route('front.cart.index') }}">
            <span class="relative">
              <i class="fa-solid fa-cart-shopping text-2xl"></i>
              @if($cart !== null)
              <span
                class="absolute left-auto -ml-1 -top-3 rounded-full bg-red-500 px-1 py-0 text-xs text-white"
                >
                {{ count($cart) }}
                </span
                @endif

              >
            </span>
          </a>
          <!-- Header Section -->
          <div class="relative group">
            <!-- User Icon -->
            <i class="fa-solid fa-user text-2xl cursor-pointer"></i>

            <!-- Dropdown Menu -->
            <div
              class="absolute -right-4 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 group-hover:visible invisible transition-opacity duration-200"
            >
              <ul class="">
                @guest
                <a href="{{url('login-user')}}">

                  <li class="px-4 py-2 border-b text-blue-600 font-semibold hover:bg-gray-100 cursor-pointer">
                    Login
                  </li>
                </a>
                @else
                <a href="{{url('profile-user')}}">

                  <li class="px-4 py-2 border-b text-blue-600 font-semibold hover:bg-gray-100 cursor-pointer">
                    Profile
                  </li>
                </a>
                <a href="{{url('order')}}">

                  <li class="px-4 py-2 border-b text-blue-600 font-semibold hover:bg-gray-100 cursor-pointer">
                    Orders
                  </li>
                </a>
                <a href="{{url('order-internal-credit')}}">

                  <li class="px-4 py-2 border-b text-blue-600 font-semibold hover:bg-gray-100 cursor-pointer">
                    Internal Credit
                  </li>
                </a>
                <a href="{{url('order-balance-sheet')}}">

                  <li class="px-4 py-2 border-b text-blue-600 font-semibold hover:bg-gray-100 cursor-pointer">
                    Balance Sheet
                  </li>
                </a>
                <a href="{{url('logout')}}">

                  <li class="px-4 py-2 border-b text-blue-600 font-semibold hover:bg-gray-100 cursor-pointer">
                    Logout
                  </li>
                </a>
                @endif
              </ul>
            </div>
          </div>

          <button id="toggleOpen" class="lg:hidden">
            <i class="fa-solid fa-bars text-3xl"></i>
          </button>
        </div>
      </div>

      <div
        class="bg-gray-100 border border-transparent focus-within:border-blue-500 focus-within:bg-transparent flex px-6 rounded-full h-10 lg:w-2/4 mt-3 mx-auto"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 192.904 192.904"
          width="16px"
          class="fill-gray-600 mr-3 rotate-90"
        >
          <path
            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"
          ></path>
        </svg>
        <form class="searchArea my-0 my-lg-0" action="{{ route('front.product.search') }}">
        <input
          type="query"
          placeholder="Search..."
          class="w-full outline-none bg-transparent text-gray-600 font-semibold text-[15px]"
        />
        <button type="submit"></button>
      </form>
      </div>
    </header>

    