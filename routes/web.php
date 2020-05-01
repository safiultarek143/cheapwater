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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index');
Route::get('/product/{slug}','HomeController@singleProduct')->name('product.single');
Route::get('/admin', function () {
    return view('layouts.admin');
});

Auth::routes();



Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'auth'],function (){
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'ProductCategoryController')->except(['create','show']);
    Route::resource('products', 'ProductsController');
    Route::resource('order', 'ProductsController');


});


