<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileSettingController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;

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
    Route::get('/role/view/', 'pdfGen')->name('pdf');
});
Route::prefix('users')->controller(UserController::class)->middleware('admin')->group(function (){
    Route::get('/all', 'index')->name('user.index');
    Route::get('/user/add', 'create')->name('user.create');
    Route::post('/user/store', 'store')->name('user.store');
    Route::get('/user/edit/{id}', 'edit')->name('user.edit');
    Route::post('/user/update/{id}', 'update')->name('user.update');
    Route::get('/user/delete/{id}', 'destroy')->name('user.delete');
});

Route::prefix('setups')->middleware('admin')->group(function (){

    Route::controller(StudentClassController::class)->group(function (){

        // Student Classes
        Route::get('/student/class/view', 'StudentClassView')->name('student.class.view');
//        Route::get('/student/class/add', 'StudentClassAdd')->name('student.class.add');
        Route::post('/student/class/store', 'StudentClassStore')->name('student.class.store');
        Route::get('/student/class/edit/{id}', 'StudentClassEdit')->name('student.class.edit');
        Route::post('/student/class/update/{id}', 'StudentClassUpdate')->name('student.class.update');
        Route::get('/student/class/delete/{id}', 'StudentClassDestroy')->name('student.class.delete');
    });

    // Student Year
    Route::controller(StudentYearController::class)->group(function (){
        Route::get('/student/year/view', 'StudentYearView')->name('student.year.view');
//        Route::get('/student/class/add', 'StudentClassAdd')->name('student.class.add');
        Route::post('/student/year/store', 'StudentYearStore')->name('student.year.store');
        Route::get('/student/year/edit/{id}', 'StudentYearEdit')->name('student.year.edit');
        Route::post('/student/year/update/{id}', 'StudentYearUpdate')->name('student.year.update');
        Route::get('/student/year/delete/{id}', 'StudentYearDestroy')->name('student.year.delete');
    });

    // Student Group
    Route::controller(StudentGroupController::class)->group(function (){
        Route::get('/student/group/view', 'StudentGroupView')->name('student.group.view');
//        Route::get('/student/class/add', 'StudentClassAdd')->name('student.class.add');
        Route::post('/student/group/store', 'StudentGroupStore')->name('student.group.store');
        Route::get('/student/group/edit/{id}', 'StudentGroupEdit')->name('student.group.edit');
        Route::post('/student/group/update/{id}', 'StudentGroupUpdate')->name('student.group.update');
        Route::get('/student/group/delete/{id}', 'StudentGroupDestroy')->name('student.group.delete');
    });


});


Route::controller(ProfileSettingController::class)->middleware('admin')->group(function (){
    Route::get('/profile/settings', 'index')->name('profile.setting');
    Route::post('/profile/update', 'updateProfile')->name('profile.update');
    Route::post('/profile/update-password', 'updatePassword')->name('profile.update.password');
});




Route::controller(AuthController::class)->group(function (){
    Route::get('/', 'Login')->name('login');
    Route::post('/', 'LoginAttempt')->name('login.attempt');
    Route::get('/register', 'Register')->name('register');
    Route::post('/register', 'RegisterAttempt')->name('register.post');
});




