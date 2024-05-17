<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminAccController extends Controller
{
    //show detail
    public function accountShow(){
        return view('admin.acc.list');
    }

    //edit form page
    public function accountEdit($id){
        $user = User::where('id',$id)->first();
        return view('admin.acc.edit',compact('user'));
    }

    //create acc
    public function accountCreate(){
        return view('admin.acc.create');
    }

    public function accountUpdate(Request $request){
       $this->ValidationUpdateUser($request);
       $user = $this->updateUser($request);

       if($request->hasFile('image')){

        $oldImage = User::where('id',Auth::user()->id)->first();
        $oldImage = $oldImage->image;

        if($oldImage != null){
            Storage::delete('public/userPhotos'.$oldImage);
        }

        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/userPhotos', $fileName);
        $user['image'] = $fileName;
       }

       User::where('id',Auth::user()->id)->update($user);
       return redirect()->route('account#show')->with(['updateSuccess' => 'Your Profile updated ']);
    }

    //data update
    private function updateUser($request){
        return [
            'name' => $request->user_name,
            'email'=> $request->user_email,
            'phone' => $request->user_phone,
            'address'=>$request->user_address,
            'role' => Auth::user()->role,
        ];
    }

    //validation user list
    private function ValidationUpdateUser($request){
        $validationUser = [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_phone' => 'required',
            'user_address' => 'required',
        ];

        Validator::make($request->all(),$validationUser)->validate();
    }
}
