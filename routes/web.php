<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stripePaymentController;
use App\Http\Controllers\WEB\Admin\UserController;
use App\Http\Controllers\WEB\Admin\DashboardController;
use App\Http\Controllers\WEB\Admin\Auth\AdminLoginController;
use App\Http\Controllers\WEB\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\WEB\Admin\AdminProfileController;
use App\Http\Controllers\WEB\Admin\ProductCategoryController;
use App\Http\Controllers\WEB\Admin\ProductSubCategoryController;
use App\Http\Controllers\WEB\Admin\ProductChildCategoryController;
use App\Http\Controllers\WEB\Admin\ProductBrandController;
use App\Http\Controllers\WEB\Admin\SpecificationKeyController;
use App\Http\Controllers\WEB\Admin\TestimonialController;
use App\Http\Controllers\WEB\Admin\ProductController;
use App\Http\Controllers\WEB\Admin\ProductGalleryController;
use App\Http\Controllers\WEB\Admin\ServiceController;
use App\Http\Controllers\WEB\Admin\AboutUsController;
use App\Http\Controllers\WEB\Admin\ContactPageController;
use App\Http\Controllers\WEB\Admin\CustomPageController;
use App\Http\Controllers\WEB\Admin\TermsAndConditionController;
use App\Http\Controllers\WEB\Admin\PrivacyPolicyController;
use App\Http\Controllers\WEB\Admin\BlogCategoryController;
use App\Http\Controllers\WEB\Admin\BlogController;
use App\Http\Controllers\WEB\Admin\PopularBlogController;
use App\Http\Controllers\WEB\Admin\BlogCommentController;
use App\Http\Controllers\WEB\Admin\ProductVariantController;
use App\Http\Controllers\WEB\Admin\ProductVariantItemController;
use App\Http\Controllers\WEB\Admin\SettingController;
use App\Http\Controllers\WEB\Admin\SubscriberController;
use App\Http\Controllers\WEB\Admin\ContactMessageController;
use App\Http\Controllers\WEB\Admin\EmailConfigurationController;
use App\Http\Controllers\WEB\Admin\EmailTemplateController;
use App\Http\Controllers\WEB\Admin\AdminController;
use App\Http\Controllers\WEB\Admin\FaqController;
use App\Http\Controllers\WEB\Admin\ProductReviewController;
use App\Http\Controllers\WEB\Admin\CustomerController;
use App\Http\Controllers\WEB\Admin\ErrorPageController;
use App\Http\Controllers\WEB\Admin\ContentController;
use App\Http\Controllers\WEB\Admin\CountryController;
use App\Http\Controllers\WEB\Admin\CountryStateController;
use App\Http\Controllers\WEB\Admin\CityController;
use App\Http\Controllers\WEB\Admin\PaymentMethodController;
use App\Http\Controllers\WEB\Admin\SellerController;
use App\Http\Controllers\WEB\Admin\MegaMenuController;
use App\Http\Controllers\WEB\Admin\MegaMenuSubCategoryController;
use App\Http\Controllers\WEB\Admin\SliderController;
use App\Http\Controllers\WEB\Admin\HomePageController;
use App\Http\Controllers\WEB\Admin\ShippingMethodController;
use App\Http\Controllers\WEB\Admin\WithdrawMethodController;
use App\Http\Controllers\WEB\Admin\SellerWithdrawController;
use App\Http\Controllers\WEB\Admin\ProductReportController;
use App\Http\Controllers\WEB\Admin\OrderController;
use App\Http\Controllers\WEB\Admin\CouponController;
use App\Http\Controllers\WEB\Admin\BreadcrumbController;
use App\Http\Controllers\WEB\Admin\FooterController;
use App\Http\Controllers\WEB\Admin\FooterSocialLinkController;
use App\Http\Controllers\WEB\Admin\FooterLinkController;
use App\Http\Controllers\WEB\Admin\HomepageVisibilityController;
use App\Http\Controllers\WEB\Admin\MenuVisibilityController;
use App\Http\Controllers\WEB\Admin\LanguageController;
use App\Http\Controllers\WEB\Admin\AdvertisementController;
use App\Http\Controllers\WEB\Admin\FlashSaleController;
use App\Http\Controllers\WEB\Admin\InventoryController;
use App\Http\Controllers\WEB\Admin\NotificationController;
use App\Http\Controllers\WEB\Admin\LandingPageController;

use App\Http\Controllers\WEB\Admin\IPBlockController;
use App\Http\Controllers\WEB\Admin\AttributeController;
use App\Http\Controllers\WEB\Seller\SellerDashboardController;
use App\Http\Controllers\WEB\Seller\SellerProfileController;
use App\Http\Controllers\WEB\Seller\SellerProductController;
use App\Http\Controllers\WEB\Seller\SellerProductGalleryController;
use App\Http\Controllers\WEB\Seller\SellerProductVariantController;
use App\Http\Controllers\WEB\Seller\SellerProductVariantItemController;
use App\Http\Controllers\WEB\Seller\SellerProductReviewController;
use App\Http\Controllers\WEB\Seller\WithdrawController;
use App\Http\Controllers\WEB\Seller\SellerProductReportControler;
use App\Http\Controllers\WEB\Seller\SellerOrderController;
use App\Http\Controllers\WEB\Seller\SellerMessageContoller;
use App\Http\Controllers\WEB\Seller\InventoryController as SellerInventoryController;

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

use App\Http\Controllers\WEB\Seller\Auth\SellerLoginController;
use App\Http\Controllers\WEB\Seller\Auth\SellerForgotPasswordController;


//Frontend
use App\Http\Controllers\WEB\Frontend\Auth\AuthController as FrontAuthController;
use App\Http\Controllers\WEB\Frontend\HomeController as FrontHomeController;
use App\Http\Controllers\WEB\Frontend\ProductController as FrontProductController;
use App\Http\Controllers\WEB\Frontend\CartController as FrontCartController;
use App\Http\Controllers\WEB\Frontend\CheckoutController as FrontCheckoutController;
use App\Http\Controllers\WEB\Frontend\OrderController as FrontOrderController;

