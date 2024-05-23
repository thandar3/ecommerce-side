<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductControllerUser extends Controller
{
    //product for user
    public function productList(){
        $products = Product::get();
        $categories = Category::get();
        return view('user.product.list',compact('products','categories'));
    }

    //product filter
    public function productFilter($categoryName){
        $products =Product::where('product_category',$categoryName)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        return view('user.product.list',compact('categories','products'));

    }

    //product detail
    public function detail($productId,$productPrice){
        $product = Product::where('id',$productId)->first();
        $products = Product::get();
        return view('user.product.detail',compact('product','products','productPrice'));
    }

    public function totalProduct(Request $request){
        $data = $this->orderEachProduct($request);
        Order::create($data);
        return back();
    }

    //create product
    private function orderEachProduct($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'total_price' => $request->price * $request->count,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
