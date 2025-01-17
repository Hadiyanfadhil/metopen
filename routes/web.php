<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CashOnDeliveryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishListController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\TownshipController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentInfoController;
use App\Http\Controllers\Admin\PaymentTransitionController;
use App\Http\Controllers\FrontEnd\ProfileController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\StateDivisionController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\StockHistoryController;
use App\Models\CompanySetting;
use App\Http\Controllers\RajaOngkirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#dashboard');
            }else if(Auth::user()->role == 'user'){
                return redirect()->route('frontend#index');
            }
        }
    })->name('dashboard');
});

Route::group(['namespace' => 'Admin','prefix' => 'admin','middleware'=> [AdminCheckMiddleware::class]],function(){
    //dashboard
    Route::get('dashboard',[DashboardController::class,'index'])->name('admin#dashboard');

    // brand
    Route::get('brand',[BrandController::class,'index'])->name('admin#brand');
    Route::post('brand/create',[BrandController::class,'createBrand'])->name('admin#createBrand');
    Route::get('brand/edit/{id}',[BrandController::class,'editBrand'])->name('admin#editBrand');
    Route::post('brand/edit/{id}',[BrandController::class,'updateBrand'])->name('admin#updateBrand');
    Route::get('brand/delete/{id}',[BrandController::class,'deleteBrand'])->name('admin#deleteBrand');

    //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route::get('category/edit/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
    Route::post('category/edit/{id}',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
    Route::get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');

    //subCategory
    Route::get('subcategory',[SubCategoryController::class,'index'])->name('admin#subCategory');
    Route::post('subcategory/create',[SubCategoryController::class,'createSubCategory'])->name('admin#createSubCategory');
    Route::get('subcategory/edit/{id}',[SubCategoryController::class,'editSubCategory'])->name('admin#editSubCategory');
    Route::post('subcategory/edit/{id}',[SubCategoryController::class,'updateSubCategory'])->name('admin#updateSubCategory');
    Route::get('subcategory/delete/{id}',[SubCategoryController::class,'deleteCategory'])->name('admin#deleteSubCategory');

    //subsubCategory
    Route::get('subsubCategory',[SubSubCategoryController::class,'index'])->name('admin#subSubCat');
    Route::post('subsubCategory/subCategory',[SubSubCategoryController::class,'getSubCategory'])->name('admin#getSubCategory');
    Route::post('subsubCategory/create',[SubSubCategoryController::class,'createSubSubCat'])->name('admin#createSubSubCat');
    Route::get('subsubCategory/edit/{id}',[SubSubCategoryController::class,'editSubSubCat'])->name('admin#editSubSubCat');
    Route::post('subsubCategory/edit/{id}',[SubSubCategoryController::class,'updateSubSubCat'])->name('admin#updateSubSubCat');
    Route::get('subsubCategory/delete/{id}',[SubSubCategoryController::class,'deleteSubSubCat'])->name('admin#deleteSubSubCat');

    //color
    Route::get('product/color',[ProductColorController::class,'index'])->name('admin#color');
    Route::post('product/color/create',[ProductColorController::class,'createColor'])->name('admin#createColor');
    Route::get('product/color/edit/{id}',[ProductColorController::class,'editColor'])->name('admin#editColor');
    Route::post('product/color/update/{id}',[ProductColorController::class,'updateColor'])->name('admin#updateColor');
    Route::get('product/color/delete/{id}',[ProductColorController::class,'deleteColor'])->name('admin#deleteColor');

    //size
    Route::get('product/size',[ProductSizeController::class,'index'])->name('admin#size');
    Route::post('product/size/create',[ProductSizeController::class,'createSize'])->name('admin#createSize');
    Route::get('product/size/edit/{id}',[ProductSizeController::class,'editSize'])->name('admin#editSize');
    Route::post('product/size/update/{id}',[ProductSizeController::class,'updateSize'])->name('admin#updateSize');
    Route::get('product/size/delete/{id}',[ProductSizeController::class,'deleteSize'])->name('admin#deleteSize');

    //products
    Route::get('product',[ProductController::class,'index'])->name('admin#product');
    Route::post('product/subCategory',[ProductController::class,'getSubCategory'])->name('admin#productSubCategory');
    Route::post('product/subsubCategory',[ProductController::class,'getSubSubCategory'])->name('admin#productSubSubCategory');
    Route::get('product/create',[ProductController::class,'createProduct'])->name('admin#createProduct');
    Route::post('product/store',[ProductController::class,'storeProduct'])->name('admin#storeProduct');
    Route::get('product/edit/{id}',[ProductController::class,'editProduct'])->name('admin#editProduct');
    Route::post('product/multiImg/delete',[ProductController::class,'deleteImg'])->name('admin#deleteMultiImg');
    Route::post('product/update/{id}',[ProductController::class,'updateProduct'])->name('admin#updateProduct');
    Route::get('product/detail/{id}',[ProductController::class,'showProduct'])->name('admin#showProduct');
    Route::get('product/delete/{id}',[ProductController::class,'deleteProduct'])->name('admin#deleteProduct');

    //product stock
    Route::get('product/stock',[ProductController::class,'productStock'])->name('admin#productStock');
    Route::get('product/stock/filter',[ProductController::class,'productStockFilter'])->name('admin#productStockFilter');

    //stock history
    Route::get('product/stockHistory',[StockHistoryController::class,'index'])->name('admin#stockHistory');

    //products variant
    Route::get('product/variant',[ProductVariantController::class,'index'])->name('admin#productVariant');
    Route::get('product/variant/create/{id}',[ProductVariantController::class,'createVariant'])->name('admin#createVariant');
    Route::post('product/variant/store/',[ProductVariantController::class,'storeVariant'])->name('admin#storeVariant');
    Route::get('product/variant/delete/{id}',[ProductVariantController::class,'deleteVariant'])->name('admin#deleteVariant');
    Route::get('product/variant/edit/{id}',[ProductVariantController::class,'editVariant'])->name('admin#editVariant');
    Route::post('product/variant/update/{id}',[ProductVariantController::class,'updateVariant'])->name('admin#updateVariant');

    //coupon
    Route::get('coupon',[CouponController::class,'index'])->name('admin#coupon');
    Route::get('coupon/create',[CouponController::class,'createCoupon'])->name('admin#createCoupon');
    Route::post('coupon/store',[CouponController::class,'storeCoupon'])->name('admin#storeCoupon');
    Route::get('coupon/edit/{id}',[CouponController::class,'editCoupon'])->name('admin#editCoupon');
    Route::post('coupon/update/{id}',[CouponController::class,'updateCoupon'])->name('admin#updateCoupon');
    Route::get('coupon/delete/{id}',[CouponController::class,'deleteCoupon'])->name('admin#deleteCoupon');

    //state & division
    Route::get('statedivision',[StateDivisionController::class,'index'])->name('admin#statedivision');
    Route::post('statedivision/create',[StateDivisionController::class,'createStatedivision'])->name('admin#createStatedivision');
    Route::get('statedivision/edit/{id}',[StateDivisionController::class,'editStatedivision'])->name('admin#editStatedivision');
    Route::post('statedivision/edit/{id}',[StateDivisionController::class,'updateStatedivision'])->name('admin#updateStatedivision');
    Route::get('statedivision/delete/{id}',[StateDivisionController::class,'deleteStatedivision'])->name('admin#deleteStatedivision');

    //city
    Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);
    Route::post('/cities', [RajaOngkirController::class, 'getCities']);
    Route::post('/subdistricts', [RajaOngkirController::class, 'getSubdistricts']);
    
    //admin profile
    Route::get('profile/edit',[AdminProfileController::class,'index'])->name('admin#profile');
    Route::post('profile/edit',[AdminProfileController::class,'editProfile'])->name('admin#editProfile');
    Route::get('profile/password/edit',[AdminProfileController::class,'editPassword'])->name('admin#editPassword');
    Route::post('profile/password/edit',[AdminProfileController::class,'updatePassword'])->name('admin#updatePassword');

    //order
    Route::get('order',[AdminOrderController::class,'index'])->name('admin#order');
    Route::get('order/filter',[AdminOrderController::class,"filterOrder"])->name('admin#filterOrder');
    Route::get('order/pending',[AdminOrderController::class,'pendingOrder'])->name('admin#pendingOrder');
    Route::get('order/detail/{id}/{notiId?}',[AdminOrderController::class,'showOrder'])->name('admin#showOrder');
    Route::get('order/confirm/{id}',[AdminOrderController::class,'confirmOrder'])->name('admin#confirmOrder');
    Route::get('order/process/{id}',[AdminOrderController::class,'processOrder'])->name('admin#processOrder');
    Route::get('order/pick/{id}',[AdminOrderController::class,'pickOrder'])->name('admin#pickOrder');
    Route::get('order/ship/{id}',[AdminOrderController::class,'shipOrder'])->name('admin#shipOrder');
    Route::get('order/deliver/{id}',[AdminOrderController::class,'deliverOrder'])->name('admin#deliverOrder');

    //user list
    Route::get('userList',[UserController::class,'userList'])->name('admin#userList');
    Route::get('adminList',[UserController::class,'adminList'])->name('admin#adminList');
    Route::get('user/edit/{id}',[UserController::class,'editUser'])->name('admin#editUser');
    Route::post('user/edit/{id}',[UserController::class,'updateUser'])->name('admin#updateUser');
    Route::get('user/delete/{id}',[UserController::class,'deleteUser'])->name('admin#deleteUser');

    //reports
    Route::get('reports',[ReportController::class,'report'])->name('admin#report');
    Route::get('reports/search/byDate',[ReportController::class,'searchByDate'])->name('admin#searchByDate');
    Route::get('reports/search/byMonth',[ReportController::class,'searchByMonth'])->name('admin#searchByMonth');
    Route::get('reports/search/byYear',[ReportController::class,'searchByYear'])->name('admin#searchByYear');

    //product review
    Route::get('product/review',[AdminReviewController::class,'index'])->name('admin#productReview');
    Route::get('product/review/pending',[AdminReviewController::class,'pendingReview'])->name('admin#pendingReview');
    Route::get('product/review/{id}',[AdminReviewController::class,'showReview'])->name('admin#showReview');
    Route::get('product/review/approve/{id}',[AdminReviewController::class,'approveReview'])->name('admin#approveReview');
    Route::get('product/review/delete/{id}',[AdminReviewController::class,'deleteReview'])->name('admin#deleteReview');

    //payment info
    Route::get('paymentInfo',[PaymentInfoController::class,'index'])->name('admin#paymentInfo');
    Route::get('paymentInfo/create',[PaymentInfoController::class,'createPaymentInfo'])->name('admin#createPaymentInfo');
    Route::post('paymentInfo/create',[PaymentInfoController::class,'storePaymentInfo'])->name('admin#storePaymentInfo');
    Route::get('paymentInfo/edit/{id}',[PaymentInfoController::class,'editPaymentInfo'])->name('admin#editPaymentInfo');
    Route::post('paymentInfo/edit/{id}',[PaymentInfoController::class,'updatePaymentInfo'])->name('admin#updatePaymentInfo');
    Route::get('paymentInfo/delete/{id}',[PaymentInfoController::class,'deletePaymentInfo'])->name('admin#deletePaymentInfo');

    //payment transition
    Route::get('paymentTransition',[PaymentTransitionController::class,'index'])->name('admin#paymentTransition');
    Route::get('paymentTransition/{id}',[PaymentTransitionController::class,'showPaymentTransition'])->name('admin#showPaymentTransition');

    //company setting
    Route::get('companySetting',[CompanySettingController::class,'index'])->name('admin#companySetting');
    Route::get('companySetting/create',[CompanySettingController::class,'createCompanySetting'])->name('admin#createCompanySetting');
    Route::post('companySetting/store',[CompanySettingController::class,'storeCompanySetting'])->name('admin#storeCompanySetting');
    Route::get('companySetting/edit/{id}',[CompanySettingController::class,'editCompanySetting'])->name('admin#editCompanySetting');
    Route::post('companySetting/edit/{id}',[CompanySettingController::class,'updateCompanySetting'])->name('admin#updateCompanySetting');
    Route::get('companySetting/delete/{id}',[CompanySettingController::class,'deleteCompanySetting'])->name('admin#deleteCompanySetting');

    //cash on delivery
    Route::get('cashOnDelivery',[CashOnDeliveryController::class,'index'])->name('admin#cos');
    Route::post('cashOnDelivery/create',[CashOnDeliveryController::class,'store'])->name('admin#storeCos');
    Route::get('cashOnDelivery/edit/{id}',[CashOnDeliveryController::class,'edit'])->name('admin#editCos');
    Route::post('cashOnDelivery/edit/{id}',[CashOnDeliveryController::class,'update'])->name('admin#updateCos');
    Route::get('cashOnDelivery/delete/{id}',[CashOnDeliveryController::class,'delete'])->name('admin#deleteCos');
    Route::post('cashOnDelivery/getTownship',[CashOnDeliveryController::class,'getTownship'])->name('admin#getTownship');

});

