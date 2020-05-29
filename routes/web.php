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


Route::get('/', 'HomeController@index')->name('home');
Route::get('/user', 'HomeController@userIndex')->name('userPanel');
Route::get('/admin', 'HomeController@adminIndex');
Route::get('/home', 'HomeController@frontIndex');
Route::get('/product/{slug}','HomeController@singleProduct')->name('product.single');
Route::get('/shop', 'CartController@shop')->name('shop');
Route::get('/checkout', 'CartController@checkout')->name('checkout');
Route::get('/cart', 'CartController@cart')->name('cart.index');
Route::post('/add', 'CartController@add')->name('cart.store');
Route::post('/update', 'CartController@update')->name('cart.update');
Route::post('/remove', 'CartController@remove')->name('cart.remove');
Route::post('/clear', 'CartController@clear')->name('cart.clear');
Route::get('/account/login', 'CheckoutController@loginForm')->name('customer.login_form');
Route::post('/customer/login', 'CheckoutController@customerLogin')->name('customer.login');
Route::post('/customer/register', 'CheckoutController@customerRegister')->name('customer.register');
Route::get('/customer/logout', 'CheckoutController@customerLogout')->name('customer.logout');
Route::post('/order-place', 'CheckoutController@orderPlace')->name('order.place');
Auth::routes();

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'auth'],function (){

    Route::resource('categories', 'ProductCategoryController')->except(['create','show']);
    Route::resource('products', 'ProductsController');
    Route::resource('orders', 'OrderController');


});
//Route::group(['prefix' => 'user','namespace' => 'Admin','middleware' => 'auth'],function (){
//
//    Route::resource('address', 'UserController')->except(['create','show']);
//    Route::resource('account', 'UserController');
//    Route::resource('orders', 'UserController');
//
//
//});
Route::get('/token/{id}', 'VerificationController@verify')->name('user.activation');
Route::get('/dashboard', 'CustomerController@dashboard')->name('user.dashboard');
Route::get('/address', 'CustomerController@address')->name('user.address');
Route::get('/user-account', 'CustomerController@userAccount')->name('user.userAccount');
Route::get('/user-orders', 'CustomerController@userOrders')->name('user.userOrders');
Route::get('/user-orders-show', 'CustomerController@userOrders')->name('user.orderShow');
Route::post('/profile/update', 'CustomerController@profileUpdate')->name('user.userAccount.update');
Route::get('/user', 'CustomerController@userIndex')->name('userPanel')->middleware('customAuth');;

//Route::group(['middleware'=>['customAuth']],function(){
//    Route::get('/user', 'CustomerController@userIndex')->name('userPanel');
//})

