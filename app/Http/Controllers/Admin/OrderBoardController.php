<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\PaySlipHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderBoardController extends Controller
{
    //show order list page
    public function orderList(){
        $orderList = Order::select('orders.id as order_id','orders.created_at','orders.order_code','orders.status' ,'users.id as user_id','users.name as user_name','users.nickname')
                    ->leftJoin('users','users.id','orders.user_id')
                    ->groupBy('orders.order_code')
                    ->orderBy('orders.created_at','desc')
                    ->paginate(5);
        return view('admin.orderBoard.list',compact('orderList'));
    }

    // order details page
    public function orderDetails($orderCode){
        $orders = Order::select('orders.id','orders.count','orders.created_at','orders.order_code','orders.total_price','products.price','products.image',
        'products.name','users.email','users.phone','users.name as user_name','users.nickname')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->leftJoin('products','products.id','orders.product_id')
                    ->where('orders.order_code',$orderCode)
                    ->get();
        $invoiceData  = PaySlipHistory::select('pay_slip_histories.*','payments.type as payment_type')
                        ->leftJoin('payments','pay_slip_histories.payment_method','payments.id')
                        ->where('pay_slip_histories.order_code',$orderCode)
                        ->first();
        $totalPrice = Order::where('order_code',$orderCode)->sum('total_price');
        $totalPrice += 500;
        return view('admin.orderBoard.detail',compact('orders','totalPrice','invoiceData'));
    }

    // change order status
    public function changeStatus(Request $request){
        Order::where('order_code',$request['orderCode'])->update([
            'status' => $request['status']
        ]);

        return response()->json([
            'message'=> 'success',
            'status' => 200
            ]);
    }
}
