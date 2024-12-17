<!-- header Start  -->
<header>
    <section class="header-main">
        <nav class="navbar navbar-expand-sm">
                <button class="navbar-toggler first-toggler d-block border-0 shadow-none" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="logo-main">
                    <a class="navbar-brand" href="{{ route('front.home') }}">
                        <img src="{{ asset(siteInfo()->logo) }}" alt="Logo">
                    </a>
                </div>
                <form class="searchArea my-0 my-lg-0" action="{{ route('front.product.search') }}">
                    <div class="search-input">
                        <input class="form-control me-sm-2" type="text" placeholder="Search" name="query">
                        <button class="" type="submit">
                            <i class="fas fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
                
                <div class="dotMenu">
                    <ul class="dot-icons" data-bs-toggle="modal" data-bs-target="#profile-modal">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="city-selection-box d-none">
                    <div class="cityAreaSelection">
                        <span class="home-icon">
                            <i class="fas fa-house"></i>
                        </span>
                        <span class="location-name">
                            <span>{{ siteInfo()->address_1 }}</span> <span>{{ siteInfo()->address_2 }}</span>
                        </span>
                        <span class="arrow-down">
                            <i class="fas fa-angle-down"></i>
                        </span>
                    </div>
                    <div class="city_header_component">
                        <div class="address-list">
                            <div class="user-current-location">
                                <button class="btn shadow rounded-circle">
                                    <i class="fas fa-location-crosshairs"></i>
                                </button>
                                <p>Use My Current Location</p>
                            </div>
                            <div class="address-area">
                                <div class="icon-container">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="address-details-container">
                                    <div class="area-name">{{ siteInfo()->address_1 }}, {{ siteInfo()->address_2 }}</div>
                                    <div class="street-address"></div>
                                </div>
                            </div>
                            <div class="user-current-location">
                                <button class="btn shadow rounded-circle">
                                    <i class="fas fa-city"></i>
                                </button>
                                <p>Change City</p>
                            </div>
                            <div class="user-current-location">
                                <button class="btn shadow rounded-circle">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <p>Add Address</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-notification d-none">
                    <div class="bell-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="notification-panel-container">
                        <div class="notification-panel">
                            <div class="notification-header">
                                <h1>Notifications</h1>
                                <button class="mark-read ">Mark Read</button>
                            </div>
                            <div class="filter-buttons">
                                <button class="btn text-danger border border-danger">All</button>
                                <button class="btn text-secondary border border-secondary">Unread</button>
                            </div>
                            <div class="single-notification-list">
                                <div class="no-notification">
                                    No Notification
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="langSwitch area d-none">
                    <p class="selected">En</p>
                    <p class="divider">|</p>
                    <p class="">Bn</p>
                </div>
                <div class="loginArea logedin area">
                    @guest
                    <button class="signin" data-bs-toggle="modal" data-bs-target="#signin">Sign in</button>
                    @else
                    <div class="">
                        <div class="user-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-name">
                            <p>{{ auth()->user()->phone ?? '' }}</p>
                        </div>
                        <ul class="user-dropdown">
                            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#profile">Your Profile</a></li>
                            <li><a href="{{ route('front.order.index') }}">Your Orders</a></li>
                            <li><a href="">Payment History</a></li>
                            <li><a href="">Referral Program</a></li>
                            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#changePassword">Change Password</a></li>
                            <li><a href="{{ route('front.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    @endguest
                </div>
        </nav>
        <div class="addressSelectionInline">
          <!--
                <div class="icon">
                    <i class="fas fa-location-arrow"></i>
                </div>
          -->
          <!--
                <div class="address ">
                    {{ siteInfo()->address_1 }}, {{ siteInfo()->address_2 }}
                </div>
          
          <!--
                <div class="icon">
                    <i class="fas fa-angle-right"></i>
                </div>
          -->
          
                <div class="city_header_component city_header_component2">
                    <div class="address-list">
                        <div class="user-current-location">
                            <button class="btn shadow rounded-circle">
                                <i class="fas fa-location-crosshairs"></i>
                            </button>
                            <p>Use My Current Location</p>
                        </div>
                        <div class="address-area">
                            <div class="icon-container">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="address-details-container">
                                <div class="area-name">{{ siteInfo()->address_1 }}, {{ siteInfo()->address_2 }}</div>
                                <div class="street-address"></div>
                            </div>
                        </div>
                        <div class="user-current-location">
                            <button class="btn shadow rounded-circle">
                                <i class="fas fa-city"></i>
                            </button>
                            <p>Change City</p>
                        </div>
                        <div class="user-current-location">
                            <button class="btn shadow rounded-circle">
                                <i class="fas fa-plus"></i>
                            </button>
                            <p>Add Address</p>
                        </div>
                    </div>
                </div>
        </div>
        <div class="primary_shopping_bottom_btn shopping_bottom_btn" style="box-shadow: none;">
          
          <!--
            <button class="start_shopping_btn first-toggler">
                
                <span>Start Shopping</span>
                
            </button>
          -->
          
        </div>
        <div class="stickyCartMobile">
            <button class="btn btn-light rounded-0">
                <svg version="1.1" id="Calque_1" x="0px" y="0px" style="fill:#9c9c9c;stroke:#b9b9b9;" width="16px" height="24px" viewBox="0 0 100 160.13"><g><polygon points="11.052,154.666 21.987,143.115 35.409,154.666  "></polygon><path d="M83.055,36.599c-0.323-7.997-1.229-15.362-2.72-19.555c-2.273-6.396-5.49-7.737-7.789-7.737   c-6.796,0-13.674,11.599-16.489,25.689l-3.371-0.2l-0.19-0.012l-5.509,1.333c-0.058-9.911-1.01-17.577-2.849-22.747   c-2.273-6.394-5.49-7.737-7.788-7.737c-8.618,0-17.367,18.625-17.788,37.361l-13.79,3.336l0.18,1.731h-0.18v106.605l17.466-17.762   l18.592,17.762V48.06H9.886l42.845-10.764l2.862,0.171c-0.47,2.892-0.74,5.865-0.822,8.843l-8.954,1.75v106.605l48.777-10.655   V38.532l0.073-1.244L83.055,36.599z M36.35,8.124c2.709,0,4.453,3.307,5.441,6.081c1.779,5.01,2.69,12.589,2.711,22.513   l-23.429,5.667C21.663,23.304,30.499,8.124,36.35,8.124z M72.546,11.798c2.709,0,4.454,3.308,5.44,6.081   c1.396,3.926,2.252,10.927,2.571,18.572l-22.035-1.308C61.289,21.508,67.87,11.798,72.546,11.798z M58.062,37.612l22.581,1.34   c0.019,0.762,0.028,1.528,0.039,2.297l-23.404,4.571C57.375,42.986,57.637,40.234,58.062,37.612z M83.165,40.766   c-0.007-0.557-0.01-1.112-0.021-1.665l6.549,0.39L83.165,40.766z"></path></g></svg>
                <span class="cart-sticky badge bg-danger rounded-circle">{{ totalCartItems() }}</span>
            </button>
        </div>
        <div class="shopping-cart-sticky">
            <div class="itemCount">
                <svg version="1.1" id="Calque_1" x="0px" y="0px" style="fill:#FDD670;stroke:#FDD670;" width="16px" height="24px" viewBox="0 0 100 160.13"><g><polygon points="11.052,154.666 21.987,143.115 35.409,154.666  "></polygon><path d="M83.055,36.599c-0.323-7.997-1.229-15.362-2.72-19.555c-2.273-6.396-5.49-7.737-7.789-7.737   c-6.796,0-13.674,11.599-16.489,25.689l-3.371-0.2l-0.19-0.012l-5.509,1.333c-0.058-9.911-1.01-17.577-2.849-22.747   c-2.273-6.394-5.49-7.737-7.788-7.737c-8.618,0-17.367,18.625-17.788,37.361l-13.79,3.336l0.18,1.731h-0.18v106.605l17.466-17.762   l18.592,17.762V48.06H9.886l42.845-10.764l2.862,0.171c-0.47,2.892-0.74,5.865-0.822,8.843l-8.954,1.75v106.605l48.777-10.655   V38.532l0.073-1.244L83.055,36.599z M36.35,8.124c2.709,0,4.453,3.307,5.441,6.081c1.779,5.01,2.69,12.589,2.711,22.513   l-23.429,5.667C21.663,23.304,30.499,8.124,36.35,8.124z M72.546,11.798c2.709,0,4.454,3.308,5.44,6.081   c1.396,3.926,2.252,10.927,2.571,18.572l-22.035-1.308C61.289,21.508,67.87,11.798,72.546,11.798z M58.062,37.612l22.581,1.34   c0.019,0.762,0.028,1.528,0.039,2.297l-23.404,4.571C57.375,42.986,57.637,40.234,58.062,37.612z M83.165,40.766   c-0.007-0.557-0.01-1.112-0.021-1.665l6.549,0.39L83.165,40.766z"></path></g></svg>
                <p>
                    <span class="cart-sticky">{{ totalCartItems() }} {{ totalCartItems() > 1 ? 'ITEMS' : 'ITEM' }}</span>
                </p>
            </div>
            <div class="total">
                <span></span>
                <span class="amount">{{ cartTotalAmount()['total'] }}</span>
            </div>
        </div>
        <div class="shoppingCartWrapper">
            <div class="cartContainer">
                <div class="shoppingCartButton">

                </div>
                <div class="shoppingCart expanded">
                    <div class="header">
                        <div class="cart">
                            <svg version="1.1" id="Calque_1" x="0px" y="0px" style="fill:#FDD670;stroke:#FDD670;" width="21px" height="32px" viewBox="0 0 100 160.13"><g><polygon points="11.052,154.666 21.987,143.115 35.409,154.666  "></polygon><path d="M83.055,36.599c-0.323-7.997-1.229-15.362-2.72-19.555c-2.273-6.396-5.49-7.737-7.789-7.737   c-6.796,0-13.674,11.599-16.489,25.689l-3.371-0.2l-0.19-0.012l-5.509,1.333c-0.058-9.911-1.01-17.577-2.849-22.747   c-2.273-6.394-5.49-7.737-7.788-7.737c-8.618,0-17.367,18.625-17.788,37.361l-13.79,3.336l0.18,1.731h-0.18v106.605l17.466-17.762   l18.592,17.762V48.06H9.886l42.845-10.764l2.862,0.171c-0.47,2.892-0.74,5.865-0.822,8.843l-8.954,1.75v106.605l48.777-10.655   V38.532l0.073-1.244L83.055,36.599z M36.35,8.124c2.709,0,4.453,3.307,5.441,6.081c1.779,5.01,2.69,12.589,2.711,22.513   l-23.429,5.667C21.663,23.304,30.499,8.124,36.35,8.124z M72.546,11.798c2.709,0,4.454,3.308,5.44,6.081   c1.396,3.926,2.252,10.927,2.571,18.572l-22.035-1.308C61.289,21.508,67.87,11.798,72.546,11.798z M58.062,37.612l22.581,1.34   c0.019,0.762,0.028,1.528,0.039,2.297l-23.404,4.571C57.375,42.986,57.637,40.234,58.062,37.612z M83.165,40.766   c-0.007-0.557-0.01-1.112-0.021-1.665l6.549,0.39L83.165,40.766z"></path></g></svg>
                        </div>
                        <div class="itemCount">
                            <span>{{ totalCartItems() }} {{ totalCartItems() > 1 ? 'Items' : 'Item' }}</span>
                        </div>
                        <button class="closeCartButtonTop">
                            Close
                        </button>
                    </div>
                    <div class="in-shopping-cart" id="shipping-cost-meter">
                        <div class="costMeterSection">
                            <div class="costMeter">
                                <div class="container">
                                    <div class="progress">
                                        <div style="width:0%;" class="bar"></div>
                                        <div class="meterInfoText">
                                            <div class="infoTextLeft d-none">
                                                <span></span>
                                                <span>Delivery Charge Not Needed</span>
                                                <span></span>
                                            </div>
                                            <div class="infoTextRight d-none">
                                                <span class="priceSection">
                                                    <span></span>
                                                    <span class="amount">0</span>
                                                </span>
                                                <span class="helpIcon" data-bs-toggle="modal" data-bs-target="#helpIcon">
                                                    <svg width="15px" height="15px" style="fill:#fff;stroke:#fff;display:inline-block;vertical-align:middle;" version="1.1" viewBox="0 0 100 100" ><path d="m50 5c-24.898 0-45 20.102-45 45s20.102 45 45 45 45-20.102 45-45-20.102-45-45-45zm7.1016 70c0 2.1992-1.8984 4.1016-4.1016 4.1016h-6.1992c-2.1992 0-4.1016-1.8984-4.1016-4.1016v-26.199c0-2.3008 1.8984-4.1016 4.1016-4.1016h6.1992c2.1992 0 4.1016 1.8984 4.1016 4.1016zm-7.2031-37.102c-4.6016 0-8.3984-3.8008-8.3984-8.5 0-4.6992 3.8008-8.5 8.3984-8.5 4.6992 0 8.5 3.8008 8.5 8.5 0 4.7031-3.7969 8.5-8.5 8.5z"></path></svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div>
                            <div class="itemsHeader expressHeader d-none">
                                <div>
                                    <div class="cartItemsHeaderIcon">
                                        <svg version="1.1" x="0px" y="0px" viewBox="0 20 90 90"><path class="st0" d="M59.4,32.6c0.2,0.2-0.2,0.3-0.2,0.3s-1.2,0.3-1.5,0.8c-0.3,0.3-0.8,1.5-0.8,1.5c0.7-0.2,1.5-0.3,2.3-0.7 c0.2,0,0.3,0.2,0.5,0.3c0.2,0-2,0.8-2.5,1.2c-0.3,0.3-2,1.7-2.5,1.7S53,37.9,53,37.9c0.2,0.3,0.3,0.7,0.7,1.2c0,0-1.2,0.7-1.2,0.8 c-0.2,0.2-1,1.2-1,1.2s3,0.3,4-1.3c-1,1.7-3.3,3.3-8.2,3.3c-5,0-9-2-11.7-3c-2.8-1.2-6.5-2.5-9.5-2.5c-2.8,0-6.2,0.8-8.4,2.9 c-3.9-1.5-9.2-0.7-11.7,1.7c-2.3,2.3-4.7,5.2-5,7.2c-0.5,2.2-1.7,7.4-3.3,9.7c-2.3,3.8-5,4.8-5.9,6.5c-0.8,1.7-0.8,5.2-0.7,5.2 c0.3,0.2,1.5,0,2.2-0.3c1.3-0.5,5-4.3,6.4-6.2c1.3-1.8,5.9-9.9,6.5-12.7c0.7-2.8,1.3-5.7,3.3-7.2c2.2-1.5,4.8-0.8,4.8-0.7 c0,0-2.5,2-2.7,7.5c-0.2,5.5,3.2,4.9,1.5,8.4c-1.7,3-6.7,1-8.4,2.8c-1.3,1.5,0,6.9,0,7.9c0,1-0.5,5.7-0.8,6.9c-0.2,1,0,1.7-0.2,2.3 c-0.2,0.5,1,0.7,1,0.7s-1,1.3-1.5,1c-0.5-0.2-0.8-0.2-1.2,0c-0.3,0-1,0.3-1.7,0l-2.7,5.7c0.3,0.2,0.8,0.3,1.3,0.2 c0.7-0.2,4-1.7,4.4-2c0.5-0.2,3.3-1.8,3.8-2.8c0.3-1,1-4.2,1-5.2c0.2-1,0.3-4.2,0.3-5c0-0.8-0.2-2.3,0-3c0.3-0.5,0.8-1.2,1.5-1.5 c0.8-0.2,1.8-0.2,2-0.2c0.3,0,3.2,0.3,3.7,0.3c0.7,0,3.3-0.5,4-0.8c0.8-0.2,1.3,0,1.5,0.3c0.3,0.3-0.3,0.8-0.3,1 c-0.2,0.2-1.5,1.8-1.8,2.5c-0.3,0.8-1.5,2.3-1.2,3c0.3,0.7,0.3,0.8,1.3,1.3c1,0.3,4.9,2.3,7,4.3c2.3,2.2,4.5,4.8,4.9,6.2 c0.5,1.5,1.3,1.7,1.8,1.7c0.5,0.2,1.5,0.3,1.5,1c0,0.7-0.2,1.5-0.2,1.5l6.2,2.3c0,0,0-2.2-0.2-3c-0.2-1-1.2-2-2-3 c-0.8-1.2-9.5-9.7-10.4-10.4c-0.8-0.5-1.5-1.2-1.7-2.5c-0.2-1.3,1.5-2.3,2.5-3.5c0.7-0.8,2.5-4.7,2.8-5.2c0.3-0.5,1.5-1.8,2.2-1.8 c0.8,0,2.7,1.2,5,2c1,0.3,8.2,2.2,9.2,2.5c1,0.2,3.2,0,3.8,0.7c0.7,0.5,0,1.8-0.2,2.7c-0.2,1-2,4.7-2,4.7s0.3,1.3,0.3,2.4 c0,1.2-0.5,5.3-1,6.7c-0.3,1.5-2.7,5.4-3.2,6c-0.3,0.5-0.8,0.8-0.8,1.7c0,0.8,1.5,1,2,1.7c0.7,0.5,0.2,1.5,0,2.5l6.7,2.8 c0-0.5,0.3-1.3,0-1.7c-0.2-0.5-1-1.5-1.5-2.2c-0.3-0.5-1.5-2.3-1.8-2.7c-0.3-0.5-0.3-1.5,0-2.3c0.2-0.8,2.3-6.5,2.5-7.2 c0.3-0.8,3.5-7.5,3.8-8.4c0.3-1,3-5.9,3.3-6.7c0.3-1,2.5-1.8,3.2-1.8c0.8,0,5,1.5,5.7,1.8c0.5,0.2,4.4,1.8,5,2.2 c0.8,0.3,0.3,1-0.2,1.2c-0.5,0.3-6.7,4.5-7.2,4.7c-0.5,0.2-1,0.7-1.3,0.7c-0.5,0-1.2,0.5-1.2,0.7c0,0.3-0.2,1-1,1c-0.7,0-2-1-2.8-2 c-1.2,0.7-2,1.2-2.5,2.2c-0.8,0.8-1.2,1.5-1.7,2.7c0.3,0.3,1,0.5,1.5,0.5h5.4c0.5,0,1.2-0.2,1.7-0.3c0.5-0.3,13.7-9,13.7-9 s2.2-1.7,2.2-3.2c0-1.2-1-1.5-1.3-2c-0.5-0.3-3.5-2.3-4-2.7c-0.7-0.5-3-1.8-3.7-2.2c-0.5-0.3-2.4-1-2.4-1c0.5-1.5,0.8-2.7,1-3 c0.2-0.3,0.2-3.4,0.3-3.9c0-0.5,0.8-2.7,1.2-3c0.3-0.3,1.2-3,1.3-3.5c0.2-0.3,1.5-4.2,2.2-4.2c0.7-0.2,1.3,0.5,2,0.5 c0.7,0.2,3.2-0.2,4.5,0c1.2,0.2,2.7,1.7,3,1.8c0.5,0.2,1.7,0.7,2,0.7c0.2,0,1.8-1.2,1.8-1.5c0-0.3-1.2-1-1.3-1 c-0.2-0.2-1.3-0.8-1.3-0.8c0,0.2,0.5-0.3,1.3-0.3c0.7,0,1.3,0.7,1.5,0.8c0.3,0.2,1.2,0.7,1.3,0.3c0.2-0.2,0.8-1,0.8-1.5 c0-0.7-0.7-1.5-1-1.8c-0.3-0.3-4.2-4-4.5-4.2c-0.5-0.2-2.5-2-2.5-2.5c-0.2-0.3-1.2-1.2-1.3-1.3c-0.2-0.2-5.2-3.7-5.9-4.2 c-0.7-0.5-1.3-1.3-1.3-2.2c0-0.8-0.3-3-0.3-3s-1.2-0.2-1.7,0.3c-0.5,0.3-1.7,3-2.3,3c-1.8-0.3-4.2,0.2-4.2,0.5 c0.2,0.5,1.8,0.2,1.8,0.2c0,0.2-0.7,1-1.2,1c-0.3,0-1.3,0.3-1.5,0.5c-0.3,0-1,0.5-1,0.5c0.5,0,1,0,1.7,0.2c0,0-1,0.7-1.5,0.7 c-0.5,0-2.2,0.5-2.7,0.7c-0.3,0.3-1.7,1.3-1.7,1.3h-1.5l0.2,0.3h0.8L59.4,32.6L59.4,32.6z"></path></svg>
                                    </div>
                                    <span>Express Delivery</span>
                                </div>
                                <span>
                                    Today, 3:00PM - 4:00PM
                                </span>
                            </div>
                            <!-- <div class="empty-cart">
                                <h5>Empty Cart</h5>
                            </div> -->
                            @forelse(cartItems() as $key => $item)
                            @php 
                                $row_total = $item['price'] * $item['quantity'];
                            @endphp
                            <div class="orderItem">
                                <div class="quantity">
                                    <div data-url="{{ route('front.cart.increase', [$key]) }}" class="caret caret-up increase" title="Add one more to bag">
                                        <svg version="1.1" x="0px" y="0px" viewBox="0 20 100 100"><polygon points="46.34,39.003 46.34,39.003 24.846,60.499 29.007,64.657 50.502,43.163 71.015,63.677 75.175,59.519 50.502,34.844   "></polygon></svg>
                                    </div>
                                    <span class="onHoverCursor quantity-value">
                                        <span class="current-qty">{{ $item['quantity'] }}</span>
                                    </span>
                                    <div data-url="{{ route('front.cart.decrease', [$key]) }}" class="caret caret-down decrease" title="Remove one from bag">
                                        <svg version="1.1" x="0px" y="0px" viewBox="0 -20 100 100"><polygon points="53.681,60.497 53.681,60.497 75.175,39.001 71.014,34.843 49.519,56.337 29.006,35.823 24.846,39.982   49.519,64.656 "></polygon></svg>
                                    </div>
                                </div>
                                <div class="picture">
                                    <div class="productPicture">
                                        <img src="{{ asset($item['image']) }}" size="400" style="background-color:transparent;">
                                    </div>
                                </div>
                                <div class="name">
                                    <span>{{ $item['name'] }}</span>
                                    <div class="subText">
                                        <span>৳ </span>
                                        <span>{{ $item['price'] }}</span>
                                        <span> / 1 pcs</span>
                                    </div>
                                </div>
                                <div class="amount">
                                    <section>
                                        <div class="total">
                                            <span>৳ </span>
                                            <span>{{ $row_total }}</span>
                                        </div>
                                    </section>
                                    <div class="remove" data-url="{{ route('front.cart.destroy', [$key]) }}" title="Remove from bag">
                                        <svg version="1.1" x="0px" y="0px" viewBox="0 0 100 100"><rect x="19.49" y="46.963" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 121.571 49.0636)" width="62.267" height="5.495"></rect><rect x="18.575" y="47.876" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 49.062 121.5686)" width="62.268" height="5.495"></rect></svg>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div align="center">
                                <strong class="text-center text-danger">
                                    Your shopping bag is now empty!
                                </strong>
                            </div>
                            @endforelse
                        </div>
                        <section class="discountCodeContainer expanded notEligible">
                            <div class="main-discount-container">
                                <div class="discountCodeHeader">
                                    <button class="btnDiscount">
                                        <span class="arrow-icon arrow-down">
                                            <i class="fas fa-circle-chevron-down"></i>
                                        </span>
                                        <span>Have a special code?</span>
                                    </button>
                                </div>
                                <div class="discountCodeContent" >
                                    <form method="POST" action="{{ route('front.cart.apply-coupon') }}" id="ajaxForm">
                                        @csrf
                                        <span class="inputNbtn">
                                            <input required maxlength="100" type="text" name="code" placeholder="Referral/Discount Code">
                                            <button class="discountSubmitBtn">
                                                <span>
                                                    
                                                    <span >Go</span>
                                                    
                                                </span>
                                            </button>
                                            <button type="submit" class="discountCloseBtn">Close</button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="">                        
                        <div class="footer">                            
                            <div class="shoppingtCartActionButtons">
                                <button id="placeOrderButton">
                                    <a id="placeOrder" data-auth="{{ Auth::id() }}" href="{{ route('front.checkout.index') }}" class="text-light text-decoration-none">
                                        <span class="placeOrderText">Place Order</span>
                                        <span class="totalMoneyCount">
                                            <span>  </span>
                                            <span>{{ cartTotalAmount()['total'] }}</span>                                            
                                        </span>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="helpIcon" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                
                <div class="modal-body helpBody">
                    <div class="title">Delivery Charge Policy</div>
                    <div class="policyContainer">
                        <div>
                            <div class="policy">
                                <span>
                                    1. 39 fee on orders of ৳400 and above.
                                </span>
                            </div>
                            <div class="policy">
                                <span>
                                    2. ৳49 fee applicable for all orders below ৳400.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="userDeliveryChargeDescriptionContainer">
                        <div class="title">Your Order Delivery Fee ৳0</div>
                        <div class="promotionalOfferText">
                            Promotional Offer
                        </div>
                    </div>
                    <button class="closeBtn" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>