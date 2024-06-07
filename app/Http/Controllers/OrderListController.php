<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    //orderlist
    public function orderListes(Request $request){


        foreach($request->all() as $items){
             $data = OrderList::create([
                 'user_id' => $items['user_id'],
                 'product_id' => $items['product_id'],
                 'order_id' => $items['order_id'],
                 'qty' => $items['qty'],
                 'sub_total' => $items['subTotal'],
                 'total_price' => $items['totalPrice'],
                 'pin_code' => $items['order_code'],
                 'total_each' => $items['totalForOne'],
             ]);

        };



        Order::where('id',Auth::user()->id)->delete();
     }

     //ordereach delete
     public function orderEach(Request $request){
            logger($request);
     }
}
