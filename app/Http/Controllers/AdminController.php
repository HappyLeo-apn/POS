<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    //Password Change
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
       
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue =$user->password;
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
           User::where('id', Auth::user()->id)->update($data);
        //    Auth::logout();
        //    return redirect()->route('auth#loginPage');
            return back()->with(['changeSuccess' => "Password successfully changed!"]);

           
        }
        return back()->with(['notMatch' => "Old password does not match! Try Again!"]);
       

    }
    //Admin Acoount details
    public function details(){
        return view('admin.account.details');
    }

    public function edit(){
        return view('admin.account.edit');
    }

    //Password Validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword' 
        ])->validate();
    }
}
