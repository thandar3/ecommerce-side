<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductControllerUser extends Controller
{
    //product for user
    public function productList(){
        return view('user.product.list');
}
}
