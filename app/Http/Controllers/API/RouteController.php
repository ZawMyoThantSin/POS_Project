<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //get all products
    public function productList(){
        $products = Product::get();
        return response()->json($products,200);
    }

    public function categoryList(){
        $categories = Category::get();
        return response()->json($categories,200);
    }
}
