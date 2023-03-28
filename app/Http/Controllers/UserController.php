<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Admin::orderBy('id', 'DESC')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'username'  =>  'required|unique:admins,username',
            'email'  =>  'required|unique:admins,email',
            'password'  =>  'required|confirmed',
        ]);

        if ($request->file('image')){
            $file = $request->file('image');
            $image = 'avatar'.date('d-m-Y').'.'.$file->getClientOriginalExtension();
            $directory = 'uploads/profile/';
            Image::make($file)->resize('600', '600')->save($directory.$image);
            $user = new Admin();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->image = $directory.$image;
            $user->save();

            Toastr::success('User created successfully!');
            return Redirect::route('user.index');

        }else{

            $user =  new Admin();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            Toastr::success('User created successfully!');
            return Redirect::route('user.index');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Admin::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = Admin::find($id);

        $this->validate($request, [
            'name'      =>  'required',
            'username'  =>  'required|unique:admins,username,'.$user->id,
            'email'  =>  'required|unique:admins,email,'.$user->id,
            'password'  =>  'required|confirmed',
        ]);


        if ($request->file('image')){

            $image = $request->file('image');
            $imageName = 'avatar'.date('d-m-Y').'.'.$image->getClientOriginalExtension();
            $directory = 'uploads/profile/';

            Image::make($image)->resize(600,600)->save($directory.$imageName);



            if ($user->image !== NULL){
                if (file_exists(public_path($user->image))){
                    unlink(public_path($user->image));

                    $user->name = $request->name;
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->image = $directory.$imageName;
                    $user->save();
                    Toastr::success('User updated successfully!');
                    return Redirect::route('user.index');

                }else{
                    $user->name = $request->name;
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->image = $directory.$imageName;
                    $user->save();
                    Toastr::success('User updated successfully!');
                    return Redirect::route('user.index');
                }
            }else{
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password =Hash::make($request->password);
                $user->image = $directory.$imageName;
                $user->save();
                Toastr::success('User updated successfully!');
                return Redirect::route('user.index');
            }


        }else{
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            Toastr::success('User updated successfully!');
            return Redirect::route('user.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);

        if (!$admin->image == NULL){
            if (file_exists(public_path($admin->image))){
                unlink(public_path($admin->image));
                $admin->delete();
                Toastr::success('User deleted successfully!');
                return Redirect::back();
            }else{
                $admin->delete();
                Toastr::success('User deleted successfully!');
                return Redirect::back();
            }
        }else{
            $admin->delete();
            Toastr::success('User deleted successfully!');
            return Redirect::back();
        }
    }
}
