<?php

use App\Coupon;
use App\Helpers\MyStr;
use App\Http\Livewire\Store\Cart;
use Illuminate\Support\Facades\Route;
use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopProduct;

Auth::routes();

Route::get('/', 'IndexController@index')->name('home');
//Route::view('/', 'soon.index')->name('soon');

// about us
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/testimonials', 'TestimonialController@index')->name('testimonials');
Route::view('/contact-us', 'contact-us')->name('contact-us');
Route::post('/contact-us', 'IndexController@contact');
Route::get('/service/{service:slug}', 'ServiceController@show')->name('service.show');
Route::get('/news', 'NewsController@index')->name('news.index');
Route::get('/news/{news:slug}', 'NewsController@show')->name('news.show');
Route::get('/calculator', 'CalculatorController@index')->name('calculator');

Route::get('/store', 'Store\IndexController@index')->name('store.index');
Route::get('/store/category/{larashopCategory:slug}', 'Store\LarashopCategoryController@index')->name('store.category.index');
Route::get('/store/category/{larashopCategory:id}/prouduct/{larashopProduct:slug}', 'Store\LarashopProductController@show')->name('store.product.show');

Route::get('/store/cart', 'Store\CartController@index')->name('cart.index');
Route::post('/store/cart', 'Store\CartController@add');

Route::get('/profile/address/', 'AddressController@index')->name('address.index');
Route::get('/profile/address/create', 'AddressController@create')->name('address.create');
Route::post('/profile/address/', 'AddressController@store')->name('address.store');
Route::get('/profile/address/{address}/edit', 'AddressController@edit')->name('address.edit');
Route::put('/profile/address/{address}', 'AddressController@update')->name('address.update');
Route::get('/profile/address/{address}/primary', 'AddressController@primary')->name('address.primary');
Route::delete('/profile/address/{address}', 'AddressController@destroy')->name('address.destroy');

Route::get('/profile/purchases', 'Order\OrderController@purchases')->name('profile.purchases')->middleware('auth');

Route::get('/store/search', 'Store\SearchController@search')->name('store.search');

Route::get('order/{order}/checkout/{checkout}/credit', 'Order\OrderController@creditBankForm')->name('order.creditBankForm');
Route::get('calculator/{calculator}/checkout/{checkout}/credit', 'CalculatorController@creditBankForm')->name('calculator.creditBankForm');
Route::get('order/{order}/checkout/{checkout}/mada', 'Order\OrderController@madaBankForm')->name('order.madaBankForm');
Route::get('/order/{order}/payment', 'Order\OrderController@payment')->name('order.payment');
Route::get('/calculator/{calculator}/payment', 'CalculatorController@payment')->name('calculator.payment');
Route::get('/order/{order}/payOrder', 'Order\OrderController@payOrder')->name('order.payOrder');
Route::get('/order/complete', 'Order\OrderController@complete')->name('order.complete');
