<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserListController extends Controller
{
    //show list
    public function adminList(){

        $adminList = User::select('id','name','nickname','email','address','phone','role')
                            ->orWhere('role','admin')
                            ->orWhere('role','superAdmin')
                            ->paginate(5);

        $userCount = User::where('role','user')->count();
        return view('admin.users.adminList',compact('adminList','userCount'));
    }

    public function userList(){

        $userList = User::select('id','name','nickname','email','address','phone','role')
                            ->where('role','user')
                            ->paginate(5);
        $adminCount =User::orWhere('role','admin')
                         ->orWhere('role','superAdmin')->count();
        return view('admin.users.userList',compact('userList','adminCount'));
    }

    // Role Change
    public function adminRoleChange($id){
        User::where('id',$id)->update(['role'=>'admin']);
        Alert::success('Success ', 'Admin Role Change Successfully...');
        return to_route('adminList');
    }
    public function userRoleChange($id){
        User::where('id',$id)->update(['role'=>'user']);
        Alert::success('Success ', 'User Role Change Successfully...');
        return to_route('userList');
    }


    // delete
    public function adminDelete($id){
        User::where('id',$id)->delete();
        Alert::success('Success ', 'Admin Account Deleted Successfully...');
        return back();
    }
    public function userDelete($id){
        User::where('id',$id)->delete();
        Alert::success('Success ', 'User Account Deleted Successfully...');
        return back();
    }
}
