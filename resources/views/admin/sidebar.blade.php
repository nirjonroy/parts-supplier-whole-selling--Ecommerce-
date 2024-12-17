
<style>
.icon{
    background:#dd3d4c !important;
}

.fas{
    color:rgb(0, 0, 0) !important;
}

</style>
<div class="main-sidebar" >
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <img class="logo" src="{{ asset($setting->logo) }}" alt="logo"/>
        </a>
      </div>

      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">{{ $setting->sidebar_sm_header }}</a>
      </div>

      <ul class="sidebar-menu">
          <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">
                  <div class="icon" style="">
                    <i class="fas fa-home"></i>
                  </div>
                  <span style="color:Black">{{__('admin.Dashboard')}}</span>
               </a>
          </li>

          @if(auth()->user()->can('admin.all-order') || auth()->user()->can('admin.order-show') || auth()->user()->can('admin.pending-order') || auth()->user()->can('admin.delivered-order') || auth()->user()->can('admin.completed-order'))
          <li class="nav-item dropdown {{ Route::is('admin.all-order') || Route::is('admin.order-show') || Route::is('admin.pending-order') || Route::is('admin.pregress-order') || Route::is('admin.delivered-order') ||  Route::is('admin.completed-order') || Route::is('admin.declined-order') || Route::is('admin.cash-on-delivery')  ? 'active' : '' }}">

            <a href="#" class="nav-link has-dropdown">

             <div class="icon">
                                <i class="fab fa-first-order" style="color:#ffffff"></i>
                              </div>
           <span style="color:black">{{__('admin.Orders')}}</span></a>
            <ul class="dropdown-menu">

              <li class="{{ Route::is('admin.all-order') || Route::is('admin.order-show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.all-order') }}">{{__('admin.All Orders')}}</a></li>
              <li class="{{ Route::is('admin.return-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.return-order') }}">Return Orders</a></li>
              {{-- <li class="{{ Route::is('admin.pending-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-order') }}">{{__('admin.Pending Orders')}}</a></li>

              <li class="{{ Route::is('admin.process-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.process-order') }}">Process Orders</a></li>

              <li class="{{ Route::is('admin.courier-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.courier-order') }}">Courier Orders</a></li>
              <li class="{{ Route::is('admin.onhold-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.onhold-order') }}">On Hold Orders</a></li>
              <li class="{{ Route::is('admin.completed-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.completed-order') }}">{{__('admin.Completed Orders')}}</a></li>

              <li class="{{ Route::is('admin.cancell-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.cancell-order') }}">Cancell Orders</a></li>
              <li class="{{ Route::is('admin.return-order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.return-order') }}">Return Orders</a></li>

              <li class="{{ Route::is('admin.cash-on-delivery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.cash-on-delivery') }}">{{__('admin.Cash On Delivery')}}</a></li> --}}
