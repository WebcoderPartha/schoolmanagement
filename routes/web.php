<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;

Route::controller(AdminController::class)->middleware('admin')->group(function (){
    Route::get('/dashboard', 'Dashboard')->name('dashboard');
    Route::get('/logout', 'Logout')->name('logout');
});

Route::controller(RoleController::class)->middleware('admin')->group(function (){
    Route::get('/role', 'index')->name('role.index');
    Route::get('/role/create', 'create')->name('role.create');
    Route::post('/role/store', 'store')->name('role.store');
    Route::get('/role/edit/{id}', 'edit')->name('role.edit');
    Route::post('/role/update/{id}', 'update')->name('role.update');
    Route::get('/role/delete/{id}', 'destroy')->name('role.delete');
});


Route::controller(AuthController::class)->group(function (){
    Route::get('/', 'Login')->name('login');
    Route::post('/', 'LoginAttempt')->name('login.attempt');
    Route::get('/register', 'Register')->name('register');
    Route::post('/register', 'RegisterAttempt')->name('register.post');
});




