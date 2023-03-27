<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function Dashboard(){
        return view('dashboard');
    }

    public function Logout() : RedirectResponse{
        Auth::guard('admin')->logout();
        Toastr::success('Logout successfully!');
        return Redirect::route('login');
    }

}
