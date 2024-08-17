<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderBoardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SaleInformationController;
use App\Http\Controllers\Admin\UserListController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' =>'admin', 'middleware'=> ['auth','admin']],function(){

    Route::get('/home',[AdminDashboardController::class,'index'])->name('adminDashboard');

    #for category
    Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'list'])->name('categoryList');
        Route::get('create',[CategoryController::class,'createPage'])->name('categoryCreatePage');
        Route::post('create',[CategoryController::class,'create'])->name('categoryCreate');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('categoryDelete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('categoryEdit');
        Route::post('update',[CategoryController::class,'update'])->name('categoryUpdate');
    });

    Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('productList');
        Route::get('create',[ProductController::class,'createPage'])->name('productCreatePage');
        Route::post('create',[ProductController::class,'create'])->name('productCreate');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('productDelete');
        Route::get('details/{id}',[ProductController::class,'details'])->name('productDetails');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('productEdit');
        Route::post('update',[ProductController::class,'update'])->name('productUpdate');

    });
    Route::prefix('password')->group(function(){
        Route::get('change',[AuthController::class, 'changePasswordPage'])->name('changePasswordPage');
        Route::post('change',[AuthController::class, 'changePassword'])->name('changePassword');
    });
    Route::prefix('payment')->group(function(){
        Route::get('list',[PaymentController::class, 'home'])->name('paymentHome');
        Route::post('create',[PaymentController::class, 'create'])->name('paymentCreate');
        Route::get('edit/{id}',[PaymentController::class, 'editPage'])->name('paymentEdit');
        Route::get('delete/{id}',[PaymentController::class, 'delete'])->name('paymentDelete');
        Route::post('update',[PaymentController::class, 'update'])->name('paymentUpdate');

    });

    Route::prefix('profile')->group(function(){
        Route::get('details',[ProfileController::class,'details'])->name('profileDetails');
        Route::post('update',[ProfileController::class, 'update'])->name('profileUpdate');
        Route::get('create/admin',[ProfileController::class,'createAdminAccount'])->name('createAdminAccount');
        Route::post('create/admin',[ProfileController::class,'createAdmin'])->name('createAdmin');
        Route::get('account/{id}',[ProfileController::class,'accountProfile'])->name('accountProfile');
    });

    Route::prefix('users')->group(function(){
        Route::get('admin/list',[UserListController::class,'adminList'])->name('adminList');
        Route::get('adminDelete/{id}',[UserListController::class,'adminDelete'])->name('adminDelete');
        Route::get('userRoleChange/{id}',[UserListController::class,'userRoleChange'])->name('userRoleChange');


        Route::get('list',[UserListController::class,'userList'])->name('userList');
        Route::get('userDelete/{id}',[UserListController::class,'userDelete'])->name('userDelete');
        Route::get('adminRoleChange/{id}',[UserListController::class,'adminRoleChange'])->name('adminRoleChange');

    });

    Route::prefix('order')->group(function(){
        Route::get('/list',[OrderBoardController::class,'orderList'])->name('orderBoard');
        Route::get('/deatails/{orderCode}',[OrderBoardController::class,'orderDetails'])->name('adminOrderDetails');
        Route::get('/change/status',[OrderBoardController::class ,'changeStatus'])->name('changeStatus');
    });

    Route::prefix('saleInfo')->group(function(){
        Route::get('/list',[SaleInformationController::class,'list'])->name('saleInfoList');

    });
});
