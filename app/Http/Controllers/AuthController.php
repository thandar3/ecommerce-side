<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //lgonin
    public function loginPage(){
        return view('login');
    }

    //register
    public function registerPage(){
        return view('register');
    }

    //dashboard lint to admin or user
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }elseif(Auth::user()->role == 'user'){
            return redirect()->route('product#list');
        }
    }
}
