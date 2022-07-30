<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeasuresController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\DeliveryController;

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

Route::get('/', [ShowcaseController::class, 'main'])->name('main');
Route::get('/menu/{id}/{name?}', [ShowcaseController::class, 'category'])->name('menu');
Route::get('/our-stores', [ShowcaseController::class, 'stores'])->name('our-stores');

Route::get('/admin', function(){
    return 'em construção';
})->name('admin');

Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', function(){
        return 'em construção';
    })->name('dashboard');

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

    //stores
    Route::get('/store/{id?}', [StoreController::class, 'adminView'])->name('store')->where('id', '[0-9]+');
    Route::post('/store/save', [StoreController::class, 'saveStore'])->name('store.save');
    Route::post('/store/delete', [StoreController::class, 'deleteStore'])->name('store.delete');
    Route::post('/store/search', [StoreController::class, 'searchStore'])->name('store.search');

    //template
    Route::get('/template', [TemplateController::class, 'adminView'])->name('template');
    Route::post('/template/save', [TemplateController::class, 'saveTemplate'])->name('template.save');

    //general
    Route::get('/general', [GeneralController::class, 'adminView'])->name('general');
    Route::post('/general/save', [GeneralController::class, 'saveGeneral'])->name('general.save');

    //social-media
    Route::get('/social-media', [SocialMediaController::class, 'adminView'])->name('social-media');
    Route::post('/social-media/save', [SocialMediaController::class, 'saveSocialMedia'])->name('social-media.save');

    //delivery settings
    Route::get('/delivery', [DeliveryController::class, 'adminView'])->name('delivery');
    Route::post('/delivery/save', [DeliveryController::class, 'saveDelivery'])->name('delivery.save');
});