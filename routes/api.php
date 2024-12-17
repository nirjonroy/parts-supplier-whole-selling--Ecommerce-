<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProfileController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerProductGalleryController;
use App\Http\Controllers\Seller\SellerProductVariantController;
use App\Http\Controllers\Seller\SellerProductVariantItemController;
use App\Http\Controllers\Seller\SellerProductReviewController;
use App\Http\Controllers\Seller\WithdrawController;
use App\Http\Controllers\Seller\SellerProductReportControler;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerMessageContoller;



use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\AddressCotroller;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::group(['middleware' => ['demo','XSS']], function () {

Route::group(['middleware' => ['maintainance','HtmlSpecialchars']], function () {

    Route::get('/website-setup', [HomeController::class, 'websiteSetup'])->name('website-setup');

    Route::get('/subcategory-by-category/{id}', [HomeController::class, 'subCategoriesByCategory'])->name('subcategory-by-category');
    Route::get('/childcategory-by-subcategory/{id}', [HomeController::class, 'childCategoriesBySubCategory'])->name('childcategory-by-subcategory');
    Route::get('/category-list', [HomeController::class, 'categoryList'])->name('category-list');
    Route::get('/category/{id}', [HomeController::class, 'category'])->name('category');
    Route::get('/sub-category/{id}', [HomeController::class, 'subCategory'])->name('sub-category');
    Route::get('/child-category/{id}', [HomeController::class, 'childCategory'])->name('child-category');

    Route::get('/product-by-category/{id}', [HomeController::class, 'productByCategory'])->name('product-by-category');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    Route::post('/send-contact-message', [HomeController::class, 'sendContactMessage'])->name('send-contact-message');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/blog/{slug}', [HomeController::class, 'blogDetail'])->name('blog-detail');
    Route::post('/blog-comment', [HomeController::class, 'blogComment'])->name('blog-comment');

    Route::get('/track-order-response/{id}', [HomeController::class, 'trackOrderResponse'])->name('track-order-response');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/page', [HomeController::class, 'allCustomPage'])->name('custom-page');
    Route::get('/page/{slug}', [HomeController::class, 'customPage'])->name('page');
    Route::get('/terms-and-conditions', [HomeController::class, 'termsAndCondition'])->name('terms-and-conditions');
    Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/seller-terms-conditoins', [HomeController::class, 'sellerTemsCondition'])->name('seller-terms-conditoins');

    Route::get('/sellers', [HomeController::class, 'seller'])->name('sellers');
    Route::get('/sellers/{shop_name}', [HomeController::class, 'sellerDetail'])->name('seller-detail');
    Route::get('/product', [HomeController::class, 'product'])->name('product');
    Route::get('/variant-items-by-variant/{variant_name}', [HomeController::class, 'variantItemsByVariant'])->name('variant-items-by-variant');
    Route::get('/search-product', [HomeController::class, 'searchProduct'])->name('search-product');
    Route::get('/product/{slug}', [HomeController::class, 'productDetail'])->name('product-detail');
    Route::get('/product-review-list/{id}', [HomeController::class, 'productReviewList'])->name('product-review-list');

    Route::get('/compare', [HomeController::class, 'compare'])->name('compare');
    Route::get('/add-to-compare/{id}', [HomeController::class, 'addToCompare'])->name('add-to-compare');
    Route::get('/remove-compare/{id}', [HomeController::class, 'removeCompare'])->name('remove-compare');
    Route::get('/flash-sale', [HomeController::class, 'flashSale'])->name('flash-sale');
    Route::post('subscribe-request', [HomeController::class, 'subscribeRequest'])->name('subscribe-request');
    Route::get('subscriber-verification/{token}', [HomeController::class, 'subscriberVerifcation'])->name('subscriber-verification');

    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('/cart-clear', [CartController::class, 'cartClear'])->name('cart-clear');
    Route::get('/cart-item-remove/{id}', [CartController::class, 'cartItemRemove'])->name('cart-item-remove');
    Route::get('/cart-item-increment/{id}', [CartController::class, 'cartItemIncrement'])->name('cart-item-increment');
    Route::get('/cart-item-decrement/{id}', [CartController::class, 'cartItemDecrement'])->name('cart-item-decrement');

    Route::get('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
    Route::get('/calculate-product-price', [CartController::class, 'calculateProductPrice'])->name('calculate-product-price');

    Route::get('login/google',[LoginController::class, 'redirectToGoogle'])->name('login-google');
    Route::get('/callback/google',[LoginController::class,'googleCallBack'])->name('callback-google');

    Route::get('login/facebook',[LoginController::class, 'redirectToFacebook'])->name('login-facebook');
    Route::get('/callback/facebook',[LoginController::class,'facebookCallBack'])->name('callback-facebook');


    Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
    Route::post('/store-login', [LoginController::class, 'storeLogin'])->name('store-login');
    Route::post('/resend-register-code', [RegisterController::class, 'resendRegisterCode'])->name('resend-register-code');
    Route::post('/store-register', [RegisterController::class, 'storeRegister'])->name('store-register');
    Route::get('/user-verification/{token}', [RegisterController::class, 'userVerification'])->name('user-verification');
    Route::get('/forget-password', [LoginController::class, 'forgetPage'])->name('forget-password');
    Route::post('/send-forget-password', [LoginController::class, 'sendForgetPassword'])->name('send-forget-password');
    Route::get('/reset-password/{token}', [LoginController::class, 'resetPasswordPage'])->name('reset-password');
    Route::post('/store-reset-password/{token}', [LoginController::class, 'storeResetPasswordPage'])->name('store-reset-password');
    Route::get('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');

    Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){
        Route::get('dashboard', [UserProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('order', [UserProfileController::class, 'order'])->name('order');
        Route::get('pending-order', [UserProfileController::class, 'pendingOrder'])->name('pending-order');
        Route::get('complete-order', [UserProfileController::class, 'completeOrder'])->name('complete-order');
        Route::get('declined-order', [UserProfileController::class, 'declinedOrder'])->name('declined-order');
        Route::get('order-show/{id}', [UserProfileController::class, 'orderShow'])->name('order-show');
        Route::get('review', [UserProfileController::class, 'review'])->name('review');
        Route::get('get-review/{id}', [UserProfileController::class, 'showReview'])->name('show-review');
        Route::get('my-profile', [UserProfileController::class, 'myProfile'])->name('my-profile');
        Route::post('update-profile', [UserProfileController::class, 'updateProfile'])->name('update-profile');
        Route::get('address', [UserProfileController::class, 'address'])->name('address');
        Route::post('update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');

        Route::delete('remove-account', [UserProfileController::class, 'remove_account'])->name('remove-account');


        Route::resource('address', AddressCotroller::class);

        Route::get('compare-product', [UserProfileController::class, 'compareProducts'])->name('compare-product');
        Route::get('add-compare-product/{id}', [UserProfileController::class, 'addCompareProducts'])->name('add-compare-product');
        Route::delete('delete-compare-product/{id}', [UserProfileController::class, 'deleteCompareProduct'])->name('delete-compare-product');

        Route::post('seller-request', [UserProfileController::class, 'sellerRequest'])->name('seller-request');
        Route::get('wishlist', [UserProfileController::class, 'wishlist'])->name('wishlist');
        Route::get('add-to-wishlist/{id}', [UserProfileController::class, 'addToWishlist'])->name('add-to-wishlist');
        Route::delete('delete-wishlist/{id}', [UserProfileController::class, 'removeWishlist'])->name('delete-wishlist');


        Route::get('clear-wishlist', [UserProfileController::class, 'clearWishlist'])->name('clear-wishlist');
        Route::post('product-report', [UserProfileController::class, 'storeProductReport'])->name('product-report');
        Route::post('store-product-review', [UserProfileController::class, 'storeProductReview'])->name('store-product-review');
        Route::post('update-review/{id}', [UserProfileController::class, 'updateReview'])->name('update-review');

        Route::get('chat-with-seller/{slug}', [MessageController::class, 'chatWithSeller'])->name('chat-with-seller');
        Route::get('message', [MessageController::class, 'index'])->name('message');
        Route::get('load-chat-box/{id}', [MessageController::class, 'loadChatBox'])->name('load-chat-box');
        Route::get('load-new-message/{id}', [MessageController::class, 'loadNewMessage'])->name('load-new-message');
        Route::get('send-message', [MessageController::class, 'sendMessage'])->name('send-message');

        Route::group(['as'=> 'checkout.', 'prefix' => 'checkout'],function (){
            Route::get('/', [CheckoutController::class, 'checkout'])->name('checkout');

            Route::post('/cash-on-delivery', [PaymentController::class, 'cashOnDelivery'])->name('cash-on-delivery');
            Route::post('/pay-with-stripe', [PaymentController::class, 'payWithStripe'])->name('pay-with-stripe');



            Route::post('/pay-with-bank', [PaymentController::class, 'payWithBank'])->name('pay-with-bank');
        });

        Route::get('state-by-country/{id}', [UserProfileController::class, 'stateByCountry'])->name('state-by-country');
        Route::get('city-by-state/{id}', [UserProfileController::class, 'cityByState'])->name('city-by-state');
    });


    Route::group(['as'=> 'seller.', 'prefix' => 'seller','middleware' => ['checkseller']],function (){
        Route::get('dashboard',[SellerDashboardController::class,'index'])->name('dashboard');
        Route::get('my-profile',[SellerProfileController::class,'index'])->name('my-profile');
        Route::get('state-by-country/{id}',[SellerProfileController::class,'stateByCountry'])->name('state-by-country');
        Route::get('city-by-state/{id}',[SellerProfileController::class,'cityByState'])->name('city-by-state');
        Route::put('update-seller-profile',[SellerProfileController::class,'updateSellerProfile'])->name('update-seller-profile');
        Route::get('change-password',[SellerProfileController::class,'changePassword'])->name('change-password');
        Route::put('password-update',[SellerProfileController::class,'updatePassword'])->name('password-update');
        Route::get('shop-profile',[SellerProfileController::class,'myShop'])->name('shop-profile');
        Route::put('update-seller-shop',[SellerProfileController::class,'updateSellerSop'])->name('update-seller-shop');
        Route::put('remove-seller-social-link/{id}',[SellerProfileController::class,'removeSellerSocialLink'])->name('remove-seller-social-link');
        Route::get('email-history',[SellerProfileController::class,'emailHistory'])->name('email-history');

        Route::resource('product', SellerProductController::class);
        Route::put('product-status/{id}', [SellerProductController::class,'changeStatus'])->name('product.status');
        Route::put('removed-product-exist-specification/{id}', [SellerProductController::class,'removedProductExistSpecification'])->name('removed-product-exist-specification');
        Route::get('pending-product', [SellerProductController::class,'pendingProduct'])->name('pending-product');
        Route::get('product-highlight/{id}', [SellerProductController::class,'productHighlight'])->name('product-highlight');
        Route::put('update-product-highlight/{id}', [SellerProductController::class,'productHighlightUpdate'])->name('update-product-highlight');


        Route::get('subcategory-by-category/{id}', [SellerProductController::class,'getSubcategoryByCategory'])->name('subcategory-by-category');
        Route::get('childcategory-by-subcategory/{id}', [SellerProductController::class,'getChildcategoryBySubCategory'])->name('childcategory-by-subcategory');


        Route::get('product-variant/{id}', [SellerProductVariantController::class,'index'])->name('product-variant');
        Route::get('create-product-variant/{id}', [SellerProductVariantController::class,'create'])->name('create-product-variant');
        Route::post('store-product-variant', [SellerProductVariantController::class,'store'])->name('store-product-variant');
        Route::get('get-product-variant/{id}', [SellerProductVariantController::class,'show'])->name('get-product-variant');
        Route::get('edit-product-variant/{id}', [SellerProductVariantController::class,'edit'])->name('edit-product-variant');
        Route::put('update-product-variant/{id}', [SellerProductVariantController::class,'update'])->name('update-product-variant');
        Route::delete('delete-product-variant/{id}', [SellerProductVariantController::class,'destroy'])->name('delete-product-variant');
        Route::put('product-variant-status/{id}', [SellerProductVariantController::class,'changeStatus'])->name('product-variant.status');

        Route::get('product-variant-item', [SellerProductVariantItemController::class,'index'])->name('product-variant-item');
        Route::get('create-product-variant-item/{id}', [SellerProductVariantItemController::class,'create'])->name('create-product-variant-item');
        Route::post('store-product-variant-item', [SellerProductVariantItemController::class,'store'])->name('store-product-variant-item');
        Route::get('edit-product-variant-item/{id}', [SellerProductVariantItemController::class,'edit'])->name('edit-product-variant-item');

        Route::get('get-product-variant-item/{id}', [SellerProductVariantItemController::class,'show'])->name('egetdit-product-variant-item');

        Route::put('update-product-variant-item/{id}', [SellerProductVariantItemController::class,'update'])->name('update-product-variant-item');
        Route::delete('delete-product-variant-item/{id}', [SellerProductVariantItemController::class,'destroy'])->name('delete-product-variant-item');
        Route::put('product-variant-item-status/{id}', [SellerProductVariantItemController::class,'changeStatus'])->name('product-variant-item.status');

        Route::get('product-gallery/{id}', [SellerProductGalleryController::class,'index'])->name('product-gallery');
        Route::post('store-product-gallery', [SellerProductGalleryController::class,'store'])->name('store-product-gallery');
        Route::delete('delete-product-image/{id}', [SellerProductGalleryController::class,'destroy'])->name('delete-product-image');
        Route::put('product-gallery-status/{id}', [SellerProductGalleryController::class,'changeStatus'])->name('product-gallery.status');


        Route::get('product-review',[SellerProductReviewController::class,'index'])->name('product-review');
        Route::put('product-review-status/{id}',[SellerProductReviewController::class,'changeStatus'])->name('product-review-status');
        Route::get('show-product-review/{id}',[SellerProductReviewController::class,'show'])->name('show-product-review');


        Route::get('product-report',[SellerProductReportControler::class, 'index'])->name('product-report');
        Route::get('show-product-report/{id}',[SellerProductReportControler::class, 'show'])->name('show-product-report');

        Route::resource('my-withdraw', WithdrawController::class);
        Route::get('get-withdraw-account-info/{id}', [WithdrawController::class, 'getWithDrawAccountInfo'])->name('get-withdraw-account-info');

        Route::get('all-order', [SellerOrderController::class, 'index'])->name('all-order');
        Route::get('pending-order', [SellerOrderController::class, 'pendingOrder'])->name('pending-order');
        Route::get('pregress-order', [SellerOrderController::class, 'pregressOrder'])->name('pregress-order');
        Route::get('delivered-order', [SellerOrderController::class, 'deliveredOrder'])->name('delivered-order');
        Route::get('completed-order', [SellerOrderController::class, 'completedOrder'])->name('completed-order');
        Route::get('declined-order', [SellerOrderController::class, 'declinedOrder'])->name('declined-order');
        Route::get('cash-on-delivery', [SellerOrderController::class, 'cashOnDelivery'])->name('cash-on-delivery');
        Route::get('order-show/{id}', [SellerOrderController::class, 'show'])->name('order-show');

        Route::get('message', [SellerMessageContoller::class, 'index'])->name('message');
        Route::get('load-chat-box/{id}', [SellerMessageContoller::class, 'loadChatBox'])->name('load-chat-box');
        Route::get('load-new-message/{id}', [SellerMessageContoller::class, 'loadNewMessage'])->name('load-new-message');
        Route::get('send-message', [SellerMessageContoller::class, 'sendMessage'])->name('send-message');

    });


});


});
