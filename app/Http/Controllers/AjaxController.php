<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //order list show
    public function orderList(){
        $orderList = Order::select('orders.*','products.image as productImage','products.name as productName','products.price as productPrice')
        ->leftJoin('products','orders.product_id','products.id')
        ->where('user_id',Auth::user()->id)
        ->get();
        return view('user.order.list',compact('orderList'));
    }

    //order delete
    public function orderDelete(Request $request){
        Order::where('id',$request->order_id)
        ->delete();
    }

    //clear order
    public function clearOrder(){
        Order::where('user_id',Auth::user()->id)->delete();
        return back();
    }
}
