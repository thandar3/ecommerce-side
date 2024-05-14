<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    //user list for admin panel
    public function userList(){
        $users = User::where('role','user')->get();
        return view('admin.user.list',compact('users'));
    }

    public function userChange(Request $request){
        User::where('id',$request->userId)->update([
            'role' => $request->status,
        ]);
    }
}