Route::group(['namespace' => 'FrontEnd'],function(){
    //index
    Route::get('/',[FrontEndController::class,'index'])->name('frontend#index');

    //all product
    Route::get('product/all',[FrontEndController::class,'showAllProduct'])->name('frontend#allProduct');

    //category product
    Route::get('product/category/{id}',[FrontEndController::class,'categoryProduct'])->name('frontend#catProduct');
    Route::get('product/subcategory/{id}',[FrontEndController::class,'subcategoryProduct'])->name('frontend#subcatProduct');
    Route::get('product/subsubcategory/{id}',[FrontEndController::class,'subsubcategoryProduct'])->name('frontend#subsubcatProduct');
    Route::get('product/brand/{id}',[FrontEndController::class,'brandProduct'])->name('frontend#brandProduct');
    Route::get('product/filter',[FrontEndController::class,'filterProduct'])->name('frontend#filterProduct');

    //product detail
    Route::get('product/detail/{id}',[FrontEndController::class,'showProduct'])->name('frontend#showProduct');
    Route::post('product/detail/size',[FrontEndController::class,'getProductSize'])->name('frontend#getProductSize');

    //search product
    Route::get('product/search',[FrontEndController::class,'searchProduct'])->name('frontend#searchProduct');

});

Route::group(['prefix' => 'user','namespace' => 'User','middleware' => 'auth'],function(){
    //cart
    Route::post('product/addToCart/',[CartController::class,'addToCart'])->name('frontend#addToCart');
    Route::get('myCarts',[CartController::class,'viewCarts'])->name('frontend#viewCarts');
    Route::post('myCarts/update',[CartController::class,'updateCart'])->name('frontend#updateCart');
    Route::get('myCarts/delete/{id}',[CartController::class,'deleteCart'])->name('frontend#deleteCart');

    //wishlist
    Route::get('wishlist',[WishListController::class,'index'])->name('user#wishlist');
    Route::get('getWishlist',[WishListController::class,'getWishlist'])->name('user#getWishlist');
    Route::post('wishlist/add/{id}',[WishListController::class,'addWishlist'])->name('user#addWishlist');
    Route::get('wishlist/delete/{id}',[WishListController::class,'deleteWishlist'])->name('user#deleteWishlist');

    //checkout
    Route::get('checkout',[CheckoutController::class,'checkoutPage'])->name('user#checkout');
    Route::post('getCity',[CheckoutController::class,'getCity'])->name('user#getCity');
    Route::post('getTownship',[CheckoutController::class,'getTownship'])->name('user#getTownship');

    //coupon
    Route::post('applyCoupon',[CartController::class,'applyCoupon'])->name('user#applyCoupon');
    Route::get('deleteCoupon',[CartController::class,'deleteCoupon'])->name('user#deleteCoupon');

    //order
    Route::post('checkout',[OrderController::class,'createOrder'])->name('user#createOrder');

    //user payment
    Route::post('confirmPayment',[OrderController::class,'confirmPayment'])->name('user#confirmPayment');

    //my order track
    Route::get('track/myOrder',[OrderController::class,'trackOrder'])->name('user#trackOrder');

    //profile
    Route::get('profile',[ProfileController::class,'index'])->name('user#profile');
    Route::post('profile/update',[ProfileController::class,'updateProfile'])->name('user#updateProfile');
    Route::get('profile/password/edit',[ProfileController::class,'editPassword'])->name('user#editPassword');
    Route::post('profile/password/update',[ProfileController::class,'updatePassword'])->name('user#updatePassword');

    Route::get('profile/review',[ProfileController::class,'myReview'])->name('user#myReview');

    Route::get('orders',[ProfileController::class,'myOrder'])->name('user#myOrder');
    Route::get('orders/detail/{id}',[ProfileController::class,'orderDetail'])->name('user#orderDetail');
    Route::get('downloadInvoice/{id}',[ProfileController::class,'downloadInvoice'])->name('user#download#downloadInvoice');

    //review
    Route::post('product/review/{id}',[ReviewController::class,'storeReview'])->name('user#storeReview');


});