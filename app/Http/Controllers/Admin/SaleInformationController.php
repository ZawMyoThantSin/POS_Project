<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleInformationController extends Controller
{
    //show list page
    public function list(){
        $orderList = Order::select('orders.id as order_id','orders.total_price','orders.count' ,'orders.created_at','orders.order_code','orders.status'
        ,'users.name as user_name','users.nickname','products.image','products.name')
        ->leftJoin('users','users.id','orders.user_id')
        ->leftJoin('products','orders.product_id','products.id')
        ->where('orders.status',1)
        ->groupBy('orders.order_code')
        ->orderBy('orders.created_at','desc')
        ->get();

        return view('admin.saleInformation.list',compact('orderList'));
    }
}
