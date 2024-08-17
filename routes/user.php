<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' =>'customer', 'middleware'=> ['auth','user']],function(){

    Route::get('/home',[UserDashboardController::class,'index'])->name('userDashboard');
    Route::get('/shop/{category_id?}',[ShopController::class,'index'])->name('shopPage');
    Route::get('/shop/details/{id}',[ShopController::class,'details'])->name('shopDetails');
    // comment
    Route::post('/comment',[ShopController::class,'comment'])->name('comment');
    // rating
    Route::post('/addRating',[ShopController::class,'addRating'])->name('addRating');
    // user Profile
    Route::get('/profile',[ProfileController::class,'index'])->name('profilePage');
    Route::post('/profile',[ProfileController::class,'update'])->name('userProfileUpdate');
    Route::get('/changePassword',[ProfileController::class,'passwordPage'])->name('passwordPage');
    Route::post('/changePassword',[ProfileController::class,'changePassword'])->name('userChangePassword');

    // cart page
    Route::get('/cart',[ShopController::class,'cart'])->name('cart');
    Route::post('/cart',[ShopController::class,'addToCart'])->name('addToCart');
    Route::get('/remove/cart',[ShopController::class,'removeCart'])->name('removeCart');
    Route::get('/order',[ShopController::class,'order'])->name('order');
    Route::get('/order/list',[ShopController::class,'orderList'])->name('orderList');
    Route::get('/order/details/{order_code}',[ShopController::class,'orderDetailPage'])->name('orderDetails');
    Route::get('/payment',[ShopController::class,'paymentPage'])->name('paymentPage');
    Route::post('/order/product',[ShopController::class,'orderProduct'])->name('orderProduct');

});
