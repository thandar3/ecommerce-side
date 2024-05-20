<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserAccController extends Controller
{
    //show user acc
    public function showAcc(){
        return view('user.users.show');
    }

    //editAcc
    public function editAcc($userId){
        $user = User::where('id',$userId)->first();
        return view('user.users.edit',compact('user'));
    }

    //updateAcc
    public function updateAcc(Request $request){
        $this->userAccValidation($request);
        $data = $this->userAccUpdatedList($request);

        if($request->hasFile('image')){

                $oldImage = User::where('id',Auth::user()->id)->first();
                $oldImage = $oldImage->image;

                if($oldImage != null){
                    Storage::delete('public/userPhotos'.$oldImage);
                }

                $fileName = uniqid().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/userPhotos',$fileName);
                $data['image']= $fileName;
        }

        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('user#show')->with(['updateSuccess' => 'Your Profile updated ']);
    }

    //validation
    private function userAccValidation($request){
        $validationUser = [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_phone' => 'required',
            'user_address' => 'required',
        ];

        Validator::make($request->all(),$validationUser)->validate();
    }

    //update
    private function userAccUpdatedList($request){
        return [
            'name' => $request->user_name,
            'email'=> $request->user_email,
            'phone' => $request->user_phone,
            'address'=>$request->user_address,
            'role' => $request->userRole,
        ];
    }

}
