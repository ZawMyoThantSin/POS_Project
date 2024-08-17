<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    //home page
    public function index(){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();

        $category = Category::get();
        $products = Product::select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->get();
        $customerCount = User::where('role','user')->count();
        $userRating = Rating::select('ratings.count','ratings.created_at','users.name','users.nickname','users.profile')
                        ->leftJoin('users','users.id','ratings.user_id')
                        ->orderBy('created_at','desc')
                        ->get();
        return view('customer.home',compact('category','products','customerCount','userRating','userCartCount'));
    }
}