<li class="{{ Route::is('admin.report.order') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.order.report') }}">
             Report</a>
          </li>
            </ul>

          </li>
          @endif

          @if(auth()->user()->can('admin.pc-builder') || auth()->user()->can('admin.product-category') || auth()->user()->can('admin.product-sub-category') || auth()->user()->can('admin.product-child-category') || auth()->user()->can('admin.mega-menu-category') || auth()->user()->can('admin.mega-menu-sub-category') || auth()->user()->can('admin.create-mega-menu-sub-category') || auth()->user()->can('admin.edit-mega-menu-sub-category') || auth()->user()->can('admin.mega-menu-banner') || auth()->user()->can('admin.popular-category') || auth()->user()->can('admin.featured-category'))
          <li class="nav-item dropdown {{ Route::is('admin.pc-builder.*') || Route::is('admin.product-category.*') || Route::is('admin.product-sub-category.*') || Route::is('admin.product-child-category.*') || Route::is('admin.mega-menu-category.*') || Route::is('admin.mega-menu-sub-category') || Route::is('admin.create-mega-menu-sub-category') || Route::is('admin.edit-mega-menu-sub-category') || Route::is('admin.mega-menu-banner') || Route::is('admin.popular-category') || Route::is('admin.featured-category') ? 'active' : '' }}">

            <p class="s-divide">Category->sub->child </p>
            <a href="#" class="nav-link has-dropdown">

             <div class="icon">
                                    <i class="fas fa-list-alt"></i>
                                          </div>
            <span style="color:black">{{__('admin.Manage Categories')}}</span></a>
            <ul class="dropdown-menu">

              <li class="{{ Route::is('admin.product-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product-category.index') }}">{{__('admin.Categories')}}</a></li>

              <li class="{{ Route::is('admin.product-sub-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product-sub-category.index') }}">{{__('admin.Sub Categories')}}</a></li>

              <li class="{{ Route::is('admin.product-child-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product-child-category.index') }}">{{__('admin.Child Categories')}}</a></li>

              <li class="{{ Route::is('admin.product-brand.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product-brand.index') }}">{{__('admin.Brands')}}</a></li>

              <!--<li class="{{ Route::is('admin.mega-menu-category.*') || Route::is('admin.mega-menu-sub-category') || Route::is('admin.create-mega-menu-sub-category') || Route::is('admin.edit-mega-menu-sub-category') || Route::is('admin.mega-menu-banner') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.mega-menu-category.index') }}">{{__('admin.Mega Menu Category')}}</a></li>-->

              {{-- <li class="{{ Route::is('admin.popular-category') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.popular-category') }}">Home Product Slide</a></li>
              <li class="{{ Route::is('admin.pc-builder') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pc-builder') }}">PC Builder</a></li>

               --}}
               <li class="{{ Route::is('admin.featured-category') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.featured-category') }}">{{__('admin.Featured Category')}}</a></li>
               <li class="{{ Route::is('admin.popular-category') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.popular-category') }}">Home Product Slide</a></li>
            </ul>

          </li>

        @endif


        @if(auth()->user()->can('admin.product') || auth()->user()->can('admin.product-brand.index') || auth()->user()->can('admin.product-variant') || auth()->user()->can('admin.create-product-variant') || auth()->user()->can('admin.edit-product-variant') || auth()->user()->can('admin.product-gallery') || auth()->user()->can('admin.product-variant-item	') || auth()->user()->can('admin.create-product-variant-item') || auth()->user()->can('admin.edit-product-variant-item') || auth()->user()->can('admin.product-review') || auth()->user()->can('admin.show-product-review'))
          <li class="nav-item dropdown {{ Route::is('admin.product.*') || Route::is('admin.product-brand.*') || Route::is('admin.product-variant') || Route::is('admin.create-product-variant') || Route::is('admin.edit-product-variant') || Route::is('admin.product-gallery') || Route::is('admin.product-variant-item') || Route::is('admin.create-product-variant-item') || Route::is('admin.edit-product-variant-item') || Route::is('admin.product-review') || Route::is('admin.show-product-review') || Route::is('admin.seller-product') || Route::is('admin.seller-pending-product') || Route::is('admin.wholesale') || Route::is('admin.create-wholesale') || Route::is('admin.edit-wholesale') || Route::is('admin.product-highlight') ||  Route::is('admin.product-report') || Route::is('admin.show-product-report') || Route::is('admin.specification-key.*') || Route::is('admin.stockout-product') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
            <div class="icon">
            <i class="fab fa-product-hunt" style="color:#ffffff"></i>
            </div>
            <span style="color:black">{{__('admin.Manage Products')}}</span></a>
            <ul class="dropdown-menu">

            <!--<li class="{{ Route::is('admin.landing.index.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.landing.index') }}">Product Landing Page </a></li>-->
            {{-- <li class="{{ Route::is('admin.product-brand.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product-brand.index') }}">{{__('admin.Brands')}}</a></li>
            <li>
                <a class="nav-link" href="{{ route('admin.create.size') }}">

           <span style="color:black">Size</span></a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.create.color') }}">

           <span style="color:black">Color</span></a>
            </li> --}}

            <li><a class="nav-link" href="{{ route('admin.product.create') }}">{{__('admin.Create Product')}}</a></li>

            <li class="{{ Route::is('admin.product.*') || Route::is('admin.product-variant') || Route::is('admin.create-product-variant') || Route::is('admin.edit-product-variant') || Route::is('admin.product-gallery') || Route::is('admin.product-variant-item') || Route::is('admin.create-product-variant-item') || Route::is('admin.edit-product-variant-item') || Route::is('admin.wholesale') || Route::is('admin.create-wholesale') || Route::is('admin.edit-wholesale') || Route::is('admin.product-highlight') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product.index') }}">{{__('admin.Products')}}</a></li>

            <li class="{{ Route::is('admin.stockout-product') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.stockout-product') }}">{{__('admin.Stock out')}}</a></li>

            <!--<li class="{{ Route::is('admin.seller-product') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seller-product') }}">{{__('admin.Seller Products')}}</a></li>-->

            <!--<li class="{{ Route::is('admin.seller-pending-product') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seller-pending-product') }}">{{__('admin.Seller Pending Products')}}</a></li>-->

            <li class="{{ Route::is('admin.specification-key.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.specification-key.index') }}">{{__('admin.Specification Key')}}</a></li>

              {{-- <li class="{{ Route::is('admin.product-review') || Route::is('admin.show-product-review') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product-review') }}">{{__('admin.Product Reviews')}}</a></li> --}}

              {{-- <li class="{{ Route::is('admin.product-report') || Route::is('admin.show-product-report') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.product-report') }}">{{__('admin.Product Report')}}</a></li> --}}
              {{-- <li class="{{ Route::is('admin.landing.index') || Route::is('admin.landing.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.landing.index') }}">Landing Page</a></li> --}}
            </ul>

          </li>
          @endif

          @if(auth()->user()->can('admin.inventory'))
          <li class="{{ Route::is('admin.inventory') || Route::is('admin.stock-history') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.inventory') }}">
            <div class="icon">
                <i class="fas fa-money-check-alt"></i>
            </div>
            <span style="color:black">{{__('admin.Inventory')}}</span></a></li>
          @endif

         @if(auth()->user()->can('FlashSale.index') || auth()->user()->can('coupon.index') || auth()->user()->can('product.free-shipping'))
          {{-- <li class="nav-item dropdown {{ Route::is('admin.flash-sale') || Route::is('admin.currency.*') || Route::is('admin.shipping.*') || Route::is('admin.coupon.*') || Route::is('admin.payment-method') || Route::is('admin.flash-sale-product') ? 'active' : '' }}">
          <p class="s-divide">{{__('admin.Shop Setup')}}</p>
            <a href="#" class="nav-link has-dropdown">
            <div class="icon">
            <i class="fas fa-shopping-cart"></i>
            </div>
            <span style="color:black">Promotion</span></a>
            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.flash-sale') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.flash-sale') }}">{{__('admin.Flash Sale')}}</a></li>
                <li class="{{ Route::is('admin.flash-sale-product') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.flash-sale-product') }}">{{__('admin.Flash Sale Product')}}</a></li>
                <li class="{{ Route::is('admin.coupon.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.coupon.index') }}">{{__('admin.Coupon')}}</a></li>

                <li class="{{ Route::is('admin.free_shipping') || Route::is('admin.free_shipping') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.free_shipping') }}">

            <span style="color:black">Free Shipping </span></a></li>
                </ul>

          </li> --}}
          @endif

            <!--<li class="nav-item dropdown {{ Route::is('admin.country.*') || Route::is('admin.state.*') || Route::is('admin.city.*') ? 'active' : '' }}">-->

            <!--           <a href="#" class="nav-link has-dropdown">-->
            <!--           <div class="icon">-->
            <!--            <i class="fas fa-map-marker-alt"></i>-->
            <!--           </div>-->
            <!--          <span>{{__('admin.Locations')}}</span></a>-->

            <!--           <ul class="dropdown-menu">-->

            <!--               <li class="{{ Route::is('admin.country.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.country.index') }}">{{__('admin.Country / Region')}}</a></li>-->

            <!--               <li class="{{ Route::is('admin.state.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.state.index') }}">{{__('admin.State / Province')}}</a></li>-->

            <!--               <li class="{{ Route::is('admin.city.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.city.index') }}">{{__('admin.City / Delivery Area')}}</a></li>-->

            <!--           </ul>-->

            <!--         </li>-->

          <!--  @if(auth()->user()->can('admin.withdraw-method') || auth()->user()->can('admin.seller-withdraw') || auth()->user()->can('admin.pending-seller-withdraw') || auth()->user()->can('admin.show-seller-withdraw'))-->
          <!--<li class="nav-item dropdown {{ Route::is('admin.withdraw-method.*') || Route::is('admin.seller-withdraw') || Route::is('admin.pending-seller-withdraw') || Route::is('admin.show-seller-withdraw')  ? 'active' : '' }}">-->

          <!--  <a href="#" class="nav-link has-dropdown">-->
          <!--  <div class="icon">-->
          <!--  <i class="far fa-newspaper" style="color: #ffffff"></i>-->
          <!-- </div>-->
          <!--  <span style="color:black">{{__('admin.Withdraw Payment')}}</span></a>-->

          <!--  <ul class="dropdown-menu">-->
          <!--      <li class="{{ Route::is('admin.withdraw-method.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.withdraw-method.index') }}">{{__('admin.Withdraw Method')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.seller-withdraw') || Route::is('admin.show-seller-withdraw') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seller-withdraw') }}">{{__('admin.Seller Withdraw')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.pending-seller-withdraw') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-seller-withdraw') }}">{{__('admin.Pending Seller Withdraw')}}</a></li>-->
          <!--  </ul>-->

          <!--</li>-->
          <!--@endif-->

          @if(auth()->user()->can('admin.service') || auth()->user()->can('admin.maintainance-mode') || auth()->user()->can('admin.announcement') || auth()->user()->can('admin.slider.index') || auth()->user()->can('admin.home-page') || auth()->user()->can('admin.banner-image.index') || auth()->user()->can('admin.homepage-one-visibility') || auth()->user()->can('admin.cart-bottom-banner') || auth()->user()->can('admin.shop-page') || auth()->user()->can('admin.menu-visibility') || auth()->user()->can('admin.product-detail-page') || auth()->user()->can('admin.default-avatar'))
          <li class="nav-item dropdown {{ Route::is('admin.service.*') || Route::is('admin.maintainance-mode') || Route::is('admin.announcement') ||  Route::is('admin.slider.*') || Route::is('admin.home-page') || Route::is('admin.banner-image.index') || Route::is('admin.homepage-one-visibility') || Route::is('admin.cart-bottom-banner') || Route::is('admin.shop-page') || Route::is('admin.seo-setup') || Route::is('admin.menu-visibility') || Route::is('admin.product-detail-page') || Route::is('admin.default-avatar') || Route::is('admin.seller-conditions') || Route::is('admin.subscription-banner') || Route::is('admin.testimonial.*') || Route::is('admin.homepage-section-title') ? 'active' : '' }}">

            <p class="s-divide">{{__('admin.Website Settings')}}</p>
            <!--
            <a href="#" class="nav-link has-dropdown">
            <div class="icon">
            <i class="fas fa-globe"></i>
            </div>

            <span style="color:black">{{__('admin.Manage Website')}}</span></a>
            <ul class="dropdown-menu">

                <li class="{{ Route::is('admin.shop-page') ? 'active' : '' }} d-none"><a class="nav-link" href="{{ route('admin.shop-page') }}">{{ __('admin.Shop Page') }}</a></li>

                <li class="{{ Route::is('admin.service.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.service.index') }}">{{__('admin.Service')}}</a></li>

                <li class="{{ Route::is('admin.homepage-section-title') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.homepage-section-title') }}">{{__('admin.Homepage Section Title')}}</a></li>

                <li class="{{ Route::is('admin.seller-conditions') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seller-conditions') }}">{{__('admin.Seller Conditions')}}</a></li>

                <li class="{{ Route::is('admin.testimonial.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.testimonial.index') }}">{{__('admin.Testimonial')}}</a></li>

                <li class="{{ Route::is('admin.maintainance-mode') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.maintainance-mode') }}">{{__('admin.Maintainance Mode')}}</a></li>

                <li class="{{ Route::is('admin.announcement') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.announcement') }}">{{__('admin.Announcement')}}</a></li>

                <li class="{{ Route::is('admin.subscription-banner') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscription-banner') }}">{{__('admin.Subscription Banner')}}</a></li>

                <li class="{{ Route::is('admin.image-content') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.image-content') }}">{{__('admin.Image Content')}}</a></li>

                <li class="{{ Route::is('admin.default-avatar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.default-avatar') }}">{{__('admin.Default Avatar')}}</a></li>

            </ul>
         -->
          </li>

          @endif

          <!--@if(auth()->user()->can('admin.advertisement'))-->
          <!--<li class="nav-item dropdown {{ Route::is('admin.advertisement.*') || Route::is('admin.footer.*') || Route::is('admin.social-link.*') || Route::is('admin.footer-link.*') || Route::is('admin.second-col-footer-link') || Route::is('admin.third-col-footer-link') ? 'active' : '' }}">-->

          <!--  <a href="#" class="nav-link has-dropdown">-->
          <!--  <div class="icon">-->
          <!--  <i class="fas fa-th-large"></i>-->
          <!--  </div>-->

          <!--  <span style="color:black">{{__('admin.Website Footer')}}</span></a>-->

          <!--  <ul class="dropdown-menu">-->

                <!--<li class="{{ Route::is('admin.footer.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.footer.index') }}">{{__('admin.Footer')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.social-link.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.social-link.index') }}">{{__('admin.Social Link')}}</a></li>-->

                <!--<li class="{{ Route::is('admin.footer-link.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.footer-link.index') }}">{{__('admin.First Column Link')}}</a></li>-->

                <!--<li class="{{ Route::is('admin.second-col-footer-link') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.second-col-footer-link') }}">{{__('admin.Second Column Link')}}</a></li>-->

                <!--<li class="{{ Route::is('admin.third-col-footer-link') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.third-col-footer-link') }}">{{__('admin.Third Column Link')}}</a></li>-->
          <!--      <li class="{{ Route::is('admin.advertisement.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.advertisement') }}">-->
          <!-- <span style="color:black" >Footer Images</span></a></li>-->
           <!--<li class="{{ Route::is('admin.faq.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.faq.index') }}">Footer First Section</a></li>-->
          <!--  </ul>-->

          <!--</li>-->
          <!--@endif-->
          <li class="nav-item dropdown {{ Route::is('admin.about-us.*') || Route::is('admin.custom-page.*') || Route::is('admin.terms-and-condition.*') || Route::is('admin.privacy-policy.*')  || Route::is('admin.error-page.*') || Route::is('admin.contact-us.*') || Route::is('admin.login-page') ? 'active' : '' }}">

            <a href="#" class="nav-link has-dropdown">

            <div class="icon">
            <i class="fas fa-columns"></i>

            </div>
            <span>{{__('admin.Pages')}}</span></a>
            <ul class="dropdown-menu">

                <!--<li class="{{ Route::is('admin.about-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-us.index') }}">Home Page Setting</a></li>-->

                <!--<li class="{{ Route::is('admin.contact-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-us.index') }}">{{__('admin.Contact Us')}}</a></li>-->

                <li class="{{ Route::is('admin.custom-page.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.custom-page.index') }}">{{__('admin.Custom Page')}}</a></li>

                <!--<li class="{{ Route::is('admin.terms-and-condition.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.terms-and-condition.index') }}">{{__('admin.Terms And Conditions')}}</a></li>-->

                <!--<li class="{{ Route::is('admin.privacy-policy.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.privacy-policy.index') }}">{{__('admin.Privacy Policy')}}</a></li>-->

                <!--<li class="{{ Route::is('admin.faq.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.faq.index') }}">{{__('admin.FAQ')}}</a></li>-->

                <!--<li class="{{ Route::is('admin.error-page.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.error-page.index') }}">{{__('admin.Error Page')}}</a></li>-->

                <!--<li class="{{ Route::is('admin.login-page') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.login-page') }}">{{__('admin.Login Page')}}</a></li>-->
            </ul>

          </li>

          <!--<li class="nav-item dropdown {{ Route::is('admin.blog-category.*') || Route::is('admin.blog.*') || Route::is('admin.popular-blog.*') || Route::is('admin.blog-comment.*') ? 'active' : '' }}">-->

          <!--  <a href="#" class="nav-link has-dropdown">-->
          <!--  <div class="icon">-->
          <!--  <i class="fas fa-th-large"></i>-->
          <!--  </div>-->
          <!--  <span style="color:black">{{__('admin.Blogs')}}</span></a>-->

          <!--  <ul class="dropdown-menu">-->

          <!--      <li class="{{ Route::is('admin.blog-category.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-category.index') }}">{{__('admin.Categories')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.blog.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog.index') }}">{{__('admin.Blogs')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.popular-blog.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.popular-blog.index') }}">{{__('admin.Popular Blogs')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.blog-comment.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog-comment.index') }}">{{__('admin.Comments')}}</a></li>-->

          <!--  </ul>-->

          <!--</li>-->



          <!--<li class="nav-item dropdown {{ Route::is('admin.email-configuration') || Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}">-->
          <!-- <p class="s-divide">{{__('admin.Configuration')}}</p>-->
          <!--  <a href="#" class="nav-link has-dropdown">-->
          <!--  <div class="icon">-->
          <!--  <i class="fas fa-envelope"></i>-->
          <!--  </div>-->
          <!--  <span>{{__('admin.Email Configuration')}}</span></a>-->

          <!--  <ul class="dropdown-menu">-->

          <!--      <li class="{{ Route::is('admin.email-configuration') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-configuration') }}">{{__('admin.Setting')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.email-template') || Route::is('admin.edit-email-template') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.email-template') }}">{{__('admin.Email Template')}}</a></li>-->

          <!--  </ul>-->

          <!--</li>-->

          <!--<li class="nav-item dropdown {{ Route::is('admin.sms-notification') || Route::is('admin.sms-template') || Route::is('admin.edit-sms-template') ? 'active' : '' }}">-->
          <!--  <a href="#" class="nav-link has-dropdown">-->

          <!--      <div class="icon">-->
          <!--          <i class="fas fa-envelope"></i>-->
          <!--      </div>-->

          <!--      <span>{{__('admin.Sms Configuration')}}</span></a>-->

          <!--  <ul class="dropdown-menu">-->
          <!--      <li class="{{ Route::is('admin.sms-notification') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.sms-notification') }}">{{__('admin.Setting')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.sms-template') || Route::is('admin.edit-sms-template') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.sms-template') }}">{{__('admin.Sms Template')}}</a></li>-->
          <!--  </ul>-->
          <!--</li>-->

          <!--<li class="{{ Route::is('admin.subscriber') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.subscriber') }}">-->

          <!--           <div class="icon">-->
          <!--           <i class="fas fa-fire"></i>-->
          <!--           </div>-->
          <!--           <span>{{__('admin.Subscribers')}}</span></a></li>-->

          <!--<li class="nav-item dropdown {{ Route::is('admin.admin-language') || Route::is('admin.admin-validation-language') || Route::is('admin.website-language') || Route::is('admin.website-validation-language') ? 'active' : '' }}">-->
          <!--  <a href="#" class="nav-link has-dropdown">-->
          <!--  <div class="icon">-->
          <!--  <i class="fas fa-th-large"></i>-->
          <!--  </div>-->
          <!--  <span>{{__('admin.Language')}}</span></a>-->

          <!--  <ul class="dropdown-menu">-->
          <!--      <li class="{{ Route::is('admin.admin-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin-language') }}">{{__('admin.Admin Language')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.admin-validation-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin-validation-language') }}">{{__('admin.Admin Validation')}}</a></li>-->

          <!--      <li class="{{ Route::is('admin.website-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.website-language') }}">{{__('admin.Frontend Language')}}</a></li>-->
          <!--      <li class="{{ Route::is('admin.website-validation-language') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.website-validation-language') }}">{{__('admin.Frontend Validation')}}</a></li>-->
          <!--  </ul>-->
          <!--</li>-->

          <!--<li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}">-->
          <!--<p class="s-divide">Product Attribute</p>-->

          <!--<a class="nav-link" href="{{ route('admin.create.size') }}">-->
          <!-- <div class="icon">-->
          <!-- <i class="fas fa-cog"></i>-->
          <!-- </div>-->
          <!-- <span style="color:black">Size</span></a>-->

          <!-- <a class="nav-link" href="{{ route('admin.create.color') }}">-->
          <!-- <div class="icon">-->
          <!-- <i class="fas fa-cog"></i>-->
          <!-- </div>-->
          <!-- <span style="color:black">Color</span></a>-->
          <!--</li>-->

         @if(auth()->user()->can('homepage-setting') || auth()->user()->can('homepage-setting') || auth()->user()->can('homepage-setting') ||auth()->user()->can('shipping-method-index') || auth()->user()->can('payment-method-index') || auth()->user()->can('seoSetup') || auth()->user()->can('slider.index') || auth()->user()->can('social.index') || auth()->user()->can('footer-image'))
        <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
            <div class="icon">

              <i class="fas fa-cog" aria-hidden="true"></i>

            </div>
            <span>{{__('admin.Settings')}}</span></a>

            <ul class="dropdown-menu">
                @if(auth()->user()->can('admin.general-setting'))
                <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.general-setting') }}">Settings</a></li>
                <li class="{{ Route::is('admin.shipping.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.shipping.index') }}">{{__('admin.Shipping Rule')}}</a></li>
                {{-- <li class="{{ Route::is('admin.courier-setting') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.courier-setting') }}">Courier Setting</a></li> --}}
                @endif
                @if(auth()->user()->can('admin.about-us.index'))
          <!--<li class="{{ Route::is('admin.about-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-us.index') }}">Home Page Setting</a></li>-->
          {{-- <li class="{{ Route::is('admin.about-us') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-us.index') }}">
           <span style="color:black">Home Page Setting</span></a>
          </li>
          <li class="{{ Route::is('admin.shipping.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.shipping.index') }}">{{__('admin.Shipping Rule')}}</a></li>
                <li class="{{ Route::is('admin.payment-method') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.payment-method') }}">{{__('admin.Payment Method')}}</a></li> --}}
          @endif
           @if(auth()->user()->can('admin.seo-setup') || auth()->user()->can('admin.slider'))
          <li class="{{ Route::is('admin.seo-setup') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seo-setup') }}">{{__('admin.SEO Setup')}}</a></li>

          <li class="{{ Route::is('admin.slider.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.slider.index') }}">{{__('admin.Slider')}}</a></li>
          @endif
          <li class="{{ Route::is('admin.social-link.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.social-link.index') }}">{{__('admin.Social Link')}}</a></li>
          <li class="{{ Route::is('admin.advertisement.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.advertisement') }}">
           Footer Images</a>
          </li>
          <li class="{{ Route::is('admin.about-us.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.about-us.index') }}">Home Page Setting</a></li>

            </ul>
          </li>
        @endif

         <!-- @if(auth()->user()->can('admin.general-setting'))-->
         <!-- <li class="{{ Route::is('admin.general-setting') ? 'active' : '' }}">-->
         <!-- <p class="s-divide">{{__('admin.Settings')}}</p>-->

         <!-- <a class="nav-link" href="{{ route('admin.general-setting') }}">-->


         <!--  <div class="icon">-->
         <!--  <i class="fas fa-cog"></i>-->
         <!--  </div>-->
         <!--  <span style="color:black">{{__('admin.Setting')}}</span></a>-->
         <!-- </li>-->


         <!-- <li class="{{ Route::is('admin.courier-setting') ? 'active' : '' }}">-->
         <!-- <p class="s-divide">Courier Setting</p>-->

         <!-- <a class="nav-link" href="{{ route('admin.courier-setting') }}">-->
         <!--  <div class="icon">-->
         <!--  <i class="fas fa-cog"></i>-->
         <!--  </div>-->
         <!--  <span style="color:black">Courier Setting</span></a>-->
         <!-- </li>-->
         <!--@endif-->
           @php
              $logedInAdmin = Auth::guard('admin')->user();
          @endphp

          <li class="{{ Route::is('admin.report.order') ? 'active' : '' }}">
            <p class="s-divide">User Manaqe</p>
          </li>


          <!--<li class="{{ Route::is('admin.contact-message') || Route::is('admin.show-contact-message') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.contact-message') }}">-->
          <!-- <div class="icon">-->
          <!-- <i class="fas fa-fa fa-envelope"></i>-->
          <!-- </div>-->
          <!-- <span>{{__('admin.Contact Message')}}</span></a></li>-->



          <!--@if(auth()->user()->can('admin.admin.index'))-->
          <!--  <li class="{{ Route::is('admin.admin.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.admin.index') }}">-->
          <!--   <div class="icon">-->
          <!--   <i class="fas fa-user"></i>-->
          <!--   </div>-->
          <!--   <span style="color:black">{{__('admin.Admin list')}}</span></a></li>-->
          <!--   @endif-->

             @if(auth()->user()->can('admin.user.index'))
             <li class="{{ Route::is('admin.user.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.user.index') }}">
             <div class="icon">
             <i class="fas fa-users"></i>

             </div>

             <span style="color:black">Employee list</span></a></li>
            @endif

            {{-- @if(auth()->user()->can('admin.customer-list') || auth()->user()->can('admin.customer-show') || auth()->user()->can('admin.pending-customer-list') || auth()->user()->can('admin.seller-list') || auth()->user()->can('admin.seller-show') || auth()->user()->can('admin.pending-seller-list') || auth()->user()->can('admin.seller-shop-detail') || auth()->user()->can('admin.seller-reviews') || auth()->user()->can('admin.show-seller-review-details') || auth()->user()->can('admin.send-email-to-seller') || auth()->user()->can('admin.email-history') || auth()->user()->can('admin.product-by-seller') || auth()->user()->can('admin.send-email-to-all-customer'))
          <li class="nav-item dropdown {{  Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.pending-customer-list') || Route::is('admin.seller-list') || Route::is('admin.seller-show') || Route::is('admin.pending-seller-list') || Route::is('admin.seller-shop-detail') || Route::is('admin.seller-reviews') || Route::is('admin.show-seller-review-details') || Route::is('admin.send-email-to-seller') || Route::is('admin.email-history') || Route::is('admin.product-by-seller') || Route::is('admin.send-email-to-all-seller') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}">

                <a href="#" class="nav-link has-dropdown">
                <div class="icon">
                <i class="fas fa-user"></i>
                </div>
                <span style="color:black">{{__('admin.Users')}}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.ipblock') }}">Block User</a></li>
                    <li class="{{ Route::is('admin.customer-list') || Route::is('admin.customer-show') || Route::is('admin.send-email-to-all-customer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.customer-list') }}">{{__('admin.Customer List')}}</a></li>

                    <li class="{{ Route::is('admin.pending-customer-list') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-customer-list') }}">{{__('admin.Pending Customers')}}</a></li>

                    <!--<li class="{{ Route::is('admin.seller-list') || Route::is('admin.seller-show') || Route::is('admin.seller-shop-detail') || Route::is('admin.seller-reviews') || Route::is('admin.show-seller-review-details') || Route::is('admin.send-email-to-seller') || Route::is('admin.email-history') || Route::is('admin.product-by-seller') || Route::is('admin.send-email-to-all-seller') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.seller-list') }}">{{__('admin.Seller List')}}</a></li>-->

                    <!--<li class="{{ Route::is('admin.pending-seller-list') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.pending-seller-list') }}">{{__('admin.Pending Sellers')}}</a></li>-->
                </ul>
            </li>
          @endif --}}

            @if(auth()->user()->can('admin.user.role.index'))
             <li class="{{ Route::is('admin.user.role.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.user.role.index') }}">
             <div class="icon">


             <i class="fas fa-blind"></i>
             </div>
             <span style="color:black">Role list</span></a></li>
            @endif

            @if(auth()->user()->can('admin.user.permission.index'))
             <li class="{{ Route::is('admin.user.permission.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.user.permission.index') }}">
             <div class="icon">
             <i class="fas fa-lock"></i>
             </div>
             <span style="color:black">Permission list</span></a></li>
             @endif


        </ul>
    </aside>

  </div>

