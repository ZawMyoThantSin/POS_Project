<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaySlipHistory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //direct index page
    public function index(){
        $total_sale_amount = PaySlipHistory::sum('order_amount');

        $total_users = User::where('role','user')->count();
        $total_admins = User::orWhere('role','admin')->orWhere('role','superAdmin')->count();

        $pending_orders = Order::where('status',0)->groupBy('order_code')->get();
        $pending_orders = count($pending_orders);

        $success_orders  =Order::where('status',1)->groupBy('order_code')->get();
        $success_orders = count($success_orders);
        $payment_counts = Payment::count();
        $category_counts= Category::count();
        $product_counts = Product::count();

        return view('admin.home',compact('product_counts','category_counts','total_sale_amount','total_admins','total_users','pending_orders','success_orders','payment_counts'));
    }
}
