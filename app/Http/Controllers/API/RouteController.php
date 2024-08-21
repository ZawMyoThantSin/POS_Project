<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
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

    public function createCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response = Category::create($data);
        return response()->json($response,200);
    }
    public function deleteCategory($id){
        $data = Category::where('id',$id)->first();
        if(!empty($data)){
            Category::where('id',$id)->delete();
            return response()->json([
                'status' => '200, OK',
                'message' => 'Category Deleted Successfully...'
            ],200);
        }
        return response()->json([
            'status' => '404, NOT Found',
            'message' => 'There is no Category with that ID...'
        ],404);
    }
}

