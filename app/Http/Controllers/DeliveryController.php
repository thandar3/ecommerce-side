<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    //user info
    public function diliveryUser(Request $request){
        $this->validationDeliverySection($request);
        $data = $this->addDeliveryUserData($request);
        Delivery::create($data);
        return back()->with(['createSuccess' => 'You information saved']);
    }

    public function vocherDetail(){
        $orderLists = OrderList::select('order_lists.*','orders.qty as totalProduct','products.image as ProductImage','products.name as ProductName','products.price as ProductPrice','products.id as ProductId')
        ->leftJoin('orders','order_lists.order_id','orders.id')
        ->leftJoin('products','order_lists.product_id','products.id')
        ->where('orders.user_id',Auth::user()->id)
        ->get();
        return view('user.cart.vocherDetail',compact('orderLists'));
    }

    //add data
    private function addDeliveryUserData($request){
        return[
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'delivery_fee' => $request->delivery_fee
        ];
    }

    //validation delivery section
    private function validationDeliverySection($request){
        $validationForm = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
        Validator::make($request->all(),$validationForm)->validate();
    }
}
