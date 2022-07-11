<?php

use Illuminate\Support\Facades\Route;

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