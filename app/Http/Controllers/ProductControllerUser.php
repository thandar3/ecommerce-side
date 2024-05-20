<?php

namespace App\Http\Controllers;

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
}
