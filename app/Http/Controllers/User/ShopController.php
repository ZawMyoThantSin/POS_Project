<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PaySlipHistory;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    //show shop page
    public function index($category_id = null){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();

        $products = Product::when(request('searchKey'),function($query){
                        $query->where('products.name','like','%'.request('searchKey').'%');
                     });
        if(request('minPrice')!= null && request('maxPrice') != null){
            $products= $products->whereBetween('products.price',[request('minPrice'),request('maxPrice')]);
        }else if(request('minPrice')!= null && request('maxPrice') == null){
            $products= $products->where('products.price','>=',request('minPrice'));
        }else if(request('minPrice')== null && request('maxPrice') != null){
            $products = $products->where('products.price','<=',request('maxPrice'));
        }

        $products = $products->select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id');

        if($category_id == null){
            $products = $products->paginate(9);
        }else{
            $products = $products->where('products.category_id',$category_id)->paginate(9);
        }
        $categories = Category::get();
        return view('customer.shop',compact('products','categories','userCartCount'));
    }

    public function details($id){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();

        $product = Product::select('products.id', 'products.name', 'products.price', 'products.description','products.category_id', 'products.count','products.image','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();

        $comment = Comment::select('comments.*','users.name as user_name','users.nickname','users.profile as user_profile')
                    ->leftJoin('users','comments.user_id','users.id')
                    ->where('comments.product_id',$id)
                    ->orderBy('created_at','desc')
                    ->get();
        $productRating = Rating::where('product_id',$id)->avg('count');
        $ratingCount = Rating::where('product_id',$id)->get();
        $userRating = Rating::select('count')->where('product_id',$id)->where('user_id',Auth::user()->id)->first();
        $userRating = $userRating == null ? 0 : $userRating['count'];
        $productList = Product::select('products.id', 'products.name', 'products.price', 'products.description','products.category_id', 'products.count','products.image','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->get();

        return view('customer.shopDetails',compact('product','comment','productRating','ratingCount','userRating','productList','userCartCount'));
    }

    // comment
    public function comment(Request $request){
        $request->validate([
            'message'=> 'required'
        ]);
        $data = [
            'product_id'=> $request->productId,
            'user_id' => $request->userId,
            'message' => $request->message
        ];
        Comment::create($data);
        return back();
    }
    // add rating
    public function addRating(Request $request){
        $ratingStatus = Rating::where('product_id',$request->productId)->where('user_id',Auth::user()->id)->first();
        if($ratingStatus==null){
            Rating::create([
                'product_id' => $request->productId,
                'user_id'=> Auth::user()->id,
                'count' => $request->productRating
            ]);
        }else{
            Rating::where('product_id',$request->productId)->where('user_id',Auth::user()->id)->update([
                'count' => $request->productRating
            ]);
        }

        return back();
    }

    // cart page
    public function cart(){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();

        $user_id = Auth::user()->id;
        $cartData = Cart::select('carts.*','products.name','products.price','products.image')
                    ->leftJoin('products','carts.product_id','products.id')
                    ->where('user_id',$user_id)
                    ->get();

        $totalPrice = 0;
        foreach($cartData as $item){
            $totalPrice += $item->price * $item->qty;
        }
        return view('customer.cart',compact('cartData','totalPrice','userCartCount'));
    }
    // add to cart
    public function addToCart(Request $request){
        $userId = Auth::user()->id;
        $productId = $request->productId;
        $qty = $request->qty;
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'qty' => $qty
        ]);
        return redirect()->route('shopPage');
    }
    // Remove cart by id
    public function removeCart(Request $request){
        Cart::where('id',$request->cartId)->delete();
        $data = Cart::where('user_id',Auth::user()->id)->get();
        $serverData = [
            'data' =>$data,
            'message' => 'success'
        ];
       return response()->json($serverData,200);
    }

    // order process
    public function order(Request $request){
        $orderArr = [];
        foreach($request->all() as $item){
            array_push($orderArr,[
                'user_id' => $item['userId'],
                'product_id' => $item['productId'],
                'count' => $item['qty'],
                'total_price' => $item['totalPrice'],
                'status' => 0,
                'order_code' => $item['orderCode']
            ]);
        }
        Session::put('orderList',$orderArr); //session create

        return response()->json([
            'message'=> 'success',
            'status' => 200
            ]);
    }
    // order list page
    public function orderList(){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();
        $orderList = Order::where('user_id',Auth::user()->id)
                                ->groupBy('order_code')
                                ->orderBy('created_at','desc')
                                ->get();
        $totalPrice = Order::where('user_id',Auth::user()->id)
                                ->groupBy('order_code')
                                ->sum('total_price');

        return view('customer.orderList',compact('userCartCount','orderList','totalPrice'));
    }

    // order Details Page
    public function orderDetailPage($orderCode){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();
        $orders = Order::select('orders.id','orders.count','orders.created_at','orders.order_code','orders.total_price','products.price','products.image','products.name')
                        ->leftJoin('products','products.id','orders.product_id')
                        ->where('order_code',$orderCode)
                        ->get();
        return view('customer.orderDetails',compact('orders','userCartCount'));
    }
    // direct payment page
    public function paymentPage(){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();
        $payments = Payment::orderBy('type','asc')
                    ->get();
        $orderList = Session::get('orderList');
        $totalPrice = 0;
        foreach($orderList as $item){
            $totalPrice += $item['total_price'];
        }
        return view('customer.payment',compact('userCartCount','payments','orderList','totalPrice'));
    }
    // order Product
    public function orderProduct(Request $request){
        $validator = $request->validate([
            'customerName' => 'required',
            'phone' => 'required',
            'paymentMethod' => 'required',
            'invoiceImage' => 'required'

        ]);
        // cart to order & delete cart data
        $cartProduct = Session::get('orderList');
        foreach($cartProduct as $item){
            Order::create($item);
            Cart::where('user_id',$item['user_id'])->where('product_id',$item['product_id'])->delete();
        }
        $data = [
            'customer_name' => $request->customerName,
            'phone' => $request->phone,
            'payment_method' =>$request->paymentMethod,
            'order_code' => $request->orderCode,
            'order_amount' => $request->totalPrice
        ];

        // save image
        if($request->hasFile('invoiceImage')){
            $fileName = uniqid() . $request->file('invoiceImage')->getClientOriginalName();
            $request->file('invoiceImage')->move(public_path().'/invoiceImages/',$fileName);
            $data['invoice_image'] = $fileName;
        }
        PaySlipHistory::create($data);

        return redirect()->route('orderList');
    }
}
