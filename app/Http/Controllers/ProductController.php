<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //product list
    public function productList(){
            return view('user.product.list');
    }
}
