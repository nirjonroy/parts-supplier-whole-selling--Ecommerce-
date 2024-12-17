
<aside class="open">
        <div class="overlay-wrapper">
            <div class="sidebar-overlay"></div>
        </div>
        <div class="menuWrapper">
            <div>
                <div class="topMenu vertical">
                    <div class="menu-container">
                        <div class="menu">
                            <div class="store-menu">
                                <div class="store-menu-block">

                                @foreach(popularCategories() as $cat)
                                    <a href="{{ route('front.shop', [
                                                    'type' => 'subcategory',
                                                    'slug'=> $cat->category->slug
                                                ] ) }}">
                                        <div class="store-item selected">
                                            <img src="{{ asset($cat->category->image) }}" width="20px" height="20px">
                                            <h5 class="name">{{ $cat->category->name }}</h5>
                                        </div>
                                    </a>
                                @endforeach
                                </div>
                            </div>
                            <ul class="misc-menu d-none">
                                <li class="unselected">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                    'slug'=> 'coupons'
                                                ] ) }}">
                                            <span>Coupons</span>
                                        </a>
                                    </div>
                                </li>
                                <li class="selected d-none">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                    'slug'=> 'offers'
                                                ] ) }}">
                                            <span>Offers</span>
                                            <span class="nav-count-label">
                                                <span>64</span>
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                <li class="unselected d-none">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                    'slug'=> 'egg-club'
                                                ] ) }}">
                                            <span>Egg Club</span>
                                        </a>
                                    </div>
                                </li>
                                <li class="unselected dailyDeals d-none">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                'slug'=> 'daily-deals'
                                            ] ) }}">
                                            <span>Daily Deals</span>
                                            <img src="{{ asset('frontend/images/others/DailyDeal.gif') }}" alt="" class="menu-img">
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="favourite-menu d-none">
                                <li class="unselected topLevel">
                                    <img src="{{ asset('frontend/images/svg/love.svg') }}" alt="icon" class="MenuItemIcons">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                    'slug'=> 'favorites'
                                                ] ) }}">Favorites</a>
                                    </div>
                                </li>
                            </ul>
                            <ul class="hasSelection">
                                <li class="unselected topLevel">
                                    <img src="{{ asset('frontend/images/others/popular.webp') }}" alt="icon" class="MenuItemIcons">
                                    <div class="name">
                                        <a href="{{ route('front.popular') }}">Top Selling Product</a>
                                    </div>
                                </li>
                                <li class="unselected topLevel">
                                    <img src="{{ asset('frontend/images/others/flash-sales.webp') }}" alt="icon" class="MenuItemIcons">
                                    <div class="name">
                                        <a href="{{ route('front.flash-sell') }}">Flash Sell</a>
                                    </div>
                                </li>
                                <hr>
                                <h6>Our Categories</h6>
                                @forelse(categories() as $key => $item)
                                <li class="unselected topLevel">
                                    <img src="{{ asset($item->image) }}" alt="icon" class="MenuItemIcons">
                                    <div class="name level">
                                        <a href="{{ $item->activeSubCategories->count() <= 0 ? route('front.shop', [
                                            'slug'=> $item->slug
                                        ] ) : '#'}}"><span>{{ $item->name }}</span>
                                            @if($item->activeSubCategories->count())
                                                <i class="fas fa-angle-right"></i>
                                            @endif
                                        </a>
                                    </div>
                                    @if($item->activeSubCategories->count())
                                    <ul class="level-1 hasSelection">
                                        @foreach($item->activeSubCategories as $key => $item)
                                        <li class="unselected level">
                                            <div class="name">
                                                <a href="{{ $item->activeChildCategories->count() <= 0 ? route('front.subcategory', [
                                            'type'=>'childcategory',
                                            'slug'=> $item->slug
                                        ] ) : '#'}}">
                                                    <span>{{ $item->name }}</span>
                                                    @if($item->activeChildCategories->count())
                                                        <i class="fas fa-angle-right"></i>
                                                    @endif
                                                </a>
                                            </div>
                                            @if($item->activeChildCategories->count())
                                            <ul class="">
                                                @foreach($item->activeChildCategories as $key => $item)
                                                <li class="unselected level">
                                                    <div class="name">
                                                        <a href="{{ route('front.shop', [
                                                                'slug'=> $item->slug
                                                            ] ) }}">
                                                            <span>{{ $item->name }}</span>
                                                        </a>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @empty
                                <div>
                                    <strong class="text-center text-danger">
                                        No
                                    </strong>
                                </div>
                                @endforelse
                            </ul>
                            <ul class="bottom-misc-menu">
                                <h6>Our Brands</h6>
                                @foreach(brands() as $brand)
                                <li class="unselected topLevel">
                                    <img src="{{ asset($brand->logo) }}" alt="icon" class="MenuItemIcons">
                                    <div class="name">
                                        <a href="{{ route('front.product.brand-product', [$brand->slug] ) }}">
                                            {{ $brand->name }}</a>
                                    </div>
                                </li>
                                @endforeach
                                <li class="unselected topLevel d-none">
                                    <img src="{{ asset('frontend/images/others/food.webp') }}" alt="icon" class="MenuItemIcons">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                    'slug'=> 'premium-care'
                                                ] ) }}">Premium Care</a>
                                    </div>
                                </li>
                                <li class="unselected topLevel d-none">
                                    <img src="{{ asset('frontend/images/others/food.webp') }}" alt="icon" class="MenuItemIcons">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                    'slug'=> 'food-aid'
                                                ] ) }}">Food Aid</a>
                                    </div>
                                </li>
                                <li class="unselected topLevel d-none">
                                    <img src="{{ asset('frontend/images/others/food.webp') }}" alt="icon" class="MenuItemIcons">
                                    <div class="name">
                                        <a href="{{ route('front.shop', [
                                                    'slug'=> 'recipes'
                                                ] ) }}">Recipes</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="quick-access-menu d-none">
                            <a href="" class="help">
                                <svg width="20px" height="20px" style="display:inline-block;vertical-align:middle;" viewBox="0 0 512 512"><path fill="url(#paint0_linear_1006_2150)" d="M256 42.666C138.24 42.666 42.667 138.24 42.667 256S138.24 469.333 256 469.333 469.333 373.76 469.333 256 373.76 42.666 256 42.666zm21.333 362.667h-42.666v-42.666h42.666v42.666zM321.493 240l-19.2 19.627C286.933 275.2 277.333 288 277.333 320h-42.666v-10.667c0-23.466 9.6-44.8 24.96-60.373l26.453-26.88c7.893-7.68 12.587-18.347 12.587-30.08 0-23.467-19.2-42.667-42.667-42.667-23.467 0-42.667 19.2-42.667 42.667h-42.666c0-47.147 38.186-85.333 85.333-85.333s85.333 38.186 85.333 85.333c0 18.773-7.68 35.84-19.84 48z"></path><defs><linearGradient id="paint0_linear_1006_2150" x1="256" x2="256" y1="42.666" y2="469.333" gradientUnits="userSpaceOnUse"><stop stop-color="#FD4A85"></stop><stop offset="1" stop-color="#FF9D8C"></stop></linearGradient></defs></svg>
                                <span>Help</span>
                            </a>
                            <div class="complaint">
                                <svg width="20px" height="20px" style="display:inline-block;vertical-align:middle;" viewBox="0 0 20.103 20.733"><g id="dislike" transform="translate(-7.77)"><path id="Path_1" data-name="Path 1" d="M164.107,16.47a8.448,8.448,0,0,1-1.625-2.007.529.529,0,0,1,.151-.692,7.615,7.615,0,1,0-11.152-9.833l8.246,11.45A10.853,10.853,0,0,0,163.845,17,.308.308,0,0,0,164.107,16.47Z" transform="translate(-137.893)" fill="#dfebfa"></path><path id="Path_2" data-name="Path 2" d="M159.493,92.684l7.921,11a9.064,9.064,0,0,0,1.173.674,7.621,7.621,0,0,0-9.094-11.674Z" transform="translate(-145.579 -88.296)" fill="#b1dbfc"></path><path id="Path_3" data-name="Path 3" d="M15.384,92.023A7.615,7.615,0,0,0,10.9,105.794a.529.529,0,0,1,.151.692,8.449,8.449,0,0,1-1.625,2.007.308.308,0,0,0,.262.531,10.762,10.762,0,0,0,4.242-1.7.751.751,0,0,1,.526-.128,7.615,7.615,0,1,0,.925-15.173Z" transform="translate(0 -88.297)" fill="#ff656f" ></path><path id="Path_4" data-name="Path 4" d="M11.077,108.493a8.448,8.448,0,0,0,1.625-2.007.529.529,0,0,0-.151-.692,7.615,7.615,0,0,1,3.656-13.727,7.7,7.7,0,0,0-.823-.044A7.615,7.615,0,0,0,10.9,105.794a.529.529,0,0,1,.151.692,8.448,8.448,0,0,1-1.625,2.007.308.308,0,0,0,.262.531,12.251,12.251,0,0,0,1.285-.3A.3.3,0,0,1,11.077,108.493Z" transform="translate(0 -88.297)" fill="#ff4756"></path><g id="Group_1" data-name="Group 1" transform="translate(10.893 8.487)"><path id="Path_5" data-name="Path 5" d="M88.094,211.653a.313.313,0,0,1-.313-.313,1.125,1.125,0,1,0-2.25,0,.313.313,0,0,1-.626,0,1.751,1.751,0,1,1,3.5,0A.313.313,0,0,1,88.094,211.653Z" transform="translate(-84.906 -209.589)" fill="#fc2d39"></path><path id="Path_6" data-name="Path 6" d="M223.451,211.653a.313.313,0,0,1-.313-.313,1.125,1.125,0,1,0-2.25,0,.313.313,0,0,1-.626,0,1.751,1.751,0,0,1,3.5,0A.313.313,0,0,1,223.451,211.653Z" transform="translate(-214.782 -209.589)" fill="#fc2d39"></path><path id="Path_7" data-name="Path 7" d="M106.776,321.589a.312.312,0,0,1-.225-.1,4.678,4.678,0,0,0-6.742,0,.313.313,0,0,1-.451-.434,5.3,5.3,0,0,1,7.644,0,.313.313,0,0,1-.225.53Z" transform="translate(-98.689 -314.984)" fill="#fc2d39"></path></g></g></svg>
                                <span>File a complaint</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
