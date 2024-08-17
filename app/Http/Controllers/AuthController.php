<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //register page
    public function registerPage(){
        return view('authentication.register');
    }

    // login page
    public function loginPage(){
        return view('authentication.login');
    }
}
