<?php

use Illuminate\Support\Facades\Route;



// about
Route::prefix('about')->name('about.')->group(function () {
    Route::get('/', 'AboutController@index')->name('index');
    Route::PUT('/', 'AboutController@update')->name('update');
});

// settings
Route::prefix('settings')->name('setting.')->group(function () {
    Route::get('/', 'SettingController@index')->name('index');
    Route::PUT('/', 'SettingController@update')->name('update');
});

// testimonials
Route::prefix('testimonials')->name('testimonial.')->group(function () {
    Route::get('/', 'TestimonialController@index')->name('index');
    Route::get('/create', 'TestimonialController@create')->name('create');
    Route::post('/', 'TestimonialController@store')->name('store');
    Route::get('/{googleReview}/edit', 'TestimonialController@edit')->name('edit');
    Route::put('/{googleReview}', 'TestimonialController@update')->name('update');
    Route::delete('/{googleReview}', 'TestimonialController@destroy')->name('destroy');
});

// brands
Route::prefix('brands')->name('brand.')->group(function () {
    Route::get('/', 'BrandController@index')->name('index');
    Route::get('/create', 'BrandController@create')->name('create');
    Route::post('/', 'BrandController@store')->name('store');
    Route::get('/{brand}/edit', 'BrandController@edit')->name('edit');
    Route::put('/{brand}', 'BrandController@update')->name('update');
    Route::delete('/{brand}', 'BrandController@destroy')->name('destroy');
});

// services
Route::prefix('services')->name('service.')->group(function () {
    Route::get('/', 'ServiceController@index')->name('index');
    Route::get('/create', 'ServiceController@create')->name('create');
    Route::post('/', 'ServiceController@store')->name('store');
    Route::get('/{service}/edit', 'ServiceController@edit')->name('edit');
    Route::put('/{service}', 'ServiceController@update')->name('update');
    Route::delete('/{service}', 'ServiceController@destroy')->name('destroy');
    Route::get('/service/media/{media}/delete', 'ServiceController@deleteMedia')->name('media.delete');
});

// clients
Route::prefix('clients')->name('client.')->group(function () {
    Route::get('/', 'ClientController@index')->name('index');
    Route::get('/create', 'ClientController@create')->name('create');
    Route::post('/', 'ClientController@store')->name('store');
    Route::get('/{client}/edit', 'ClientController@edit')->name('edit');
    Route::put('/{client}', 'ClientController@update')->name('update');
    Route::delete('/{client}', 'ClientController@destroy')->name('destroy');
});

// News
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', 'NewsController@index')->name('index');
    Route::get('/create', 'NewsController@create')->name('create');
    Route::post('/', 'NewsController@store')->name('store');
    Route::get('/{news}/edit', 'NewsController@edit')->name('edit');
    Route::put('/{news}', 'NewsController@update')->name('update');
    Route::delete('/{news}', 'NewsController@destroy')->name('destroy');
});

// Cities
Route::prefix('shop/cities')->name('shop.city.')->group(function () {
    Route::get('/', 'CityController@index')->name('index');
    Route::get('/create', 'CityController@create')->name('create');
    Route::post('/', 'CityController@store')->name('store');
    Route::get('/{city}/edit', 'CityController@edit')->name('edit');
    Route::put('/{city}', 'CityController@update')->name('update');
    Route::delete('/{city}', 'CityController@destroy')->name('destroy');
});


// Coupons
Route::prefix('shop/coupons')->name('shop.coupon.')->group(function () {
    Route::get('/', 'CouponController@index')->name('index');
    Route::get('/create', 'CouponController@create')->name('create');
    Route::post('/', 'CouponController@store')->name('store');
    Route::get('/{coupon}/edit', 'CouponController@edit')->name('edit');
    Route::put('/{coupon}', 'CouponController@update')->name('update');
    Route::delete('/{coupon}', 'CouponController@destroy')->name('destroy');
});

// Orders
Route::prefix('shop/orders')->name('shop.order.')->group(function () {
    Route::get('/', 'OrderController@index')->name('index');
    Route::get('/show/{order}', 'OrderController@show')->name('show');
    Route::post('/show/{order}/changePaymentStatus', 'OrderController@changePaymentStatus')->name('changePaymentStatus');
    Route::post('/show/{order}/changeOrderStatus', 'OrderController@changeOrderStatus')->name('changeOrderStatus');
    Route::get('/{order}/edit', 'OrderController@edit')->name('edit');
    Route::put('/{order}', 'OrderController@update')->name('update');
    Route::delete('/{order}', 'OrderController@destroy')->name('destroy');
});

// Calculator
Route::prefix('shop/calculators')->name('shop.calculator.')->group(function () {
    Route::get('/', 'CalculatorController@index')->name('index');
    Route::get('/show/{calculator}', 'CalculatorController@show')->name('show');
    Route::post('/show/{calculator}/changePaymentStatus', 'CalculatorController@changePaymentStatus')->name('changePaymentStatus');
    Route::post('/show/{calculator}/changeOrderStatus', 'CalculatorController@changeOrderStatus')->name('changeOrderStatus');
    Route::get('/{calculator}/edit', 'CalculatorController@edit')->name('edit');
    Route::put('/{calculator}', 'CalculatorController@update')->name('update');
    Route::get('/{calculator}/delete', 'CalculatorController@destroy')->name('destroy');
});

// videos
Route::resource('/videoCategory', 'VideoCategoryController');
Route::resource('/videos', 'VideoController');
Route::resource('/adv', 'AdvController');
