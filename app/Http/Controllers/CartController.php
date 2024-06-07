<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //order cart
    public function orderCard(){
        $product = OrderList::select('order_lists.*','products.name as ProductName','products.image as ProductImage','products.price as ProductPrice')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->where('user_id',Auth::user()->id)
        ->get();

        $order = OrderList::select('order_lists.*','orders.qty as totalProduct','products.image as ProductImage','products.name as ProductName','products.price as ProductPrice')
        ->leftJoin('orders','order_lists.order_id','orders.id')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->where('orders.user_id',Auth::user()->id)
        ->get();


        return view('user.cart.list',compact('order','product'));
    }

    //orderVocher
    public function orderVocher(){
        $orders = Order::where('id',Auth::user()->id)->first();
        $order = OrderList::select('order_lists.*','orders.qty as totalProduct','products.image as ProductImage','products.name as ProductName','products.price as ProductPrice','products.id as ProductId')
        ->leftJoin('orders','order_lists.order_id','orders.id')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->where('orders.user_id',Auth::user()->id)
        ->get();
        return view('user.cart.vocher',compact('order','orders'));
    }


}
