@extends('frontend.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/food.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
        <section class="bodyTable">
            <div>
                <div class="landingPage2">
                    @if(!empty($slider))
                    <div class="landingBanner" style="background-image: url({{ asset($slider->image) }});">
                        <div class="floatingSearchBar">
                            <div class="searchBarContainer">
                                <h2>
                                    <span>
                                        {{  $slider->title_one }}
                                    </span>
                                </h2>
                                <form action="#" class="searchArea d-none">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="searchBox" placeholder="Search">
                                                </td>
                                                <td class="buttonCell">
                                                    <button>
                                                        <i class="fas fa-magnifying-glass"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <strong class="text-center text-danger">No Sliders are Available</strong>
                    @endif
                    <section class="top-banner-placeholder"></section>
                    <div class="mainContainer">
                        <section class="categoryTiles" id="product-categories">
                            <div class="initialLabel">
                                <h2>
                                    <span>
                                        Our  Product Categories
                                    </span>
                                </h2>
                            </div>
                            <div class="mainTile">
                               @forelse($feateuredCategories as $key => $item)
                               <a href="{{ route('front.subcategory', [
                                            'type'=>'subcategory', 
                                            'slug'=> $item->category->slug 
                                        ] ) }}">
                                    <div class="categoryBox">
                                        <div class="categoryName">
                                            {{ $item->category->name }}
                                        </div>
                                        <div class="categoryImg">
                                            <img src="{{ asset($item->category->image) }}" height="30" width="30">
                                        </div>
                                    </div>
                                </a>
                               @empty
                               <strong>No Categories are Available!</strong>
                               @endforelse
                            </div>
                        </section>
                    </div>
                    <section id="how-to-order-chaldal">
                        <div class="initialLabel pt-4">
                            <h2>
                                <span>How to Order ?</span>
                            </h2>
                        </div>
                        <div class="how-to-slider">
                            <div id="howto" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-bs-target="#howto" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                                    <li data-bs-target="#howto" data-bs-slide-to="1" aria-label="Second slide"></li>
                                    <li data-bs-target="#howto" data-bs-slide-to="2" aria-label="Third slide"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('frontend/images/banners/tutorial-1.webp') }}" class="w-100 d-block" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('frontend/images/banners/tutorial-2.webp') }}" class="w-100 d-block" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('frontend/images/banners/tutorial-3.webp') }}" class="w-100 d-block" alt="Third slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="love-chaldal">
                        <div class="initialLabel pt-4">
                            <h2>
                                <span>
                                    Why People 
                                    <svg width="50px" height="50px" style="fill:#ff0000;stroke:#ff0000;display:inline-block;vertical-align:middle;" version="1.1" viewBox="0 0 100 100"><path d="m83.332 27.082c-2.293-4.168-16.668-18.125-33.332 2.082-17.5-20.207-31.043-6.25-33.332-2.082-4.168 7.707-1.668 19.375 4.168 25l29.168 29.168 29.168-29.168c5.8281-5.625 8.3281-17.289 4.1602-25z"></path></svg>
                                    Us
                                </span>
                            </h2>
                        </div>
                        <div class="mainTile">
                            <div class="tile">
                                <div class="tileHeaderImg">
                                    <img src="{{ asset('frontend/images/banners/lp-features-1.webp') }}" alt="Image">
                                </div>
                                <div class="tileHeaderText">
                                    <h3>
                                        <span>Convenient & Quick</span>
                                    </h3>
                                    <p>
                                        <span>
                                            No waiting in traffic, no haggling, no worries carrying groceries, they're delivered right at your door.
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="tile">
                                <div class="tileHeaderImg">
                                    <img src="{{ asset('frontend/images/banners/lp-features-2.webp') }}" alt="Image">
                                </div>
                                <div class="tileHeaderText">
                                    <h3>
                                        <span>Freshly Picked</span>
                                    </h3>
                                    <p>
                                        <span>
                                            Our fresh produce is sourced every morning, you get the best from us.
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="tile">
                                <div class="tileHeaderImg">
                                    <img src="{{ asset('frontend/images/banners/lp-features-3.webp') }}" alt="Image">
                                </div>
                                <div class="tileHeaderText">
                                    <h3>
                                        <span>A wide range of Products</span>
                                    </h3>
                                    <p>
                                        <span>
                                            With 4000+ Products to choose from, forget scouring those aisles for hours.
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="love-chaldal">
                        <div class="initialLabel pt-4">
                            <h2>
                                <span>
                                    Our Trending Products
                                </span>
                            </h2>
                            <div class="categorySection miscCategorySection onlyMiscCategorySection">
                                <div class="productPane">
                                    @forelse($products as $key => $product)
                                        @include('frontend.product.single-product', ['product'=>$product] )
                                    @empty
                                    <div align="center">
                                        <strong class="text-center text-danger">No products are available</strong>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="feedback">
                        <div class="initialLabel">
                            <h2>What our clients are saying</h2>
                        </div>
                        <div class="mainTile">
                            <div id="userFeedback" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-bs-target="#userFeedback" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                                    <li data-bs-target="#userFeedback" data-bs-slide-to="1" aria-label="Second slide"></li>
                                    <li data-bs-target="#userFeedback" data-bs-slide-to="2" aria-label="Third slide"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <div class="userRecommendation">
                                            <div class="slideContents">
                                                <div class="profile">
                                                    <img src="{{ asset('frontend/images/others/lp_feedback_shampa_shahriyar.webp') }}" alt="Profile Image">
                                                    <div class="profileName">Shampa Shahriyar</div>
                                                </div>
                                                <div class="commentsAndRating">
                                                    <p class="comments">I want to order something (A perfume) for my mom at BD. Although the delivery area was out of their scope, their support team instantly replied to my query and manged to deliver the product. The best thing I noticed, they informed step by step updated news about the order processing.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="userRecommendation">
                                            <div class="slideContents">
                                                <div class="profile">
                                                    <img src="{{ asset('frontend/images/others/lp_feedback_abedul_hoque_rakib.webp') }}" alt="Profile Image">
                                                    <div class="profileName">Abedul Hoque Rakib</div>
                                                </div>
                                                <div class="commentsAndRating">
                                                    <p class="comments">I have been shopping from chaldal for the past few months and i am loving the experience. Have been shopping from here and i have recommended my relatives too. They are also happy with the service. The prices are comparatively low and the products are genuine.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="userRecommendation">
                                            <div class="slideContents">
                                                <div class="profile">
                                                    <img src="{{ asset('frontend/images/others/lp_feedback_ashfia_ahmed.webp') }}" alt="Profile Image">
                                                    <div class="profileName">Ashfia Ahmed</div>
                                                </div>
                                                <div class="commentsAndRating">
                                                    <p class="comments">Loved the service! I urgently needed some stuffs and ordered it here and they delivered in less than an hour as promised! Thanks a lot for that.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="corporate" class="d-none">
                        <div class="mainContainer">
                            <div class="corporate-content">
                                <div class="initialLabel">
                                    <svg width="80px" height="80px" style="fill:#fff;stroke:#fff;display:inline-block;vertical-align:middle;" version="1.1" viewBox="0 0 100 100"><g><path d="m82.652 27.863h-18.59v-2.1328c0-3.4453-2.8047-6.25-6.25-6.25h-15.625c-3.4453 0-6.25 2.8047-6.25 6.25v2.1328h-18.59c-1.0039 0-1.8164 0.8125-1.8164 1.8164v16.371c0 0.78125 0.5 1.4766 1.2422 1.7227l23.281 7.75v6.6875c0 1.0039 0.8125 1.8125 1.8125 1.8164l16.289 0.035156h0.003906c0.48047 0 0.94141-0.19141 1.2812-0.53125s0.53125-0.80469 0.53125-1.2852v-6.7227l23.246-7.75c0.74219-0.24609 1.2422-0.94141 1.2422-1.7227l0.007812-16.371c0-1.0039-0.8125-1.8164-1.8164-1.8164zm-43.082-2.1328c0-1.4414 1.1719-2.6172 2.6172-2.6172h15.625c1.4414 0 2.6172 1.1719 2.6172 2.6172v2.1328h-20.859zm4.1172 34.668v-4.3672h12.656v4.3945zm37.148-15.656l-22.969 7.6562h-15.703l-23-7.6602v-13.242h61.672z"></path><path d="m82.652 52.398c-1.0039 0-1.8164 0.8125-1.8164 1.8164v16.184c0 3.5781-2.9102 6.4922-6.4922 6.4922l-48.691-0.003906c-3.5781 0-6.4922-2.9102-6.4922-6.4922l0.003906-16.18c0-1.0039-0.8125-1.8164-1.8164-1.8164s-1.8164 0.8125-1.8164 1.8164v16.184c0 5.582 4.543 10.125 10.125 10.125h48.691c5.582 0 10.125-4.543 10.125-10.125l-0.003906-16.184c0-1.0039-0.8125-1.8164-1.8164-1.8164z"></path></g></svg>
                                    <h2>Do you own a business?</h2>
                                    <h3>Become a Corporate Customer</h3>
                                </div>
                                <ul class="corporate-benefits">
                                    <li class="corporate-benefits-item">
                                        <i class="tick"></i>
                                        <svg version="1.1" class="prices" x="0px" y="0px" style="fill:#fdfdfd;" width="100px" height="100px" viewBox="0 0 100 100"><g><g><path class="st4" d="M84,28H30c-0.5522461,0-1,0.4472656-1,1v4h-4c-0.5522461,0-1,0.4472656-1,1v4h-4    c-0.5522461,0-1,0.4472656-1,1v32c0,0.5527344,0.4477539,1,1,1h54c0.5522461,0,1-0.4472656,1-1v-4h4c0.5522461,0,1-0.4472656,1-1    v-4h4c0.5522461,0,1-0.4472656,1-1V29C85,28.4472656,84.5522461,28,84,28z M73,70H21V40h52V70z M78,65h-3V39    c0-0.5527344-0.4477539-1-1-1H26v-3h52V65z M83,60h-3V34c0-0.5527344-0.4477539-1-1-1H31v-3h52V60z"></path><path class="st4" d="M68,45h-4c-0.5522461,0-1,0.4472656-1,1s0.4477539,1,1,1h4c0.5522461,0,1-0.4472656,1-1S68.5522461,45,68,45z    "></path><path class="st4" d="M54.9785156,50H44v-1c0-3.2246094-1.7758789-5-5-5c-0.5522461,0-1,0.4472656-1,1s0.4477539,1,1,1    c2.1030273,0,3,0.8974609,3,3v1h-3c-0.5522461,0-1,0.4472656-1,1s0.4477539,1,1,1h2.9998779    c-0.0001221,2.1207275,0.0010986,4.1679688,0.0098877,6.421875c0.0068359,1.6552734,0.3168945,3.9951172,1.7548828,5.7412109    c1.2021484,1.4599609,2.9868164,2.0419922,4.7338867,2.0419922c0.9160156,0,1.8217773-0.1601562,2.6274414-0.4365234    c3.0493164-1.0458984,4.3764648-4.8339844,3.7026367-7.7167969c-0.3891602-1.6660156-1.5390625-2.9912109-3-3.4580078    c-0.9433594-0.3027344-2.0317383-0.2070312-2.9125977,0.2539062c-0.7836914,0.4111328-1.3510742,1.0810547-1.5976562,1.8886719    c-0.2875977,0.9423828-0.1435547,1.96875,0.3955078,2.8144531c0.5883789,0.9228516,1.5654297,1.5419922,2.6811523,1.6992188    c0.8759766,0.1210938,1.7758789-0.1064453,2.4980469-0.6044922c-0.2836914,1.4384766-1.1269531,2.7890625-2.4160156,3.2304688    c-1.6357422,0.5634766-3.9516602,0.4931641-5.168457-0.984375c-1.0634766-1.2910156-1.293457-3.1474609-1.2988281-4.4775391    C44.0009766,56.1627808,43.9997559,54.118103,43.9998779,52h10.9786377c0.5522461,0,1-0.4472656,1-1S55.5307617,50,54.9785156,50z     M52.0996094,58.6738281c-0.324707,0.4296875-0.8950195,0.6689453-1.4262695,0.5957031    c-0.5356445-0.0751953-0.9995117-0.3642578-1.2724609-0.7929688c-0.2280273-0.3574219-0.2880859-0.7685547-0.1694336-1.15625    c0.1137695-0.3740234,0.3959961-0.5869141,0.612793-0.7011719c0.2529297-0.1318359,0.5507812-0.2011719,0.8447266-0.2011719    c0.1821289,0,0.362793,0.0263672,0.5302734,0.0800781c0.3779297,0.1210938,0.7250977,0.3671875,1.0092773,0.6982422    C52.4506836,57.7578125,52.4067383,58.2666016,52.0996094,58.6738281z"></path><path class="st4" d="M30,63h-4c-0.5522461,0-1,0.4477539-1,1s0.4477539,1,1,1h4c0.5522461,0,1-0.4477539,1-1S30.5522461,63,30,63z"></path></g></g></svg>
                                        <h4>Special Corporate Prices</h4>
                                    </li>
                                    <li class="corporate-benefits-item">
                                        <i class="tick"></i>
                                        <svg version="1.1" class="support" x="0px" y="0px" style="fill:#ffffff;stroke:#ffffff;" width="100px" height="100px" viewBox="0 0 100 100"><g><g><path d="M50,61.138c-14.311,0-25.953-11.643-25.953-25.955C24.047,20.873,35.689,9.231,50,9.231s25.954,11.642,25.954,25.953    C75.954,49.495,64.311,61.138,50,61.138z M50,11.299c-13.17,0-23.884,10.714-23.884,23.884C26.116,48.355,36.83,59.07,50,59.07    s23.885-10.715,23.885-23.886C73.885,22.013,63.17,11.299,50,11.299z"></path></g><g><path d="M20.684,94.853c-0.572,0-1.034-0.463-1.034-1.034c0-12.204,7.258-23.174,18.491-27.947    c0.519-0.224,1.132,0.021,1.355,0.547c0.224,0.525-0.021,1.132-0.547,1.355c-10.467,4.448-17.231,14.671-17.231,26.044    C21.718,94.39,21.255,94.853,20.684,94.853z"></path></g><g><path d="M79.317,94.853c-0.572,0-1.034-0.463-1.034-1.034c0-13.377-9.497-25.031-22.582-27.709    c-0.56-0.114-0.921-0.661-0.806-1.22c0.114-0.56,0.666-0.916,1.22-0.806c14.043,2.873,24.236,15.379,24.236,29.735    C80.351,94.39,79.889,94.853,79.317,94.853z"></path></g><path d="M78.881,25.887C74.944,13.688,63.492,4.833,50,4.833c-13.492,0-24.943,8.854-28.88,21.053   c-5.089,0.052-9.215,4.198-9.215,9.299c0,5.101,4.126,9.248,9.215,9.299c3.703,11.473,14.059,19.961,26.503,20.932   c0.395,0.924,1.31,1.572,2.377,1.572c1.428,0,2.586-1.158,2.586-2.586c0-1.428-1.158-2.586-2.586-2.586   c-1.051,0-1.946,0.633-2.351,1.532c-14.496-1.201-25.932-13.363-25.932-28.165C21.718,19.589,34.406,6.901,50,6.901   c12.42,0,22.972,8.058,26.764,19.213c0.22,0.648,0.409,1.308,0.582,1.976c0.59,2.272,0.937,4.64,0.937,7.094   c0,2.454-0.347,4.822-0.937,7.094c-0.175,0.673-0.365,1.337-0.587,1.989c0.008,0.002,0.016,0.006,0.025,0.008   c0.646,0.142,1.316,0.217,2.004,0.217c5.132,0,9.307-4.175,9.307-9.307C88.095,30.085,83.969,25.938,78.881,25.887z M13.973,35.184   c0-3.761,2.895-6.827,6.568-7.172c-0.561,2.304-0.891,4.697-0.891,7.171c0,2.475,0.33,4.868,0.892,7.173   C16.868,42.011,13.973,38.946,13.973,35.184z M79.46,42.355c0.561-2.304,0.892-4.697,0.892-7.172c0-2.474-0.33-4.866-0.891-7.17   c3.672,0.345,6.566,3.409,6.566,7.171C86.027,38.946,83.133,42.01,79.46,42.355z"></path></g></svg>
                                        <h4>24 Hour Support</h4>
                                    </li>
                                    <li class="corporate-benefits-item">
                                        <i class="tick"></i>
                                        <svg version="1.1" class="delivery" x="0px" y="0px" style="fill:#ffffff;" width="100px" height="100px" viewBox="0 0 100 100"><g><g><path d="M93.798,46.467h-3.396l-1.979-11.318c-0.105-0.572-0.609-0.997-1.195-0.997H73.451v-3.249c0-0.669-0.549-1.21-1.219-1.21    H29.406c-0.67,0-1.215,0.541-1.215,1.21v31.907c0,0.672,0.545,1.217,1.215,1.217h6.168c0.577,3.557,3.676,6.279,7.394,6.279    c3.723,0,6.819-2.723,7.399-6.279h22.615c0.584,3.557,3.675,6.279,7.395,6.279c3.724,0,6.813-2.723,7.396-6.279h6.024    c0.671,0,1.212-0.545,1.212-1.217V47.677C95.01,47.005,94.469,46.467,93.798,46.467z M48.025,63.119    c-0.158,2.65-2.362,4.76-5.057,4.76c-2.795,0-5.068-2.27-5.068-5.068c0-2.793,2.272-5.064,5.068-5.064    c2.695,0,4.899,2.111,5.057,4.762C48.036,62.719,48.036,62.938,48.025,63.119z M80.377,67.879c-2.701,0-4.917-2.125-5.061-4.797    c-0.007-0.139-0.007-0.424,0-0.537c0.144-2.666,2.359-4.799,5.061-4.799c2.8,0,5.069,2.271,5.069,5.064    C85.446,65.609,83.177,67.879,80.377,67.879z M92.584,61.598h-4.811c-0.584-3.555-3.673-6.279-7.396-6.279    c-3.72,0-6.811,2.725-7.395,6.279H50.367c-0.58-3.555-3.677-6.279-7.399-6.279c-3.718,0-6.817,2.725-7.394,6.279h-4.955V32.119    h40.404v15.91c0,0.676,0.544,1.217,1.21,1.217c0.67,0,1.219-0.541,1.219-1.217V36.581h12.754l1.98,11.307    c0.101,0.582,0.607,1.004,1.201,1.004h3.197V61.598z"></path><path d="M24.103,52.781H8.775c-0.673,0-1.214,0.545-1.214,1.217c0,0.67,0.542,1.211,1.214,1.211h15.328    c0.67,0,1.211-0.541,1.211-1.211C25.314,53.326,24.773,52.781,24.103,52.781z"></path><path d="M24.103,38.506H6.206c-0.67,0-1.215,0.546-1.215,1.211c0,0.674,0.545,1.207,1.215,1.207h17.897    c0.67,0,1.211-0.533,1.211-1.207C25.314,39.052,24.773,38.506,24.103,38.506z"></path><path d="M24.103,45.642H13.348c-0.67,0-1.218,0.546-1.218,1.216c0,0.667,0.548,1.21,1.218,1.21h10.755    c0.67,0,1.211-0.543,1.211-1.21C25.314,46.188,24.773,45.642,24.103,45.642z"></path></g></g></svg>
                                        <h4>Flexible Delivery</h4>
                                    </li>
                                </ul>
                                <a href="javascript:void(0)">Find Out More</a>
                            </div>
                        </div>
                    </section>
                    <div class="mainContainer d-none">
                        <section id="chaldalApps">
                            <div class="chaldalAppsContent">
                                <div class="initialLabel">
                                    <h2 class="heading">Be a part of our family</h2>
                                </div>
                                <form>
                                    <div class="inputGroup">
                                        <div class="phoneNumberLoginField">
                                            <div class="input-label">
                                                <span>Phone Number</span>
                                            </div>
                                            <div class="input">
                                                <input type="tel" value="+88" placeholder="">
                                            </div>
                                        </div>
                                        <input type="submit" name="submit" value="Get app">
                                    </div>
                                </form>
                                <div class="appButtonGroup">
                                    <a href="javascript:void(0)" class="googlePlayLink">
                                        <img alt="Download chaldal Android app" src="https://chaldn.com/asset/Egg.ChaldalWeb.Fabric/Egg.ChaldalWeb1/1.0.0+Deploy-Release-269/Default/stores/chaldal/components/landingPage2/MobileAppSection/images/lp_getandroidapp.png?v=2&amp;q=low&amp;webp=1&amp;alpha=1">
                                    </a>
                                    <a href="javascript:void(0)" class="iosAppLink">
                                        <img src="https://chaldn.com/asset/Egg.ChaldalWeb.Fabric/Egg.ChaldalWeb1/1.0.0+Deploy-Release-269/Default/stores/chaldal/components/landingPage2/MobileAppSection/images/lp_getappleapp.png?v=2&amp;q=low&amp;webp=1&amp;alpha=1">
                                    </a>
                                </div>
                            </div>
                            <img class="chaldalAppPreview" src="https://chaldn.com/asset/Egg.ChaldalWeb.Fabric/Egg.ChaldalWeb1/1.0.0+Deploy-Release-269/Default/stores/chaldal/components/landingPage2/MobileAppSection/images/lp_iphone_nexus.png?v=2&amp;q=low&amp;webp=1&amp;alpha=1">
                        </section>
                    </div>
                    <section id="map" class="map d-none">
                        <div class="wrap">
                            <div class="mapImage">
                                <img src="{{ asset('frontend/images/others/chaldal_new_warehouses.webp') }}">
                            </div>
                            <div class="infoText">
                                <div class="mainTitle">
                                    <div class="name">Dhaka</div>
                                </div>
                                <div class="section">
                                    <div class="title">Total Orders Placed</div>
                                    <div class="info">
                                        <span>3504412</span></div>
                                </div>
                                <div class="section">
                                    <div class="title">Total Savings</div>
                                    <div class="info"><span>৳</span><span>297,875,020</span></div>
                                </div>
                                <div class="section">
                                    <div class="title">Time Saved</div>
                                    <div class="info"><span>2,628,309</span><span> hrs</span></div>
                                </div>
                            </div>
                        </div>
                    </section>
                  
                  
                  
                    <footer id="footer">
                        <section class="footer-banner d-none">
                            <div class="banner">
                               <div class="wrap">
                                  <div class="left-area">
                                     <ul class="mb-0">
                                        <li>
                                            <span class="icon">
                                                <img src="{{ asset('frontend/images/others/1-hour.webp') }}" >
                                            </span>
                                            <span class="text">
                                                <span>30 minute delivery</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="icon">
                                                <img src="{{ asset('frontend/images/others/cash-on-delivery.webp') }}" >
                                            </span>
                                            <span class="text">
                                                <span>Cash on delivery</span>
                                            </span>
                                        </li>
                                     </ul>
                                  </div>
                                  <div class="right-area">
                                     <ul class="mb-0">
                                        <li class="text">Pay with</li>
                                        <li class="icon">
                                            <img src="{{ asset('frontend/images/others/Amex.webp') }}" >
                                        </li>
                                        <li class="icon">
                                            <img src="{{ asset('frontend/images/others/mastercard.webp') }}" >
                                        </li>
                                        <li class="icon">
                                            <img src="{{ asset('frontend/images/others/VIsa.webp') }}" >
                                        </li>
                                        <li class="icon bkash">
                                            <img src="{{ asset('frontend/images/others/bkash.webp') }}" >
                                        </li>
                                        <li class="icon bkash">
                                            <img src="{{ asset('frontend/images/others/NagadLogo.webp') }}" >
                                        </li>
                                        <li class="icon cod">
                                            <img src="{{ asset('frontend/images/others/COD.webp') }}" >
                                        </li>
                                     </ul>
                                  </div>
                               </div>
                            </div>
                         </section>
                         <div class="footer-left pt-4">

                            <div class="footerBottom">
                                <div class="list-type customer-service">
                                    <p>
                                        <span>{{ $title->first_column }}</span></p>
                                    <ul>
                                        @foreach($firstColumns as $column)
                                            <li><a href="{{ $column->link }}">{{ $column->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="list-type customer-service">
                                    <p><span>{{ $title->second_column }}</span></p>
                                    <ul>
                                        @foreach($secondColumns as $column)
                                            <li><a href="{{ $column->link }}">{{ $column->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="list-type customer-service">
                                    <p><span>{{ $title->third_column }}</span></p>
                                    <ul>
                                        @foreach($thirdColumns as $column)
                                            <li><a href="{{ $column->link }}">{{ $column->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-right">
                            <div class="app-download-section d-none">
                               <div class="wrap">
                                    <div class="google_play_store">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('frontend/images/others/google_play_store.webp') }}">
                                        </a>
                                    </div>
                                    <div class="app_store">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('frontend/images/others/app_store.webp') }}">
                                        </a>
                                    </div>
                               </div>
                            </div>
                            <div class="contact-section">
                               <div class="phone-number">
                                    <div class="wrap">
                                        <h2 class="footerLogo">
                                            <img class="chaldal_logo" style="background-image:url();background-repeat:no-repeat;" src="{{ asset(siteInfo()->logo) }}" alt="">
                                        </h2>
                                        <span class="phone-icon">
                                            <img src="{{ asset('frontend/images/others/phone_icon.webp') }}">
                                        </span>
                                        <span class="number" style="font-size:15px !important">
                                            <span>{{ siteInfo()->topbar_phone }}</span><br>
                                            <span class="email">{{ siteInfo()->contact_email }}</span><br>
                                            <span>{{ siteInfo()->address_1 }} {{ siteInfo()->address_2 }}</span>
                                        </span>
                                    </div>
                               </div>
                            </div>
                            <div class="social-section">
                               <ul>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank">
                                            <img src="{{ asset('frontend/images/others/Facebook.webp') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank">
                                            <img src="{{ asset('frontend/images/others/Youtube.webp') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank">
                                            <img src="{{ asset('frontend/images/others/twitter.webp') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank">
                                            <img src="{{ asset('frontend/images/others/Instagram.webp') }}">
                                        </a>
                                    </li>
                               </ul>
                            </div>
                         </div>
                    </footer>
                </div>
            </div>
        </section>
    </div>
@endsection