Route::get('/clear-cache', function(){
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    dd("Application all cached has been cleared!");
});

Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){

    Route::get('landing-page/{id}', [LandingPageController::class,'landing_page'])->name('landing_index');

    Route::put('update-facebook-pixel',[ProductController::class,'updateFacebookPixel'])->name('update-facebook-pixel');
    Route::put('update-google-analytic',[ProductController::class,'updateGoogleAnalytic'])->name('update-google-analytic');
    Route::put('update-site-pixel',[ProductController::class,'updateSitePixel'])->name('update-site-pixel');


    Route::group(['as'=> 'checkout.', 'prefix' => 'checkout'],function (){

        Route::get('/paypal-web-view', [PaypalController::class, 'paypalWebView'])->name('paypal-web-view');
        Route::get('/pay-with-paypal', [PaypalController::class, 'payWithPaypal'])->name('pay-with-paypal');
        Route::get('/paypal-payment-success', [PaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success');
        Route::get('/paypal-payment-cancled', [PaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled');

        Route::get('/paypal-react-web-view', [PaypalController::class, 'paypalReactWebView'])->name('paypal-react-web-view');
        Route::get('/pay-with-paypal-from-react', [PaypalController::class, 'payWithPaypalForReactJs'])->name('pay-with-paypal-from-react');
        Route::get('/paypal-payment-success-from-react', [PaypalController::class, 'paypalPaymentSuccessFromReact'])->name('paypal-payment-success-from-react');
        Route::get('/paypal-payment-cancled-from-react', [PaypalController::class, 'paypalPaymentCancledFromReact'])->name('paypal-payment-cancled-from-react');

        Route::get('/razorpay-order', [PaymentController::class, 'razorpayOrder'])->name('razorpay-order');
        Route::get('/razorpay-web-view', [PaymentController::class, 'razorpayWebView'])->name('razorpay-web-view');
        Route::post('razorpay/pay/verify', [PaymentController::class, 'razorpayVerify'])->name('razorpay-pay-verify');

        Route::get('/flutterwave-web-view', [PaymentController::class, 'flutterwaveWebView'])->name('flutterwave-web-view');
        Route::post('/pay-with-flutterwave', [PaymentController::class, 'payWithFlutterwave'])->name('pay-with-flutterwave');

        Route::get('/pay-with-mollie', [PaymentController::class, 'payWithMollie'])->name('pay-with-mollie');
        Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');

        Route::get('/pay-with-instamojo', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
        Route::get('/instamojo-response', [PaymentController::class, 'instamojoResponse'])->name('instamojo-response');

        Route::get('/paystack-web-view', [PaymentController::class, 'paystackWebView'])->name('paystack-web-view');
        Route::post('/pay-with-paystack', [PaymentController::class, 'payWithPayStack'])->name('pay-with-paystack');

        Route::get('/sslcommerz-web-view', [PaymentController::class,   'sslcommerzWebView'])->name('sslcommerz-web-view');
        Route::post('/sslcommerz-pay',     [PaymentController::class,   'sslcommerz'])->name('sslcommerz-pay');
        Route::post('/sslcommerz-success', [PaymentController::class,   'sslcommerz_success'])->name('sslcommerz-success');

        Route::post('/sslcommerz-failed', [PaymentController::class,   'sslcommerz_failed'])->name('sslcommerz-failed');
        Route::post('/sslcommerz-cancel', [PaymentController::class,   'sslcommerz_failed'])->name('sslcommerz-cancel');

        Route::get('order-success-url-for-mobile-app', function(){
            return response()->json(['message' => 'order success']);
        })->name('order-success-url-for-mobile-app');

        Route::get('order-fail-url-for-mobile-app', function(){
            return response()->json(['message' => 'order faild']);
        })->name('order-fail-url-for-mobile-app');

    });
});


Route::group(['middleware' => ['demo','XSS']], function () {
Route::group(['middleware' => ['maintainance']], function () {

    // Route::get('/', function(){
    //     return redirect()->route('admin.login');
    // })->name('home');

    Route::get('seller/login', [SellerLoginController::class,'sellerLoginPage'])->name('seller.login');
    Route::post('seller/login', [SellerLoginController::class,'storeLogin'])->name('seller.login');
    Route::get('seller/logout', [SellerLoginController::class,'adminLogout'])->name('seller.logout');

    Route::group(['as'=> 'seller.', 'prefix' => 'seller'],function (){
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
        Route::get('stockout-product', [SellerProductController::class,'stockoutProduct'])->name('stockout-product');
        Route::put('product-status/{id}', [SellerProductController::class,'changeStatus'])->name('product-status');
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

        Route::get('inventory', [SellerInventoryController::class, 'index'])->name('inventory');
        Route::get('stock-history/{id}', [SellerInventoryController::class, 'show_inventory'])->name('stock-history');
        Route::post('add-stock', [SellerInventoryController::class, 'add_stock'])->name('add-stock');
        Route::delete('delete-stock/{id}', [SellerInventoryController::class, 'delete_stock'])->name('delete-stock');

    });
});



// start admin routes

Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){




    // start auth route


    // Attribute start
    Route::get('create-color', [AttributeController::class,'create_color'])->name('create.color');
    Route::post('store-color', [AttributeController::class,'store_color'])->name('store-color');

    Route::get('create-size', [AttributeController::class,'create_size'])->name('create.size');
    Route::post('store-size', [AttributeController::class,'store_size'])->name('store-size');
    // Attribute End

    // employee
    Route::get('index-user', [UserController::class,'index'])->name('user.index');
    Route::get('create-user', [UserController::class,'create'])->name('user.create');
    Route::post('store-user', [UserController::class,'store'])->name('user.store');
    Route::get('stuff', [UserController::class,'stuffPage'])->name('user.stuff');
    Route::post('stuff-login', [UserController::class,'storeStuffLogin'])->name('user.stuff.login');
    Route::get('edit-user/{id}', [UserController::class,'edit'])->name('user.edit');
    Route::post('update-user/{id}', [UserController::class,'update'])->name('user.update');

    Route::put('employee-status/{id}', [UserController::class,'changeStatus'])->name('user.status');

    // employee
    // permission
    Route::get('index-permission', [UserController::class,'permission_index'])->name('user.permission.index');
    Route::get('create-permission', [UserController::class,'permission_create'])->name('user.permission.create');

    Route::post('store-permission', [UserController::class,'permission_store'])->name('user.permission.store');
    Route::get('edit-permission/{id}', [UserController::class,'permission_edit'])->name('user.permission.edit');
    Route::post('update-permission/{id}', [UserController::class,'permission_update'])->name('user.permission.update');
    Route::get('delete-permission/{id}', [UserController::class,'permission_delete'])->name('user.permission.delete');
    // permission
    Route::get('index-role', [UserController::class,'role_index'])->name('user.role.index');
    Route::get('create-role', [UserController::class,'role_create'])->name('user.role.create');
    Route::post('store-role', [UserController::class,'role_store'])->name('user.role.store');
    Route::get('edit-role/{id}', [UserController::class,'role_edit'])->name('user.role.edit');
    Route::post('update-role/{id}', [UserController::class,'role_update'])->name('user.role.update');
    Route::get('delete-role/{id}', [UserController::class,'role_delete'])->name('user.role.delete');
    // permission
    Route::get('login', [AdminLoginController::class,'adminLoginPage'])->name('login');
    Route::post('login', [AdminLoginController::class,'storeLogin'])->name('login');
    Route::post('logout', [AdminLoginController::class,'adminLogout'])->name('logout');
    Route::get('forget-password', [AdminForgotPasswordController::class,'forgetPassword'])->name('forget-password');
    Route::post('send-forget-password', [AdminForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}', [AdminForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('password-store/{token}', [AdminForgotPasswordController::class,'storeResetData'])->name('store.reset.password');
    // end auth route

  	//IP Block
  	Route::get('/Ip-block', [IPBlockController::class, 'index'])->name('ipblock');
  	Route::get('/Ip-block/delete/{id}', [IPBlockController::class, 'delete'])->name('ipblock.delete');
  	Route::get('/Ip-block/edit/{id}', [IPBlockController::class, 'edit'])->name('ipblock.edit');
	Route::put('/Ip-block/update/{id}', [IPBlockController::class, 'update'])->name('ipblock.update');
    Route::post('/Ip-block-submit', [IPBlockController::class, 'IPBlockSubmit'])->name('ipblock.submit');
  	//ip block end

    Route::get('order-report', [DashboardController::class,'order_report'])->name('order.report');
    Route::get('/order-search', [DashboardController::class,'filterOrder'])->name('report.order.search');
    Route::get('/', [DashboardController::class,'dashobard'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class,'dashobard'])->name('dashboard');
    Route::get('profile', [AdminProfileController::class,'index'])->name('profile');
    Route::put('profile-update', [AdminProfileController::class,'update'])->name('profile.update');

    Route::get('landing-page', [LandingPageController::class, 'index'])->name('landing.index');
    Route::get('landing-page-create', [LandingPageController::class, 'create'])->name('landing.create');
    Route::get('/get-order-product', [LandingPageController::class, 'getOrderProduct'])->name('getOrderProduct');
    Route::get('/get-order-product2', [LandingPageController::class, 'getOrderProduct2'])->name('getOrderProduct2');
    Route::get('/landing-product-entry', [LandingPageController::class, 'landingProductEntry'])->name('landingProductEntry');
    Route::get('/order-product-entry', [LandingPageController::class, 'orderProductEntry'])->name('orderProductEntry');
    Route::get('/order-product-entry', [LandingPageController::class, 'orderProductEntry'])->name('orderProductEntry');
    Route::get('/file-upload', [LandingPageController::class, 'fileUpload'])->name('ckeditor.upload');
    Route::post('/landing-page-store', [LandingPageController::class, 'store'])->name('landing_pages.store');
    Route::get('landing-page/{id}', [LandingPageController::class,'landing_page'])->name('landing_index');
    Route::get('landing-page-edit/{id}', [LandingPageController::class,'landing_page_edit'])->name('landing_edit');
    Route::get('landing-page-delete/{id}', [LandingPageController::class,'destroy'])->name('landing_pages.destroy');
    Route::post('/order-status/update/{id}', [LandingPageController::class,'update'])->name('landing_pages.update');
    // Route::post('/order-status/update/{id}','orderStatusUPdate')->name('orderStatusUPdate');


    Route::resource('product-category', ProductCategoryController::class);
    Route::put('product-category-status/{id}', [ProductCategoryController::class,'changeStatus'])->name('product.category.status');

    Route::resource('product-sub-category', ProductSubCategoryController::class);
    Route::put('product-sub-category-status/{id}', [ProductSubCategoryController::class,'changeStatus'])->name('product.sub.category.status');
    Route::get('export-product-sub-category',[ProductSubCategoryController::class,'exportSubCategory'])->name('product-sub-category.export');
    Route::post('import-product-sub-category',[ProductSubCategoryController::class,'importSubCategory'])->name('product-sub-category.import');

    Route::resource('product-child-category', ProductChildCategoryController::class);
    Route::put('product-child-category-status/{id}', [ProductChildCategoryController::class,'changeStatus'])->name('product.child.category.status');
    Route::get('subcategory-by-category/{id}', [ProductChildCategoryController::class,'getSubcategoryByCategory'])->name('subcategory-by-category');
    Route::get('childcategory-by-subcategory/{id}', [ProductChildCategoryController::class,'getChildcategoryBySubCategory'])->name('childcategory-by-subcategory');
    Route::post('import-product-child-category',[ProductChildCategoryController::class,'importchildCategory'])->name('product-child-category.import');
    
    Route::post('import-all-product',[ProductController::class,'ImportProduct'])->name('products.import');
    Route::get('/all-product-delete', [ProductController::class, 'deleteAllProduct'])->name('deleteAllProduct');
    
    Route::resource('product-brand', ProductBrandController::class);
    Route::put('product-brand-status/{id}', [ProductBrandController::class,'changeStatus'])->name('product.brand.status');

    Route::resource('specification-key', SpecificationKeyController::class);
    Route::put('specification-key-status/{id}', [SpecificationKeyController::class,'changeStatus'])->name('specification-key.status');

    Route::resource('testimonial', TestimonialController::class);
    Route::put('testimonial-status/{id}', [TestimonialController::class,'changeStatus'])->name('testimonial.status');

    Route::resource('product', ProductController::class);
    Route::get('product-landing-page', [ProductController::class,'landingPageIndex'])->name('product-landing.index');
    Route::get('create-product-info', [ProductController::class,'create'])->name('create-product-info');
    Route::put('product-status/{id}', [ProductController::class,'changeStatus'])->name('product.status');
    Route::put('product-status-change/{id}', [ProductController::class,'change_Status'])->name('product.status.change');
    Route::put('best-product-status/{id}', [ProductController::class,'best_status'])->name('product.best.change');
    Route::put('product-approved/{id}', [ProductController::class,'productApproved'])->name('product-approved');
    Route::put('removed-product-exist-specification/{id}', [ProductController::class,'removedProductExistSpecification'])->name('removed-product-exist-specification');
    Route::get('seller-product', [ProductController::class,'sellerProduct'])->name('seller-product');
    Route::get('seller-pending-product', [ProductController::class,'sellerPendingProduct'])->name('seller-pending-product');
    Route::get('stockout-product', [ProductController::class,'stockoutProduct'])->name('stockout-product');
    Route::get('/free-shipping-product',[ProductController::class,'free_shipping'])->name('free_shipping');
    Route::get('/create-free-shipping-product',[ProductController::class,'create_free_shipping'])->name('create_free_shipping');
    Route::post('/store-free-shipping',[ProductController::class,'store_free_shipping'])->name('store-free-shipping');
    Route::get('/destroy-free-shipping',[ProductController::class,'fshippingdestroy'])->name('free-shipping.fshippingdestroy');
    Route::get('/get-discount-product',[ProductController::class,'getDiscountProduct'])->name('getDiscountProduct');
    Route::get('/product-entry',[ProductController::class,'productEntry'])->name('productEntry');
    Route::get('/free-shipping-product-entry',[ProductController::class,'productEntry2'])->name('productEntry2');
    Route::get('/cat-wise-product',[ProductController::class,'cat_wise_product'])->name('cat_wise_product');

    Route::get('/get-variant-price', [ProductController::class,'get_variant_price'])->name('get_variant_price');

    Route::get('product-variant/{id}', [ProductVariantController::class,'index'])->name('product-variant');
    Route::get('create-product-variant/{id}', [ProductVariantController::class,'create'])->name('create-product-variant');
    Route::post('store-product-variant', [ProductVariantController::class,'store'])->name('store-product-variant');
    Route::get('get-product-variant/{id}', [ProductVariantController::class,'show'])->name('get-product-variant');
    Route::put('update-product-variant/{id}', [ProductVariantController::class,'update'])->name('update-product-variant');
    Route::delete('delete-product-variant/{id}', [ProductVariantController::class,'destroy'])->name('delete-product-variant');
    Route::put('product-variant-status/{id}', [ProductVariantController::class,'changeStatus'])->name('product-variant.status');

    Route::get('product-variant-item', [ProductVariantItemController::class,'index'])->name('product-variant-item');
    Route::get('create-product-variant-item/{id}', [ProductVariantItemController::class,'create'])->name('create-product-variant-item');
    Route::post('store-product-variant-item', [ProductVariantItemController::class,'store'])->name('store-product-variant-item');
    Route::get('edit-product-variant-item/{id}', [ProductVariantItemController::class,'edit'])->name('edit-product-variant-item');
    Route::get('get-product-variant-item/{id}', [ProductVariantItemController::class,'show'])->name('egetdit-product-variant-item');
    Route::put('update-product-variant-item/{id}', [ProductVariantItemController::class,'update'])->name('update-product-variant-item');
    Route::delete('delete-product-variant-item/{id}', [ProductVariantItemController::class,'destroy'])->name('delete-product-variant-item');
    Route::put('product-variant-item-status/{id}', [ProductVariantItemController::class,'changeStatus'])->name('product-variant-item.status');





    Route::get('product-gallery/{id}', [ProductGalleryController::class,'index'])->name('product-gallery');
    Route::post('store-product-gallery', [ProductGalleryController::class,'store'])->name('store-product-gallery');
    Route::delete('delete-product-image/{id}', [ProductGalleryController::class,'destroy'])->name('delete-product-image');
    Route::put('product-gallery-status/{id}', [ProductGalleryController::class,'changeStatus'])->name('product-gallery.status');

    Route::resource('service', ServiceController::class);
    Route::put('service-status/{id}', [ServiceController::class,'changeStatus'])->name('service.status');

    Route::resource('about-us', AboutUsController::class);

    Route::resource('contact-us', ContactPageController::class);

    Route::resource('custom-page', CustomPageController::class);

    Route::put('custom-page-status/{id}', [CustomPageController::class,'changeStatus'])->name('custom-page.status');

    Route::resource('terms-and-condition', TermsAndConditionController::class);

    Route::resource('privacy-policy', PrivacyPolicyController::class);

    Route::resource('blog-category', BlogCategoryController::class);
    Route::put('blog-category-status/{id}', [BlogCategoryController::class,'changeStatus'])->name('blog.category.status');

    Route::resource('blog', BlogController::class);
    Route::put('blog-status/{id}', [BlogController::class,'changeStatus'])->name('blog.status');

    Route::resource('popular-blog', PopularBlogController::class);
    Route::put('popular-blog-status/{id}', [PopularBlogController::class,'changeStatus'])->name('popular-blog.status');

    Route::resource('blog-comment', BlogCommentController::class);
    Route::put('blog-comment-status/{id}', [BlogCommentController::class,'changeStatus'])->name('blog-comment.status');

    Route::get('clear-database',[SettingController::class,'showClearDatabasePage'])->name('clear-database');
    Route::delete('clear-database',[SettingController::class,'clearDatabase'])->name('clear-database');

    Route::put('update-database',[SettingController::class,'update_database'])->name('update-database');



    Route::get('subscriber',[SubscriberController::class,'index'])->name('subscriber');
    Route::delete('delete-subscriber/{id}',[SubscriberController::class,'destroy'])->name('delete-subscriber');
    Route::post('specification-subscriber-email/{id}',[SubscriberController::class,'specificationSubscriberEmail'])->name('specification-subscriber-email');
    Route::post('each-subscriber-email',[SubscriberController::class,'eachSubscriberEmail'])->name('each-subscriber-email');

    Route::get('contact-message',[ContactMessageController::class,'index'])->name('contact-message');
    Route::get('show-contact-message/{id}',[ContactMessageController::class,'show'])->name('show-contact-message');
    Route::delete('delete-contact-message/{id}',[ContactMessageController::class,'destroy'])->name('delete-contact-message');
    Route::put('enable-save-contact-message',[ContactMessageController::class,'handleSaveContactMessage'])->name('enable-save-contact-message');

    Route::get('email-configuration',[EmailConfigurationController::class,'index'])->name('email-configuration');
    Route::put('update-email-configuraion',[EmailConfigurationController::class,'update'])->name('update-email-configuraion');

    Route::get('email-template',[EmailTemplateController::class,'index'])->name('email-template');
    Route::get('edit-email-template/{id}',[EmailTemplateController::class,'edit'])->name('edit-email-template');
    Route::put('update-email-template/{id}',[EmailTemplateController::class,'update'])->name('update-email-template');

    Route::get('general-setting',[SettingController::class,'index'])->name('general-setting');
    Route::put('update-general-setting',[SettingController::class,'updateGeneralSetting'])->name('update-general-setting');

    /* Courier Related Route */
    Route::get('courier-setting',[SettingController::class,'courier_index'])->name('courier-setting');
    Route::put('update-courier-setting',[SettingController::class,'updateCourierSetting'])->name('update-courier-setting');
    Route::put('update-courier-setting',[SettingController::class,'updateCourierSetting'])->name('update-courier-setting');
    Route::get('create-access-token',[SettingController::class, 'viewAccessToken'])->name('create-access-token');
    // Route::post('generate-access-token',[SettingController::class, 'generateAccessToken'])->name('generate-access-token');

    Route::put('update-theme-color',[SettingController::class,'updateThemeColor'])->name('update-theme-color');
    Route::put('update-logo-favicon',[SettingController::class,'updateLogoFavicon'])->name('update-logo-favicon');
    Route::put('update-cookie-consent',[SettingController::class,'updateCookieConset'])->name('update-cookie-consent');
    Route::put('update-google-recaptcha',[SettingController::class,'updateGoogleRecaptcha'])->name('update-google-recaptcha');
    Route::put('update-facebook-comment',[SettingController::class,'updateFacebookComment'])->name('update-facebook-comment');
    Route::put('update-tawk-chat',[SettingController::class,'updateTawkChat'])->name('update-tawk-chat');

    Route::put('update-custom-pagination',[SettingController::class,'updateCustomPagination'])->name('update-custom-pagination');
    Route::put('update-social-login',[SettingController::class,'updateSocialLogin'])->name('update-social-login');

    Route::put('update-pusher',[SettingController::class,'updatePusher'])->name('update-pusher');

    Route::resource('admin', AdminController::class);
    Route::put('admin-status/{id}', [AdminController::class,'changeStatus'])->name('admin-status');

    Route::resource('faq', FaqController::class);
    Route::put('faq-status/{id}', [FaqController::class,'changeStatus'])->name('faq-status');

    Route::get('product-review',[ProductReviewController::class,'index'])->name('product-review');
    Route::put('product-review-status/{id}',[ProductReviewController::class,'changeStatus'])->name('product-review-status');
    Route::get('show-product-review/{id}',[ProductReviewController::class,'show'])->name('show-product-review');
    Route::delete('delete-product-review/{id}',[ProductReviewController::class,'destroy'])->name('delete-product-review');

    Route::get('product-report',[ProductReportController::class, 'index'])->name('product-report');
    Route::get('show-product-report/{id}',[ProductReportController::class, 'show'])->name('show-product-report');
    Route::delete('delete-product-report/{id}',[ProductReportController::class, 'destroy'])->name('delete-product-report');
    Route::put('de-active-product/{id}',[ProductReportController::class, 'deactiveProduct'])->name('de-active-product');

    Route::get('customer-list',[CustomerController::class,'index'])->name('customer-list');
    Route::get('customer-show/{id}',[CustomerController::class,'show'])->name('customer-show');
    Route::put('customer-status/{id}',[CustomerController::class,'changeStatus'])->name('customer-status');
    Route::delete('customer-delete/{id}',[CustomerController::class,'destroy'])->name('customer-delete');
    Route::get('pending-customer-list',[CustomerController::class,'pendingCustomerList'])->name('pending-customer-list');
    Route::get('send-email-to-all-customer',[CustomerController::class,'sendEmailToAllUser'])->name('send-email-to-all-customer');
    Route::post('send-mail-to-all-user',[CustomerController::class,'sendMailToAllUser'])->name('send-mail-to-all-user');
    Route::post('send-mail-to-single-user/{id}',[CustomerController::class,'sendMailToSingleUser'])->name('send-mail-to-single-user');

    Route::get('seller-list',[SellerController::class,'index'])->name('seller-list');
    Route::get('seller-show/{id}',[SellerController::class,'show'])->name('seller-show');
    Route::put('seller-status/{id}',[SellerController::class,'changeStatus'])->name('seller-status');
    Route::delete('seller-delete/{id}',[SellerController::class,'destroy'])->name('seller-delete');
    Route::get('pending-seller-list',[SellerController::class,'pendingSellerList'])->name('pending-seller-list');
    Route::put('seller-update/{id}',[SellerController::class,'updateSeller'])->name('seller-update');
    Route::get('seller-shop-detail/{id}',[SellerController::class,'sellerShopDetail'])->name('seller-shop-detail');
    Route::put('remove-seller-social-link/{id}',[SellerController::class,'removeSellerSocialLink'])->name('remove-seller-social-link');

    Route::put('update-seller-shop/{id}',[SellerController::class,'updateSellerSop'])->name('update-seller-shop');
    Route::get('seller-reviews/{id}',[SellerController::class,'sellerReview'])->name('seller-reviews');
    Route::get('show-seller-review-details/{id}',[SellerController::class,'showSellerReviewDetails'])->name('show-seller-review-details');
    Route::get('send-email-to-seller/{id}',[SellerController::class,'sendEmailToSeller'])->name('send-email-to-seller');
    Route::post('send-mail-to-single-seller/{id}',[SellerController::class,'sendMailtoSingleSeller'])->name('send-mail-to-single-seller');
    Route::get('email-history/{id}',[SellerController::class,'emailHistory'])->name('email-history');
    Route::get('product-by-seller/{id}',[SellerController::class,'productBySaller'])->name('product-by-seller');
    Route::get('send-email-to-all-seller',[SellerController::class,'sendEmailToAllSeller'])->name('send-email-to-all-seller');
    Route::post('send-mail-to-all-seller',[SellerController::class,'sendMailToAllSeller'])->name('send-mail-to-all-seller');
    Route::get('withdraw-list/{id}',[SellerController::class,'sellerWithdrawList'])->name('withdraw-list');

    Route::get('state-by-country/{id}',[SellerController::class,'stateByCountry'])->name('state-by-country');
    Route::get('city-by-state/{id}',[SellerController::class,'cityByState'])->name('city-by-state');

    Route::resource('error-page', ErrorPageController::class);

    Route::get('maintainance-mode',[ContentController::class,'maintainanceMode'])->name('maintainance-mode');
    Route::put('maintainance-mode-update',[ContentController::class,'maintainanceModeUpdate'])->name('maintainance-mode-update');
    Route::get('announcement',[ContentController::class,'announcementModal'])->name('announcement');
    Route::post('announcement-update',[ContentController::class,'announcementModalUpdate'])->name('announcement-update');

    Route::get('topbar-contact', [ContentController::class, 'headerPhoneNumber'])->name('topbar-contact');
    Route::put('update-topbar-contact', [ContentController::class, 'updateHeaderPhoneNumber'])->name('update-topbar-contact');

    Route::get('product-quantity-progressbar', [ContentController::class, 'productProgressbar'])->name('product-quantity-progressbar');
    Route::put('update-product-quantity-progressbar', [ContentController::class, 'updateProductProgressbar'])->name('update-product-quantity-progressbar');

    Route::get('default-avatar', [ContentController::class, 'defaultAvatar'])->name('default-avatar');
    Route::post('update-default-avatar', [ContentController::class, 'updateDefaultAvatar'])->name('update-default-avatar');

    Route::get('seller-conditions', [ContentController::class, 'sellerCondition'])->name('seller-conditions');
    Route::put('update-seller-conditions', [ContentController::class, 'updatesellerCondition'])->name('update-seller-conditions');

    Route::get('subscription-banner', [ContentController::class, 'subscriptionBanner'])->name('subscription-banner');
    Route::post('update-subscription-banner', [ContentController::class, 'updatesubscriptionBanner'])->name('update-subscription-banner');

    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');
    Route::put('update-flash-sale', [FlashSaleController::class, 'update'])->name('update-flash-sale');
    Route::get('flash-sale-product', [FlashSaleController::class, 'flash_sale_product'])->name('flash-sale-product');
    Route::post('store-flash-sale-product', [FlashSaleController::class, 'store'])->name('store-flash-sale-product');
    Route::put('flash-sale-product-status/{id}', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-product-status');
    Route::delete('delete-flash-sale-product/{id}', [FlashSaleController::class,'destroy'])->name('delete-flash-sale-product');

    Route::get('advertisement',[AdvertisementController::class, 'index'])->name('advertisement');
    Route::post('mega-menu-banner-update', [AdvertisementController::class, 'megaMenuBannerUpdate'])->name('mega-menu-banner-update');
    Route::post('slider-banner-one', [AdvertisementController::class, 'updateSliderBannerOne'])->name('slider-banner-one');
    Route::post('slider-banner-two', [AdvertisementController::class, 'updateSliderBannerTwo'])->name('slider-banner-two');
    Route::post('slider-banner-third', [AdvertisementController::class, 'updateSliderBannerThird'])->name('slider-banner-third');
    Route::post('popular-category-sidebar', [AdvertisementController::class, 'updatePopularCategorySidebar'])->name('popular-category-sidebar');
    Route::post('homepage-two-col-first-banner', [AdvertisementController::class, 'homepageTwoColFirstBanner'])->name('homepage-two-col-first-banner');
    Route::post('homepage-two-col-second-banner', [AdvertisementController::class, 'homepageTwoColSecondBanner'])->name('homepage-two-col-second-banner');
    Route::post('homepage-single-first-banner', [AdvertisementController::class, 'homepageSinleFirstBanner'])->name('homepage-single-first-banner');
    Route::post('homepage-single-second-banner', [AdvertisementController::class, 'homepageSinleSecondBanner'])->name('homepage-single-second-banner');
    Route::post('homepage-flash-sale-sidebar-banner', [AdvertisementController::class, 'homepageFlashSaleSidebarBanner'])->name('homepage-flash-sale-sidebar-banner');
    Route::post('shop-page-center-banner', [AdvertisementController::class, 'shopPageCenterBanner'])->name('shop-page-center-banner');
    Route::post('shop-page-sidebar-banner', [AdvertisementController::class, 'shopPageSidebarBanner'])->name('shop-page-sidebar-banner');

    Route::get('login-page', [ContentController::class, 'loginPage'])->name('login-page');
    Route::post('update-login-page', [ContentController::class, 'updateloginPage'])->name('update-login-page');
    Route::get('image-content', [ContentController::class, 'image_content'])->name('image-content');
    Route::post('update-image-content', [ContentController::class, 'updateImageContent'])->name('update-image-content');
    Route::get('shop-page',[ContentController::Class, 'shopPage'])->name('shop-page');
    Route::put('update-filter-price',[ContentController::Class, 'updateFilterPrice'])->name('update-filter-price');

    Route::get('seo-setup',[ContentController::Class, 'seoSetup'])->name('seo-setup');
    Route::put('update-seo-setup/{id}',[ContentController::Class, 'updateSeoSetup'])->name('update-seo-setup');
    Route::get('get-seo-setup/{id}',[ContentController::Class, 'getSeoSetup'])->name('get-seo-setup');

    Route::resource('country', CountryController::class);
    Route::put('country-status/{id}',[CountryController::class,'changeStatus'])->name('country-status');

    Route::resource('state', CountryStateController::class);
    Route::put('state-status/{id}',[CountryStateController::class,'changeStatus'])->name('state-status');

    Route::resource('city', CityController::class);
    Route::put('city-status/{id}',[CityController::class,'changeStatus'])->name('city-status');

    Route::get('payment-method',[PaymentMethodController::class,'index'])->name('payment-method');
    Route::put('update-paypal',[PaymentMethodController::class,'updatePaypal'])->name('update-paypal');
    Route::put('update-stripe',[PaymentMethodController::class,'updateStripe'])->name('update-stripe');
    Route::put('update-razorpay',[PaymentMethodController::class,'updateRazorpay'])->name('update-razorpay');
    Route::put('update-bank',[PaymentMethodController::class,'updateBank'])->name('update-bank');
    Route::put('update-mollie',[PaymentMethodController::class,'updateMollie'])->name('update-mollie');
    Route::put('update-paystack',[PaymentMethodController::class,'updatePayStack'])->name('update-paystack');
    Route::put('update-flutterwave',[PaymentMethodController::class,'updateflutterwave'])->name('update-flutterwave');
    Route::put('update-instamojo',[PaymentMethodController::class,'updateInstamojo'])->name('update-instamojo');
    Route::put('update-cash-on-delivery',[PaymentMethodController::class,'updateCashOnDelivery'])->name('update-cash-on-delivery');
    Route::put('update-sslcommerz',[PaymentMethodController::class,'updateSslcommerz'])->name('update-sslcommerz');

    Route::resource('mega-menu-category', MegaMenuController::class);
    Route::put('mega-menu-category-status/{id}',[MegaMenuController::class,'changeStatus'])->name('mega-menu-category-status');

    Route::get('mega-menu-sub-category/{id}', [MegaMenuSubCategoryController::class, 'index'])->name('mega-menu-sub-category');
    Route::get('create-mega-menu-sub-category/{id}', [MegaMenuSubCategoryController::class, 'create'])->name('create-mega-menu-sub-category');
    Route::get('get-mega-menu-sub-category/{id}', [MegaMenuSubCategoryController::class, 'show'])->name('get-mega-menu-sub-category');
    Route::post('store-mega-menu-sub-category/{id}', [MegaMenuSubCategoryController::class, 'store'])->name('store-mega-menu-sub-category');
    Route::get('edit-mega-menu-sub-category/{id}', [MegaMenuSubCategoryController::class, 'edit'])->name('edit-mega-menu-sub-category');
    Route::put('update-mega-menu-sub-category/{id}', [MegaMenuSubCategoryController::class, 'update'])->name('update-mega-menu-sub-category');
    Route::delete('delete-mega-menu-sub-category/{id}', [MegaMenuSubCategoryController::class, 'destroy'])->name('delete-mega-menu-sub-category');
    Route::put('mega-menu-sub-category-status/{id}',[MegaMenuSubCategoryController::class,'changeStatus'])->name('mega-menu-sub-category-status');

    Route::resource('slider', SliderController::class);
    Route::put('slider-status/{id}',[SliderController::class,'changeStatus'])->name('slider-status');

    Route::get('pc_builders', [HomePageController::class, 'pcBuilders'])->name('pc-builder');
    Route::get('popular-category', [HomePageController::class, 'popularCategory'])->name('popular-category');
    Route::post('store-popular-category', [HomePageController::class, 'storePopularCategory'])->name('store-popular-category');
    Route::post('store-pc-build', [HomePageController::class, 'storePcBuild'])->name('store-build-pc');
    Route::delete('destroy-popular-category/{id}', [HomePageController::class, 'destroyPopularCategory'])->name('destroy-popular-category');
    Route::delete('destroy-pc-build/{id}', [HomePageController::class, 'destroyPcBuilder'])->name('destroy-pc-builder');

    Route::delete('destroy-color/{id}', [HomePageController::class, 'destroyColor'])->name('destroy-color');



    Route::put('popular-category-banner', [HomePageController::class, 'bannerPopularCategory'])->name('popular-category-banner');
    Route::put('featured-category-banner', [HomePageController::class, 'bannerFeaturedCategory'])->name('featured-category-banner');

    Route::get('featured-category', [HomePageController::class, 'featuredCategory'])->name('featured-category');
    Route::post('store-featured-category', [HomePageController::class, 'storeFeaturedCategory'])->name('store-featured-category');
    Route::delete('destroy-featured-category/{id}', [HomePageController::class, 'destroyFeaturedCategory'])->name('destroy-featured-category');

    Route::get('homepage-section-title', [HomePageController::class, 'homepage_section_content'])->name('homepage-section-title');
    Route::post('update-homepage-section-title', [HomePageController::class, 'update_homepage_section_content'])->name('update-homepage-section-title');

    Route::get('homepage-visibility', [HomepageVisibilityController::class, 'index'])->name('homepage-visibility');
    Route::put('update-homepage-visibility', [HomepageVisibilityController::class, 'update'])->name('update-homepage-visibility');

    Route::get('menu-visibility', [MenuVisibilityController::class, 'index'])->name('menu-visibility');
    Route::put('update-menu-visibility/{id}', [MenuVisibilityController::class, 'update'])->name('update-menu-visibility');

    Route::resource('shipping', ShippingMethodController::class);
    Route::get('city-wise-shipping/{city_id}', [ShippingMethodController::class , 'cityWiseShipping'])->name('city-wise-shipping');

    Route::resource('withdraw-method', WithdrawMethodController::class);
    Route::put('withdraw-method-status/{id}',[WithdrawMethodController::class,'changeStatus'])->name('withdraw-method-status');

    Route::get('seller-withdraw', [SellerWithdrawController::class, 'index'])->name('seller-withdraw');
    Route::get('pending-seller-withdraw', [SellerWithdrawController::class, 'pendingSellerWithdraw'])->name('pending-seller-withdraw');

    Route::get('show-seller-withdraw/{id}', [SellerWithdrawController::class, 'show'])->name('show-seller-withdraw');
    Route::delete('delete-seller-withdraw/{id}', [SellerWithdrawController::class, 'destroy'])->name('delete-seller-withdraw');
    Route::put('approved-seller-withdraw/{id}', [SellerWithdrawController::class, 'approvedWithdraw'])->name('approved-seller-withdraw');



    // Route::get('/assign-user-store','')->name('assignUserStore');
    // Route::post('/order-status/update/{id}','orderStatusUPdate')->name('orderStatusUPdate');
    // Route::get('/order-status/{id}','orderStatus')->name('orderStatus');

    // Route::get('/order-list','orderList')->name('orderList');
    // Route::get('/all-order-delete','deleteAllOrder')->name('deleteAllOrder');
    Route::get('/all-order-delete', [OrderController::class, 'deleteAllOrder'])->name('deleteAllOrder');
     Route::get('/order-print', [OrderController::class, 'orderPrint'])->name('orderPrint');
    Route::get('/order-list', [OrderController::class, 'orderList'])->name('orderList');
    Route::post('/order-status/update', [OrderController::class, 'multuOrderStatusUpdate'])->name('multuOrderStatusUpdate');
    Route::get('order-status/{id}', [OrderController::class, 'orderStatus'])->name('orderStatus');
    Route::get('assign-user-store', [OrderController::class, 'assignUserStore'])->name('assignUserStore');
    Route::get('all-order', [OrderController::class, 'index'])->name('all-order');
    Route::post('/orders/{orderId}/return-credit', [OrderController::class, 'handleReturn'])->name('orders.return-credit');

    Route::get('/status-wise-order',[OrderController::class,'status_wise_order'])->name('status_wise_order');

    Route::get('pending-order', [OrderController::class, 'pendingOrder'])->name('pending-order');
    Route::get('process-order', [OrderController::class, 'processOrder'])->name('process-order');
    Route::get('courier-order', [OrderController::class, 'courierOrder'])->name('courier-order');
    Route::get('onhold-order', [OrderController::class, 'onholdOrder'])->name('onhold-order');
    Route::get('completed-order', [OrderController::class, 'completedOrder'])->name('completed-order');
    Route::get('cancell-order', [OrderController::class, 'cancellOrder'])->name('cancell-order');
    Route::get('return-order', [OrderController::class, 'returnOrder'])->name('return-order');
    Route::get('cash-on-delivery', [OrderController::class, 'cashOnDelivery'])->name('cash-on-delivery');
    Route::get('order-show/{id}', [OrderController::class, 'show'])->name('order-show');

  	Route::get('/get-add-new-order-product', [OrderController::class, 'getOrderNewProduct'])->name('addNewOrderProduct');
  	Route::get('/add-New-Product-Entry', [OrderController::class, 'addNewProductEntry'])->name('addNewProductEntry');
    Route::get('Add-New-Order', [OrderController::class, 'add_new_order'])->name('addNewOrder');
	Route::post('/add-New-Order-Store', [OrderController::class, 'addNewOrderStore'])->name('addNewOrderStore');


    Route::get('order-edit/{id}', [OrderController::class, 'edit'])->name('order-edit');
    Route::post('order-update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('delete-order/{id}', [OrderController::class, 'destroy'])->name('delete-order');
    Route::put('update-order-status/{id}', [OrderController::class, 'updateOrderStatus'])->name('update-order-status');

    //Redx Courier Service
    Route::get('/create-redx-parcel', [OrderController::class, 'OrderSendToRedx'])->name('createRedxParcel');

    //Pathao Courier Service
    Route::get('/zones-by-city/{city}', [OrderController::class, 'getPathaoZoneListByCity'])->name('zonesByCity');
    Route::get('/areas-by-zone/{zone}', [OrderController::class, 'getPathaoAreaListByZone'])->name('areasByZone');
    Route::get('/create-pathao-parcel', [OrderController::class, 'OrderSendToPathao'])->name('createPathaoParcel');

    //Steadfast Courier Service
    Route::get('/create-steadfast-parcel', [OrderController::class, 'OrderSendToSteadfast'])->name('createSteadfastParcel');

    //generate pathao access token
    Route::get('generate-access-token', [OrderController::class, 'viewAccessToken']);
    Route::post('generate-access-token', [OrderController::class, 'generatePathaoAccessToken'])->name('generate-access-token');

    Route::resource('coupon', CouponController::class);

    Route::put('coupon-status/{id}',[CouponController::class,'changeStatus'])->name('coupon-status');

    Route::resource('banner-image', BreadcrumbController::class);

    Route::resource('footer', FooterController::class);

    Route::resource('social-link', FooterSocialLinkController::class);

    Route::resource('footer-link', FooterLinkController::class);
    Route::get('second-col-footer-link', [FooterLinkController::class, 'secondColFooterLink'])->name('second-col-footer-link');
    Route::get('third-col-footer-link', [FooterLinkController::class, 'thirdColFooterLink'])->name('third-col-footer-link');
    Route::put('update-col-title/{id}', [FooterLinkController::class, 'updateColTitle'])->name('update-col-title');

    Route::get('admin-language', [LanguageController::class, 'adminLnagugae'])->name('admin-language');
    Route::post('update-admin-language', [LanguageController::class, 'updateAdminLanguage'])->name('update-admin-language');

    Route::get('admin-validation-language', [LanguageController::class, 'adminValidationLnagugae'])->name('admin-validation-language');
    Route::post('update-admin-validation-language', [LanguageController::class, 'updateAdminValidationLnagugae'])->name('update-admin-validation-language');

    Route::get('website-language', [LanguageController::class, 'websiteLanguage'])->name('website-language');
    Route::post('update-language', [LanguageController::class, 'updateLanguage'])->name('update-language');

    Route::get('website-validation-language', [LanguageController::class, 'websiteValidationLanguage'])->name('website-validation-language');
    Route::post('update-validation-language', [LanguageController::class, 'updateValidationLanguage'])->name('update-validation-language');

    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::get('stock-history/{id}', [InventoryController::class, 'show_inventory'])->name('stock-history');
    Route::post('add-stock', [InventoryController::class, 'add_stock'])->name('add-stock');
    Route::delete('delete-stock/{id}', [InventoryController::class, 'delete_stock'])->name('delete-stock');

    Route::get('sms-notification', [NotificationController::class, 'twilio_sms'])->name('sms-notification');
    Route::put('update-twilio-configuration', [NotificationController::class, 'update_twilio_sms'])->name('update-twilio-configuration');
    Route::put('update-biztech-configuration', [NotificationController::class, 'update_biztech_sms'])->name('update-biztech-configuration');

    Route::get('sms-template', [NotificationController::class, 'sms_template'])->name('sms-template');
    Route::get('edit-sms-template/{id}', [NotificationController::class, 'edit_sms_template'])->name('edit-sms-template');
    Route::put('update-sms-template/{id}', [NotificationController::class, 'update_sms_template'])->name('update-sms-template');

});

});



Auth::routes();

Route::group(['as' => 'front.'], function(){
    Route::controller(FrontHomeController::class)->group(function(){
        Route::get('/', 'index')->name('home');
        Route::get('/category/{type}/{slug}', 'subCategoriesByCategory')->name('subcategory');
        Route::get('/shop/{slug?}', 'shop')->name('shop');
        Route::get('/flash-selling-product', 'flashSellProducts')->name('flash-sell');
        Route::get('/most-selling-product', 'mostSellingProducts')->name('popular');
        Route::get('/pages/{slug}', 'customPages')->name('customPages');
        Route::get('all-category', 'all_category')->name('allCategory');
    });

    Route::controller(FrontProductController::class)->group(function(){
        Route::group(['as'=> 'product.'], function(){
            Route::get('/search-product', 'searchProduct')->name('search');
            Route::get('/brand-product/{slug}', 'brandWiseProduct')->name('brand-product');
            Route::get('/product/{id}', 'show')->name('show');
            Route::get('get-variation_price', 'get_variation_price')->name('get-variation_price');
          Route::get('get-variation_color', 'get_color_price')->name('get-variation_color');

            Route::post('/product/reviews', 'reviews')->name('product-reviews.store');
            // routes/web.php
            Route::post('/compare-products', 'compare')->name('compare.products');

            Route::get('/single-product/{slug}','single_product')->name('single_product');

        });
    });

    Route::controller(FrontCartController::class)->group(function(){
        Route::group(['as'=> 'cart.'], function(){
            Route::get('pc-builder', 'pc_builder')->name('pc.builders');
            Route::get('choose-pc-builder-product/{id}', 'view_pc_builder')->name('pc.builder');
            Route::get('cart', 'index')->name('index');
            Route::post('cart', 'store')->name('store');
            Route::post('pcBuild-cart', 'pcBuildstore')->name('pc.builder.store');
            Route::post('pc-Build-Store', 'pcBuild_store')->name('pcBuildStore');
            Route::get('cart-qty-increase/{id}', 'increaseQty')->name('increase');
            Route::get('cart-qty-decrease/{id}', 'decreaseQty')->name('decrease');
            Route::get('cart/{id}', 'destroy')->name('destroy');
            Route::post('/cart/update/{id}', 'update')->name('update');

            Route::post('apply-coupon', 'applyCoupon')->name('apply-coupon');

        });

    });


    // Route::controller(FrontCheckoutController::class)->group(function(){
    //     Route::group(['as'=> 'checkout.'], function(){
    //         Route::get('checkout', 'index')->name('index');
    //     });
    // });


    Route::resource('checkout', FrontCheckoutController::class);
    Route::get('/checkout/{product_id}', 'FrontCheckoutController@checkoutsing')->name('check.single');
    Route::post('/store/landing/data',[FrontCheckoutController::class,'storelandData'])->name('storelandData');



    Route::resource('order', FrontOrderController::class);
    Route::get('/orders/{order}/payment', [FrontOrderController::class, 'showPaymentPage'])->name('orders.payment');
    Route::post('/orders/{order}/payment', [FrontOrderController::class, 'processPayment'])->name('orders.processPayment');

    Route::get('order-list/{phone}', [FrontOrderController::class, 'order_list'])->name('order-list');
	Route::get('order-thanks/{order_id}', [FrontOrderController::class, 'thanks_page'])->name('order-thanks-page');
    Route::get('order-print/{id}', [FrontOrderController::class, 'print'])->name('order.print');
    Route::get('order-return/{id}', [FrontOrderController::class, 'return_req'])->name('order.return');
    Route::get('order-internal-credit', [FrontOrderController::class, 'internal_credit'])->name('order.internal-credit');
    Route::get('order-balance-sheet', [FrontOrderController::class, 'order_balance_sheet'])->name('order.balance-sheet');

    Route::controller(FrontAuthController::class)->group(function(){
        Route::get('register-user', 'regpage')->name('user-reg');
        Route::get('login-user', 'logpage')->name('user-log');
        Route::post('login', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
        Route::post('register', 'register')->name('register');
        Route::post('optverify', 'optverify')->name('optverify');
        Route::post('change-password', 'changePassword')->name('pasword.change');
        Route::get('profile-user', 'user_profile')->name('user.profile');
        Route::get('edituser-profile', 'editUser_profile')->name('user.edit_profile');
        Route::post('profile-update', 'updateProfile')->name('profile.update');
    });

Route::prefix('front')->group(function(){
    Route::get('state-by-country/{id}', [FrontCheckoutController::class, 'stateByCountry'])->name('state-by-country');
    Route::get('city-by-state/{id}', [FrontCheckoutController::class, 'cityByState'])->name('city-by-state');
});

});

Route::controller(stripePaymentController::class)->group(function(){
    Route::get('stripe/{order_id}', 'stripe')->name('stripe.index');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});














