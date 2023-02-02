<?php

namespace App\Http\Controllers;

use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
    //Update Account 
    public function update($id, Request $request){
       $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            $dbImageName = User::where('id', $id)->first();
            $dbImageName = $dbImageName->image;

            if($dbImageName != null){
                Storage::delete('public/' . $dbImageName);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('public', $fileName);
           $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('admin#details')->with(['accountSuccess' => 'Admin account info updated...']);

    }

    //Password Validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
            'image' => 'mimes:png,jpeg,jpg|file'
        ])->validate();
    }
    //Get uesr data
    private function getUserData($request){
        return  [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' =>  $request->gender,
            'updated_at' => Carbon::now()
        ];
    }

    //Account Validation 
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',

        ])->validate();
    }
}
