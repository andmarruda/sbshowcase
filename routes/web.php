<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('template.public');
})->name('news');

Route::get('/stores', function(){
    return 'em construção';
})->name('stores');

Route::get('/orders', function(){
    return 'em construção';
})->name('orders');

Route::get('/admin', function(){
    return 'em construção';
})->name('admin');

Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', function(){
        return 'em construção';
    })->name('dashboard');

    Route::get('/category', [CategoryController::class, 'adminView'])->name('category');

    Route::get('/config/template', function(){
        return 'em construção';
    })->name('config.template');
});