<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Support\Facades\Route;

Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
