<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileSettingController extends Controller
{

    public function index(){
        $currentUser = Auth::guard('admin')->user();
        return view('profile-setting', compact('currentUser'));
    }

    public function updateProfile(Request $request) : RedirectResponse{
        $admin = Admin::find($request->id);

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|unique:admins,email,'.$admin->id
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();
        Toastr::success('Profile updated successfully');
        return Redirect::back();


    }
    public function updatePassword(Request $request){

        $this->validate($request, [
            'password' => 'required|min:4|string|confirmed',
            'old_password' => 'required'
        ]);
        $currentUser = Admin::find($request->id);
        $oldPassword        = $request->old_password;
        $newPassword        = $request->password;
        $confirmPassword    = $request->password_confirmation;

        if ($newPassword === $confirmPassword){
            if (Hash::check($oldPassword, $currentUser->password)){
                if (!Hash::check($newPassword, $currentUser->password)){
                    $currentUser->password = Hash::make($newPassword);
                    $currentUser->save();
                    Toastr::success('Password updated successfully!');
                    return Redirect::back();
                }else{
                    Toastr::warning('Old & new password should not be same!');
                    return Redirect::back();
                }
            }else{
                Toastr::warning('Invalid old password!');
                return Redirect::back();
            }
        }else{
            Toastr::warning('New & confirm password are not match!');
            return Redirect::back();
        }

    }

}
