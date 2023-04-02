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
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeCategoryAmountController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Student\StudentRegistrationController;
use App\Http\Controllers\Backend\Student\RollController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;



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
    Route::get('/list', 'index')->name('user.index');
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
        Route::post('/student/class/store', 'StudentClassStore')->name('student.class.store');
        Route::get('/student/class/edit/{id}', 'StudentClassEdit')->name('student.class.edit');
        Route::post('/student/class/update/{id}', 'StudentClassUpdate')->name('student.class.update');
        Route::get('/student/class/delete/{id}', 'StudentClassDestroy')->name('student.class.delete');
    });

    // Student Year
    Route::controller(StudentYearController::class)->group(function (){
        Route::get('/student/year/view', 'StudentYearView')->name('student.year.view');
        Route::post('/student/year/store', 'StudentYearStore')->name('student.year.store');
        Route::get('/student/year/edit/{id}', 'StudentYearEdit')->name('student.year.edit');
        Route::post('/student/year/update/{id}', 'StudentYearUpdate')->name('student.year.update');
        Route::get('/student/year/delete/{id}', 'StudentYearDestroy')->name('student.year.delete');
    });

    // Student Group
    Route::controller(StudentGroupController::class)->group(function (){
        Route::get('/student/group/view', 'StudentGroupView')->name('student.group.view');
        Route::post('/student/group/store', 'StudentGroupStore')->name('student.group.store');
        Route::get('/student/group/edit/{id}', 'StudentGroupEdit')->name('student.group.edit');
        Route::post('/student/group/update/{id}', 'StudentGroupUpdate')->name('student.group.update');
        Route::get('/student/group/delete/{id}', 'StudentGroupDestroy')->name('student.group.delete');
    });

    // Student Shift
    Route::controller(StudentShiftController::class)->group(function (){
        Route::get('/student/shift/view', 'StudentShiftView')->name('student.shift.view');
        Route::post('/student/shift/store', 'StudentShiftStore')->name('student.shift.store');
        Route::get('/student/shift/edit/{id}', 'StudentShiftEdit')->name('student.shift.edit');
        Route::post('/student/shift/update/{id}', 'StudentShiftUpdate')->name('student.shift.update');
        Route::get('/student/shift/delete/{id}', 'StudentShiftDestroy')->name('student.shift.delete');
    });

    // Student Fee Category
    Route::controller(FeeCategoryController::class)->group(function (){
        Route::get('/student/fee/category/view', 'StudentFeeCategoryView')->name('student.fcategory.view');
        Route::post('/student/fee/category/store', 'StudentFeeCategoryStore')->name('student.fcategory.store');
        Route::get('/student/fee/category/edit/{id}', 'StudentFeeCategoryEdit')->name('student.fcategory.edit');
        Route::post('/student/fee/category/update/{id}', 'StudentFeeCategoryUpdate')->name('student.fcategory.update');
        Route::get('/student/fee/category/delete/{id}', 'StudentFeeCategoryDestroy')->name('student.fcategory.delete');
    });



    // Student Fee Category Amount
    Route::controller(FeeCategoryAmountController::class)->group(function (){
        Route::get('/student/fee/amount/view', 'StudentFeeCategoryAmountView')->name('student.fcamount.view');
        Route::post('/student/fee/amount/store', 'StudentFeeCategoryAmountStore')->name('student.fcamount.store');
        Route::get('/student/fee/amount/new', 'StudentFeeCategoryAmountCreate')->name('student.fcamount.add');
        Route::get('/student/fee/amount/edit/{fee_category_id}', 'StudentFeeCategoryAmountEdit')->name('student.fcamount.edit');
        Route::post('/student/fee/amount/update/{fee_category_id}', 'StudentFeeCategoryAmountUpdate')->name('student.fcamount.update');
        Route::get('/student/fee/amount/delete/{fee_category_id}', 'StudentFeeCategoryAmountDestroy')->name('student.fcamount.delete');
        Route::get('/student/fee/amount/single/{id}', 'FeeAmountDeleteSingle')->name('student.fcamount.single.del');
        Route::get('/student/fee/amount/details/{fee_category_id}', 'FeeAmountDetails')->name('student.fcamount.details');
        Route::get('/student/fee/amount/pdf/{fee_category_id}', 'FeeAmountDetailsPDF')->name('student.fcamount.pdf');
    });

    // Exam Type
    Route::controller(ExamTypeController::class)->group(function (){
        Route::get('/exam/type/view', 'ExamTypeView')->name('exam_type.view');
        Route::post('/exam/type/store', 'ExamTypeStore')->name('exam_type.store');
        Route::get('/exam/type/edit/{id}', 'ExamTypeEdit')->name('exam_type.edit');
        Route::post('/exam/type/update/{id}', 'ExamTypeUpdate')->name('exam_type.update');
        Route::get('/exam/type/delete/{id}', 'ExamTypeDestroy')->name('exam_type.delete');
    });

    // School Subject
    Route::controller(SchoolSubjectController::class)->group(function (){
        Route::get('/school/subject/view', 'SchoolSubjectView')->name('school_subject.view');
        Route::post('/school/subject/store', 'SchoolSubjectStore')->name('school_subject.store');
        Route::get('/school/subject/edit/{id}', 'SchoolSubjectEdit')->name('school_subject.edit');
        Route::post('/school/subject/update/{id}', 'SchoolSubjectUpdate')->name('school_subject.update');
        Route::get('/school/subject/delete/{id}', 'SchoolSubjectDestroy')->name('school_subject.delete');
    });

    // Assign Subject
    Route::controller(AssignSubjectController::class)->group(function (){
        Route::get('/assign/subject/view', 'assignSubjectView')->name('assign_subject.view');
        Route::get('/assign/subject/add-assign-subject', 'assignSubjectAdd')->name('assign_subject.add');
        Route::post('/assign/subject/store', 'assignSubjectStore')->name('assign_subject.store');
        Route::get('/assign/subject/details/class/{class_id}', 'assignSubjectClassDetails')->name('assign_subject.details');
        Route::get('/assign/subject/edit/{class_id}', 'assignSubjectEdit')->name('assign_subject.edit');
        Route::post('/assign/subject/update/{class_id}', 'assignSubjectUpdate')->name('assign_subject.update');
        Route::get('/assign/subject/delete/{id}', 'assignSubjectDestroy')->name('assign_subject.delete');
        Route::get('/assign/subject/classes/list/pdf', 'assignClassSubjectListPDF')->name('assign_subject_classes.pdf');
        Route::get('/assign/subject/class/del/{class_id}', 'assignSubjectClassDelete')->name('assign_subject_class.delete');
    });

    // Designation
    Route::controller(DesignationController::class)->group(function (){
        Route::get('/designation/view', 'designationView')->name('designation.view');
        Route::post('/designation/store', 'designationStore')->name('designation.store');
        Route::get('/designation/edit/{id}', 'designationEdit')->name('designation.edit');
        Route::post('/designation/update/{id}', 'designationUpdate')->name('designation.update');
        Route::get('/designation/delete/{id}', 'designationDestroy')->name('designation.delete');
    });

    // Student Registration


});

