<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //show profile
    public function index(){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();
        return view('customer.profile',compact('userCartCount'));
    }
    // change password page
    public function passwordPage(){
        $userCartCount = Cart::select('id')->where('user_id',Auth::user()->id)->groupBy('user_id')->count();

        return view('customer.changePassword',compact('userCartCount'));
    }
    public function changePassword(Request $request){

        $validator =  $request->validate([
            'oldPassword' => 'required|' ,
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword'
        ]);
        $dbOldPassword = User::select('password')->where('id',Auth::user()->id)->first();
        $dbOldPassword = $dbOldPassword['password'];
        $formOldPassword = $request->oldPassword;
        if(Hash::check($formOldPassword,$dbOldPassword)){
            $data = [
                'password'=> Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            Alert::success('Success ', 'Product Create Successfully...');
            return back();
        }
        Alert::error('Error Message', 'Error in Change Password');
        return to_route('adminDashboard');

    }

    // profile update
    public function update(Request $request){
        $this->formValidation($request);
        $data = $this->requestFormDate($request);
        $oldImage = Auth::user()->profile;
        // if user select image
        if($request->hasFile('image')){
            if($oldImage!=null){
               if(file_exists(public_path('profileImages/'.$oldImage))){
                unlink(public_path('profileImages/'.$oldImage));
               }
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/profileImages/',$fileName);
            $data['profile'] = $fileName;
        }else{
            $data['profile'] =$oldImage;
        }
        User::where('id',Auth::user()->id)->update($data);
        Alert::success('Success ', 'Profile Update Successfully...');
        return back();
    }
    // form validation
    private function formValidation($request){
        $validationRules = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file'

        ];
        $validationRules['email'] = $request->has('email') != null ? 'required|unique:users,email,'. Auth::user()->id : '';
        // you can make custom message
        $validationMessage =[];
        $validatior = $request->validate($validationRules,$validationMessage);
    }

    // request form data
    private function requestFormDate($request){
       $data = [];
       if(Auth::user()->name != null){
         $data['name'] = $request->name;
       }else{
         $data['nickname'] = $request->name;
       }
       if($request->has('email')){
        $data['email'] = $request->email;
       }
       $data['address'] = $request->address;
       $data['phone'] = $request->phone;
       return $data;
    }

}
