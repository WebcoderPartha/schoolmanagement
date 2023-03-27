<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;

Route::controller(AdminController::class)->middleware('admin')->group(function (){
    Route::get('/dashboard', 'Dashboard')->name('dashboard');
});

Route::controller(AuthController::class)->group(function (){
    Route::get('/', 'Login')->name('login');
});




