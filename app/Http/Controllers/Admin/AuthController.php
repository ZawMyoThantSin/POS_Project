<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    // change password
    public function changePasswordPage(){
        return view('admin.password.changePassword');
    }
    public function changePassword(Request $request){
        $validator = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword'
        ]);

        $dbOldPassword = User::select('password')->where('id',Auth::user()->id)->first();
        $dbOldPassword = $dbOldPassword['password'];
        $useroldPassword = $request->oldPassword;

        if(Hash::check($useroldPassword , $dbOldPassword)){
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

}
