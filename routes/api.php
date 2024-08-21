<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Support\Facades\Route;


// GET
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('category/delete/{id}',[RouteController::class, 'deleteCategory']);

// POST
Route::post('category/create',[RouteController::class,'createCategory']);