Route::prefix('students')->middleware('admin')->group(function (){
    Route::controller(StudentRegistrationController::class)->group(function (){
        Route::get('/view/all', 'AllStudentView')->name('student.all.view');
        Route::get('/view/search', 'stentClassYearWise')->name('student.search');
        Route::get('/registration/student/new', 'StudentRegistration')->name('student.registration');
        Route::post('/registration/student/store', 'registrationStore')->name('student.regi.store');
        Route::get('/registration/student/edit/{id}', 'StudentRegistrationEdit')->name('student.regi.edit');
        Route::post('/registration/student/edit/{id}', 'StudentRegistrationUpdate')->name('student.regi.update');
        Route::get('/detail/student/{id}', 'StudentDetailGetByID')->name('student.detail.get');
        Route::get('/detail/student/pdf/{id}', 'PDFStudentDetailGetByID')->name('student.detail.pdf');
        Route::get('/detail/student/download/{id}', 'downloadStudentPDF')->name('student.detail.download');
        Route::get('/delete/student/{year_id}/{class_id}/{student_id}', 'regiStudentDestroy')->name('registudent.delete');
        Route::get('/promote/student/{student_id}', 'studentPromotionView')->name('student.promotion');
        Route::post('/promote/student/{student_id}', 'studentPromotionUpdate')->name('student.promotion.update');
    });


    Route::controller(RollController::class)->group(function (){
        Route::get('/roll/generate', 'RoleGenerateView')->name('role.generate.view');
        Route::get('/roll/search', 'RoleGenerateSearch')->name('role.generate.search');
        Route::post('/roll/generate', 'RoleGenerateStore')->name('role.generate.store');
    });


 //   Route::controller(RegistrationFeeController::class)->group(function (){
//        Route::get('/registration/fees', 'RegistrationFeeSearchView')->name('regifee.view');
//        Route::get('/registration/fee', 'RegistrationFeeGetting')->name('registration.fee.getting');
//        Route::get('/registration/{year}/{class}/{student_id}', 'PaySlipPDF')->name('registration.pay.slip');

  //  });

});


Route::prefix('fees')->middleware('admin')->group(function (){
    Route::controller(RegistrationFeeController::class)->group(function (){
        Route::get('/registration/fees/', 'RegiFeeView')->name('regi.fees.view');
        Route::get('/registration/add/', 'RegiFeeAdd')->name('regi.fees.add');
        Route::post('/registration/add/', 'RegistrationFeeStore')->name('regi.fees.store');
        Route::get('/registration/year/fee/{student_year_id}', 'RegistrationFeeEdit')->name('regi.fees.edit');
        Route::post('/registration/year/fee/{student_year_id}', 'RegistrationFeeUpdate')->name('regi.fees.update');
        Route::get('/registration/year/fee/{student_year_id}/details', 'RegistrationFeeDetails')->name('regi.fees.details');
        Route::get('/registration/year/{student_year_id}/class/{student_class_id}', 'regiDelByYearClassId')->name('regiDelbyYearClassId');
        Route::get('/registration/year/{student_year_id}/pdf', 'RegistrationFeeYearWisePDF')->name('RegYearwisePDF');
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




