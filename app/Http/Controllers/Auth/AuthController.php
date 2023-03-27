<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function Login(){
        if (!Auth::guard('admin')->check()){
            return view('auth.login');
        }else{
            return Redirect::route('dashboard');
        }

    }

    public function LoginAttempt(Request $request){

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;
        if (Auth::guard('admin')->attempt(['username'=> $username, 'password' => $password]) || Auth::guard('admin')->attempt(['email'=> $username, 'password' => $password])){
            Toastr::success('Login successfully');
            return Redirect::route('dashboard');
        }else{
            Toastr::warning('Email/Username or password is invalid!');
            return Redirect::route('login');
        }

    }

    public function Register(){

        if (!Auth::guard('admin')->check()){
            return view('auth.register');
        }else{
            return Redirect::route('dashboard');
        }
    }

    public function RegisterAttempt(Request $request) :RedirectResponse {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email',
            'password' => 'required',
            'username' => 'required|unique:admins,username'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username
        ]);

        Auth::guard('admin')->login($admin);

        Toastr::success('Register successfully!');
        return Redirect::route('dashboard');


    }


}
