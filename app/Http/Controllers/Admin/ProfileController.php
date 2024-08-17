<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //profile details
    public function details(){
        return view('admin.profile.details');
    }

    //create admin account page
    public function createAdminAccount(){
        return view('admin.profile.createAdminAccount');
    }
    // create admin account
    public function createAdmin(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => 'required|unique:users,email',
            'password'=> 'required',
            'confirmPassword' => 'required|same:password'
        ]);
        $adminData = [
            'name'=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'provider'=> 'simple'
        ];
        User::create($adminData);
        Alert::success('Success ', 'Admin Account Added Successfully...');
        return redirect()->route('adminList');
    }

    //admin profile update
    public function update(Request $request){
        $this->formValidation($request);
        $data = $this->requestData($request);
        $oldImage = Auth::user()->profile;

        if($request->hasFile('image')){
            //delete old image

            if($oldImage !=null){
                if(file_exists(public_path('profileImages/'.$oldImage))){
                    unlink(public_path('profileImages/'.$oldImage));
                }
            }
            //upload new image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path(). '/profileImages/',$fileName);
            $data['profile']= $fileName;
        }else{
            $data['profile'] = $oldImage;
        }
        User::where('id',Auth::user()->id)->update($data);
        Alert::success('Success ', 'Product Update Successfully...');
        return back();
    }

    //account profile detaiils
    public function accountProfile($id){
        $account = User::where('id',$id)->first();

        return view('admin.profile.accountProfile',compact('account'));
    }
    // request form data
    private function requestData($request){
        $data = [];

        if(Auth::user()->name!= null){
            $data['name'] = $request->name;
        }else{
            $data['nickname']= $request->name;
        }
        if($request->has('email')){
            $data['email'] = $request->email;
        }
        $data['phone']= $request->phone;
        $data['address']  = $request->address;
        return $data;
    }

    // form validation
    private function formValidation($request){
        $validationRules = [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file'

        ];
        $validationRules['email'] = $request->has('email') != null ? 'required|unique:users,email,'. Auth::user()->id : '';
        // you can make custom message
        $validationMessage =[];
        $validatior = $request->validate($validationRules,$validationMessage);
    }
}
