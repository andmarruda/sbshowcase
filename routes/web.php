<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeasuresController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerAreaController;
use App\Http\Controllers\CartController;

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

//public
Route::get('/', [ShowcaseController::class, 'home'])->name('main');
Route::get('/product-list/{id}/{name?}/{filter?}/{filter_id?}', [ShowcaseController::class, 'productList'])->name('product-list')->where('id', '[0-9]+')->where('filter_id', '[0-9]+');
Route::get('/product/{id}/{name?}', [ShowcaseController::class, 'productDetail'])->name('product-detail')->where('id', '[0-9]+');
Route::get('/our-stores', [ShowcaseController::class, 'stores'])->name('our-stores');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/add/{product_id}', [CartController::class, 'add'])->name('cart-add')->where('product_id', '[0-9]+');
Route::get('/cart/remove/{product_id}', [CartController::class, 'remove'])->name('cart-remove')->where('product_id', '[0-9]+');

//customer area
Route::get('/customer-login', [CustomerAreaController::class, 'customerLogin'])->name('customer-login');
Route::post('/customer-login', [CustomerAreaController::class, 'login'])->name('customer-logging-in');
Route::get('/customer-register', [CustomerAreaController::class, 'customerRegister'])->name('customer-register');
Route::get('/customer-registered', [CustomerAreaController::class, 'customerRegistered'])->name('customer-registered');
Route::post('/customer-register', [CustomerAreaController::class, 'createCustomer'])->name('create-customer');

Route::prefix('/customer-area')->middleware('SBCustomerAuth')->group(function() {
    Route::get('/', [CustomerAreaController::class, 'customerArea'])->name('customer-area');
    Route::get('/logout', [CustomerAreaController::class, 'logout'])->name('customer-logout');
    Route::get('/change-password', [CustomerAreaController::class, 'changePassword'])->name('customer-change-password');
    Route::post('/change-password', [CustomerAreaController::class, 'updatePassword'])->name('customer-update-password');
    Route::get('/registration-data', [CustomerAreaController::class, 'registrationData'])->name('customer-registration-data');
    Route::post('/registration-data/update', [CustomerAreaController::class, 'updateCustomer'])->name('customer-update-registration-data');
});

//admin backend
Route::get('/admin', [UserController::class, 'loginView'])->name('admin');
Route::post('/admin', [UserController::class, 'login'])->name('admin.login');
Route::prefix('/admin')->middleware('SBAuth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'adminView'])->name('dashboard');

    //Order routes
    Route::get('/order', [OrderController::class, 'adminView'])->name('order');

    //category routes
    Route::get('/category/{id?}', [CategoryController::class, 'adminView'])->name('category')->where('id', '[0-9]+');
    Route::post('/category/save', [CategoryController::class, 'saveCategory'])->name('category.save');
    Route::post('/category/delete', [CategoryController::class, 'deleteCategory'])->name('category.delete');
    Route::post('/category/search', [CategoryController::class, 'searchCategory'])->name('category.search');

    //measurement routes
    Route::get('/measurement/{id?}', [MeasuresController::class, 'adminView'])->name('measurement')->where('id', '[0-9]+');
    Route::post('/measurement/save', [MeasuresController::class, 'saveMeasurement'])->name('measurement.save');
    Route::post('/measurement/delete', [MeasuresController::class, 'deleteMeasurement'])->name('measurement.delete');
    Route::post('/measurement/search', [MeasuresController::class, 'searchMeasurement'])->name('measurement.search');

    //colors routes
    Route::get('/color/{id?}', [ColorController::class, 'adminView'])->name('color')->where('id', '[0-9]+');
    Route::post('/color/save', [ColorController::class, 'saveColor'])->name('color.save');
    Route::post('/color/delete', [ColorController::class, 'deleteColor'])->name('color.delete');
    Route::post('/color/search', [ColorController::class, 'searchColor'])->name('color.search');

    //brand routes
    Route::get('/brand/{id?}', [BrandController::class, 'adminView'])->name('brand')->where('id', '[0-9]+');
    Route::post('/brand/save', [BrandController::class, 'saveBrand'])->name('brand.save');
    Route::post('/brand/delete', [BrandController::class, 'deleteBrand'])->name('brand.delete');
    Route::post('/brand/search', [BrandController::class, 'searchBrand'])->name('brand.search');

    //type routes
    Route::get('/type/{id?}', [TypeController::class, 'adminView'])->name('type')->where('id', '[0-9]+');
    Route::post('/type/save', [TypeController::class, 'saveType'])->name('type.save');
    Route::post('/type/delete', [TypeController::class, 'deleteType'])->name('type.delete');
    Route::post('/type/search', [TypeController::class, 'searchType'])->name('type.search');

    //products
    Route::get('/product/{id?}/{copy?}', [ProductController::class, 'adminView'])->name('product')->where('id', '[0-9]+')->where('copy', '[0-1]');
    Route::get('/product-list/{search?}', [ProductController::class, 'searchProduct'])->name('product.search');
    Route::post('/product/save', [ProductController::class, 'saveProduct'])->name('product.save');
    Route::post('/product/delete', [ProductController::class, 'deleteProduct'])->name('product.delete');

    //stores
    Route::get('/store/{id?}', [StoreController::class, 'adminView'])->name('store')->where('id', '[0-9]+');
    Route::post('/store/save', [StoreController::class, 'saveStore'])->name('store.save');
    Route::post('/store/delete', [StoreController::class, 'deleteStore'])->name('store.delete');
    Route::post('/store/search', [StoreController::class, 'searchStore'])->name('store.search');

    //template
    Route::get('/template', [TemplateController::class, 'adminView'])->name('template');
    Route::post('/template/save', [TemplateController::class, 'saveTemplate'])->name('template.save');

    //banners
    Route::get('/banner/{id?}', [BannerController::class, 'adminView'])->name('banner')->where('id', '[0-9]+');
    Route::post('/banner/save', [BannerController::class, 'save'])->name('banner.save');
    Route::post('/banner/delete', [BannerController::class, 'delete'])->name('banner.delete');
    Route::post('/banner/search', [BannerController::class, 'search'])->name('banner.search');

    //general
    Route::get('/general', [GeneralController::class, 'adminView'])->name('general');
    Route::post('/general/save', [GeneralController::class, 'saveGeneral'])->name('general.save');

    //social-media
    Route::get('/social-media', [SocialMediaController::class, 'adminView'])->name('social-media');
    Route::post('/social-media/save', [SocialMediaController::class, 'saveSocialMedia'])->name('social-media.save');

    //delivery settings
    Route::get('/delivery/{selected_state_id?}', [DeliveryController::class, 'adminView'])->name('delivery')->where('selected_state_id', '[0-9]+');
    Route::post('/delivery/save', [DeliveryController::class, 'saveDelivery'])->name('delivery.save');
    Route::post('/delivery/delete', [DeliveryController::class, 'deleteDelivery'])->name('delivery.delete');

    //payment methods
    Route::get('/payment-methods', [PaymentMethodController::class, 'adminView'])->name('payment-methods');
    Route::post('/payment-methods/save', [PaymentMethodController::class, 'savePaymentMethods'])->name('payment-methods.save');

    //users
    Route::get('/users/{id?}', [UserController::class, 'adminView'])->name('users')->where('id', '[0-9]+');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/users/save', [UserController::class, 'save'])->name('users.save');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::post('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/change-password', [UserController::class, 'changePasswordView'])->name('change-password');
    Route::post('/users/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
});