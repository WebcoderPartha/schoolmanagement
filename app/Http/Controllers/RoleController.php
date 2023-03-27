<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required|unique:roles,role_name'
        ]);
        $role = new Role();
        $role->role_name = $request->role_name;
        $role->role_slug = Str::lower(Str::of($request->role_name)->slug('-'));
//        $role->role_slug = Str::lower(Str::of($request->role_slug)->slug('-'));
        $role->save();
        Toastr::success('Role created successfully!');
        return Redirect::back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all();
        $role = Role::find($id);
        return view('role.edit', compact('role', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        $this->validate($request, [
            'role_name' => 'required|unique:roles,role_name,'.$role->id
        ]);

        $role->role_name = $request->role_name;
        $role->role_slug = Str::lower(Str::of($request->role_name)->slug('-'));
        $role->save();
        Toastr::success('Role updated successfully!');
        return Redirect::route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        $role = Role::find($id);
        $role->delete();
        Toastr::success('Role deleted successfully!');
        return Redirect::route('role.index');
    }
}
