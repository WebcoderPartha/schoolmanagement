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
//use App\Http\Controllers\Backend\Setup\FeeCategoryController;
//use App\Http\Controllers\Backend\Setup\FeeCategoryAmountController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Student\StudentRegistrationController;
use App\Http\Controllers\Backend\Student\RollController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\RegistrationPayController;
use App\Http\Controllers\Backend\ManageFee\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeePayController;
use App\Http\Controllers\Backend\ManageFee\ExamFeeController;
use App\Http\Controllers\Backend\Student\PayExamFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeRegisterController;
use App\Http\Controllers\Backend\Employee\SalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Mark\MarkController;
use App\Http\Controllers\Backend\Mark\MarksGradeController;
use App\Http\Controllers\Backend\Accounts\AccountStudentFeeController;
use App\Http\Controllers\Backend\Accounts\AccountEmployeeSalaryController;
use App\Http\Controllers\Backend\Accunts\AccountOtherCostController;
use App\Http\Controllers\Backend\ManageReport\ProfitReportController;
use App\Http\Controllers\Backend\ManageReport\StudentMarkSheetController;
use App\Http\Controllers\Backend\ManageReport\EmployeeAttendantReport;
use App\Http\Controllers\Backend\ManageReport\ResultReportController;




// Prevent Logout Back Button Browse Cache
Route::group(['middleware' => 'prevent-back-history'],function() {


    Route::controller(AdminController::class)->middleware('admin')->group(function () {
        Route::get('/dashboard', 'Dashboard')->name('dashboard');
        Route::get('/logout', 'Logout')->name('logout');
    });

    Route::controller(RoleController::class)->middleware('admin')->group(function () {
        Route::get('/role', 'index')->name('role.index');
        Route::get('/role/create', 'create')->name('role.create');
        Route::post('/role/store', 'store')->name('role.store');
        Route::get('/role/edit/{id}', 'edit')->name('role.edit');
        Route::post('/role/update/{id}', 'update')->name('role.update');
        Route::get('/role/delete/{id}', 'destroy')->name('role.delete');
        Route::get('/role/view/', 'pdfGen')->name('pdf');
    });
    Route::prefix('users')->controller(UserController::class)->middleware('admin')->group(function () {
        Route::get('/list-view', 'index')->name('user.index');
        Route::get('/user/add', 'create')->name('user.create');
        Route::post('/user/store', 'store')->name('user.store');
        Route::get('/user/edit/{id}', 'edit')->name('user.edit');
        Route::post('/user/update/{id}', 'update')->name('user.update');
        Route::get('/user/delete/{id}', 'destroy')->name('user.delete');
    });

    Route::prefix('setups')->middleware('admin')->group(function () {

        Route::controller(StudentClassController::class)->group(function () {

            // Student Classes
            Route::get('/student/class-list', 'StudentClassView')->name('student.class.view');
            Route::post('/student/class/store', 'StudentClassStore')->name('student.class.store');
            Route::get('/student/class/edit/{id}', 'StudentClassEdit')->name('student.class.edit');
            Route::post('/student/class/update/{id}', 'StudentClassUpdate')->name('student.class.update');
            Route::get('/student/class/delete/{id}', 'StudentClassDestroy')->name('student.class.delete');
        });

        // Student Year
        Route::controller(StudentYearController::class)->group(function () {
            Route::get('/student/year-list', 'StudentYearView')->name('student.year.view');
            Route::post('/student/year/store', 'StudentYearStore')->name('student.year.store');
            Route::get('/student/year/edit/{id}', 'StudentYearEdit')->name('student.year.edit');
            Route::post('/student/year/update/{id}', 'StudentYearUpdate')->name('student.year.update');
            Route::get('/student/year/delete/{id}', 'StudentYearDestroy')->name('student.year.delete');
        });

        // Student Group
        Route::controller(StudentGroupController::class)->group(function () {
            Route::get('/student/group-list', 'StudentGroupView')->name('student.group.view');
            Route::post('/student/group/store', 'StudentGroupStore')->name('student.group.store');
            Route::get('/student/group/edit/{id}', 'StudentGroupEdit')->name('student.group.edit');
            Route::post('/student/group/update/{id}', 'StudentGroupUpdate')->name('student.group.update');
            Route::get('/student/group/delete/{id}', 'StudentGroupDestroy')->name('student.group.delete');
        });

        // Student Shift
        Route::controller(StudentShiftController::class)->group(function () {
            Route::get('/student/shift-view', 'StudentShiftView')->name('student.shift.view');
            Route::post('/student/shift/store', 'StudentShiftStore')->name('student.shift.store');
            Route::get('/student/shift/edit/{id}', 'StudentShiftEdit')->name('student.shift.edit');
            Route::post('/student/shift/update/{id}', 'StudentShiftUpdate')->name('student.shift.update');
            Route::get('/student/shift/delete/{id}', 'StudentShiftDestroy')->name('student.shift.delete');
        });

//    // Student Fee Category
//    Route::controller(FeeCategoryController::class)->group(function (){
//        Route::get('/student/fee/category-list', 'StudentFeeCategoryView')->name('student.fcategory.view');
//        Route::post('/student/fee/category/store', 'StudentFeeCategoryStore')->name('student.fcategory.store');
//        Route::get('/student/fee/category/edit/{id}', 'StudentFeeCategoryEdit')->name('student.fcategory.edit');
//        Route::post('/student/fee/category/update/{id}', 'StudentFeeCategoryUpdate')->name('student.fcategory.update');
//        Route::get('/student/fee/category/delete/{id}', 'StudentFeeCategoryDestroy')->name('student.fcategory.delete');
//    });


//
//    // Student Fee Category Amount
//    Route::controller(FeeCategoryAmountController::class)->group(function (){
//        Route::get('/student/fee/amount-list', 'StudentFeeCategoryAmountView')->name('student.fcamount.view');
//        Route::post('/student/fee/amount/store', 'StudentFeeCategoryAmountStore')->name('student.fcamount.store');
//        Route::get('/student/fee/amount/new', 'StudentFeeCategoryAmountCreate')->name('student.fcamount.add');
//        Route::get('/student/fee/amount/edit/{fee_category_id}', 'StudentFeeCategoryAmountEdit')->name('student.fcamount.edit');
//        Route::post('/student/fee/amount/update/{fee_category_id}', 'StudentFeeCategoryAmountUpdate')->name('student.fcamount.update');
//        Route::get('/student/fee/amount/delete/{fee_category_id}', 'StudentFeeCategoryAmountDestroy')->name('student.fcamount.delete');
//        Route::get('/student/fee/amount/single/{id}', 'FeeAmountDeleteSingle')->name('student.fcamount.single.del');
//        Route::get('/student/fee/amount/details/{fee_category_id}', 'FeeAmountDetails')->name('student.fcamount.details');
//        Route::get('/student/fee/amount/pdf/{fee_category_id}', 'FeeAmountDetailsPDF')->name('student.fcamount.pdf');
//    });

        // Exam Type
        Route::controller(ExamTypeController::class)->group(function () {
            Route::get('/exam/type-list', 'ExamTypeView')->name('exam_type.view');
            Route::post('/exam/type/store', 'ExamTypeStore')->name('exam_type.store');
            Route::get('/exam/type/edit/{id}', 'ExamTypeEdit')->name('exam_type.edit');
            Route::post('/exam/type/update/{id}', 'ExamTypeUpdate')->name('exam_type.update');
            Route::get('/exam/type/delete/{id}', 'ExamTypeDestroy')->name('exam_type.delete');
        });

        // School Subject
        Route::controller(SchoolSubjectController::class)->group(function () {
            Route::get('/school/subject-list', 'SchoolSubjectView')->name('school_subject.view');
            Route::post('/school/subject/store', 'SchoolSubjectStore')->name('school_subject.store');
            Route::get('/school/subject/edit/{id}', 'SchoolSubjectEdit')->name('school_subject.edit');
            Route::post('/school/subject/update/{id}', 'SchoolSubjectUpdate')->name('school_subject.update');
            Route::get('/school/subject/delete/{id}', 'SchoolSubjectDestroy')->name('school_subject.delete');
        });

        // Assign Subject
        Route::controller(AssignSubjectController::class)->group(function () {
            Route::get('/assign/subject-list', 'assignSubjectView')->name('assign_subject.view');
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
        Route::controller(DesignationController::class)->group(function () {
            Route::get('/designation-list', 'designationView')->name('designation.view');
            Route::post('/designation/store', 'designationStore')->name('designation.store');
            Route::get('/designation/edit/{id}', 'designationEdit')->name('designation.edit');
            Route::post('/designation/update/{id}', 'designationUpdate')->name('designation.update');
            Route::get('/designation/delete/{id}', 'designationDestroy')->name('designation.delete');
        });

        // Student Registration


    });

    Route::prefix('students')->middleware('admin')->group(function () {

        // Student Registration
        Route::controller(StudentRegistrationController::class)->group(function () {
            Route::get('/view-all', 'AllStudentView')->name('student.all.view');
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

        // Roll Generator
        Route::controller(RollController::class)->group(function () {
            Route::get('/roll-generate', 'RoleGenerateView')->name('role.generate.view');
            Route::get('/roll/search', 'RoleGenerateSearch')->name('role.generate.search');
            Route::post('/roll/generate', 'RoleGenerateStore')->name('role.generate.store');
        });


        // Pay Registration Fee
        Route::controller(RegistrationPayController::class)->group(function () {
            Route::get('/registration-pay-fees', 'RegistrationFeeSearchView')->name('payRegistration_view');
            Route::get('/registration/fee/pay', 'RegistrationFeeGetting')->name('payRegistrationFee.search');
            Route::get('/registration/{year_id}/{class_id}/{student_id}/pay', 'PaySlipPDF')->name('registration.pay.slip');

        });

        // Pay Monthly Fee
        Route::controller(MonthlyFeePayController::class)->group(function () {
            Route::get('/monthly-fees', 'MonthlyFeeSearchView')->name('payMonthlyFee_view');
            Route::get('/monthly/fee/pay', 'payMonthlyFeeSearch')->name('payMonthlyFee.search');
            Route::get('/monthly/{year_id}/{month_id}/{class_id}/{student_id}/pay', 'payMonthlyFeePDF')->name('payMonthlyFee.pay.slip');

        });

        // Pay Exam Fee
        Route::controller(PayExamFeeController::class)->group(function () {
            Route::get('/exam/fee-view', 'ExamFeeSearchView')->name('payExamFee_view');
            Route::get('/exam/fee-pay', 'payExamFeeSearch')->name('payExamFee.search');
            Route::get('/exam/{year_id}/{exam_type_id}/{class_id}/{student_id}/pay', 'payExamFeePDF')->name('payExamFee.pay.slip');

        });

    });


    Route::prefix('fees')->middleware('admin')->group(function () {

        // Registration Fee
        Route::controller(RegistrationFeeController::class)->group(function () {
            Route::get('/registration-fees/', 'RegiFeeView')->name('regi.fees.view');
            Route::get('/registration/add/', 'RegiFeeAdd')->name('regi.fees.add');
            Route::post('/registration/add/', 'RegistrationFeeStore')->name('regi.fees.store');
            Route::get('/registration/year/fee/{student_year_id}', 'RegistrationFeeEdit')->name('regi.fees.edit');
            Route::post('/registration/year/fee/{student_year_id}', 'RegistrationFeeUpdate')->name('regi.fees.update');
            Route::get('/registration/year/fee/{student_year_id}/details', 'RegistrationFeeDetails')->name('regi.fees.details');
            Route::get('/registration/year/{student_year_id}/class/{student_class_id}', 'regiDelByYearClassId')->name('regiDelbyYearClassId');
            Route::get('/registration/year/{student_year_id}/pdf', 'RegistrationFeeYearWisePDF')->name('RegYearwisePDF');
        });

        // Monthly Fee
        Route::controller(MonthlyFeeController::class)->group(function () {
            Route::get('/monthly/feelist/', 'MonthlyFeeView')->name('monthly.fees.view');
            Route::get('/monthly/assign/', 'monthlyFeeAdd')->name('monthly.fees.add');
            Route::post('/monthly/assign/store', 'monthlyFeeStore')->name('monthly.fees.store');
            Route::get('/monthly/assign/{student_year_id}/{month_id}', 'monthlyFeeEdit')->name('monthly.fees.edit');
            Route::post('/monthly/assign/{student_year_id}/{month_id}', 'monthlyFeeUpdate')->name('monthly.fees.update');
            Route::get('/monthly/details/{student_year_id}/{month_id}', 'monthlyFeeDetails')->name('monthly.fees.details');
            Route::get('/monthly/fee/{student_year_id}/{month_id}/{student_class_id}', 'monthlyFeeDelete')->name('monthlyFeeDel');
            Route::get('/monthly/pdf/{student_year_id}/{month_id}', 'monthlyFeesWisePDF')->name('monthly.fee.wise.pdf');
        });

        // Monthly Fee
        Route::controller(ExamFeeController::class)->group(function () {
            Route::get('/exam/fee-list/', 'ExamFeeView')->name('exam.fees.view');
            Route::get('/exam/assign/', 'ExamFeeAdd')->name('exam.fees.add');
            Route::post('/exam/assign/store', 'ExamFeeStore')->name('exam.fees.store');
            Route::get('/exam/assign/{year_id}/{exam_type_id}', 'ExamFeeEdit')->name('exam.fees.edit');
            Route::post('/exam/assign/{year_id}/{exam_type_id}', 'ExamFeeUpdate')->name('exam.fees.update');
            Route::get('/exam/details/{year_id}/{exam_type_id}', 'ExamFeeDetails')->name('exam.fees.details');
            Route::get('/exam/fee/{year_id}/{exam_type_id}/{class_id}', 'ExamFeeDelete')->name('examFeeDel');
            Route::get('/exam/pdf/{year_id}/{exam_type_id}', 'examFeesWisePDF')->name('exam.fee.wise.pdf');
        });


    });


    Route::controller(ProfileSettingController::class)->middleware('admin')->group(function () {
        Route::get('/profile/settings', 'index')->name('profile.setting');
        Route::post('/profile/update', 'updateProfile')->name('profile.update');
        Route::post('/profile/update-password', 'updatePassword')->name('profile.update.password');
    });


    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'Login')->name('login');
        Route::post('/', 'LoginAttempt')->name('login.attempt');
        Route::get('/register', 'Register')->name('register');
        Route::post('/register', 'RegisterAttempt')->name('register.post');
    });


// Employee Management
    Route::prefix('employees')->middleware('admin')->group(function () {

        Route::controller(EmployeeRegisterController::class)->group(function () {
            Route::get('/view-employees', 'EmployeeViews')->name('employees.view');
            Route::get('/register/employee', 'RegisterEmployee')->name('employees.register');
            Route::post('/register/employee', 'RegisterEmployeeStore')->name('employee.register.store');
            Route::get('/register/employee/{id_number}/edit', 'EmployeeEdit')->name('employee.edit');
            Route::post('/register/employee/{id_number}/edit', 'EmployeeUpdate')->name('employee.update');
            Route::get('/register/employee/{id_number}/delete', 'EmployeeDelete')->name('employee.delete');
            Route::get('/detail/employee/{id_number}', 'EmployeeDetail')->name('employee.detail');
            Route::get('/detail/employee/{id_number}/idCard', 'EmployeeIDCard')->name('employee.idCard');
        });

        Route::controller(SalaryController::class)->group(function () {

            Route::get('/view-salaries', 'SalaryViews')->name('employees.salary_view');
            Route::get('/salary-increment/employee/{id}', 'SalaryIncrement')->name('employee.salary_increment');
            Route::post('/salary-increment/employee/{id}', 'SalaryIncrementStore')->name('employee.salary_increment_store');
            Route::get('/salary/employee/{id}', 'EmployeeSalaryDetail')->name('employee.salary_detail');
            Route::get('/salary/employee/{id}/pdf', 'EmployeeSalaryPDF')->name('employee.salary_pdf');
            Route::get('/salary/employee/{id}/pdf/download', 'EmployeeSalaryPDFDownload')->name('employee.salary_pdf_download');

        });

        Route::controller(EmployeeLeaveController::class)->group(function () {

            Route::get('/leave-view', 'EmployeeLeaveView')->name('employees.leave_view');
            Route::get('/leave/add', 'EmployeeLeaveAdd')->name('employee.leave_add');
            Route::post('/leave/store', 'EmployeeLeaveStore')->name('employee.leave_store');
            Route::get('/leave/edit/{employee_id}', 'EmployeeLeaveEdit')->name('employee.leave_edit');
            Route::post('/leave/edit/{employee_id}', 'EmployeeLeaveUpdate')->name('employee.leave_update');
            Route::get('/leave/delete/{employee_id}', 'EmployeeLeaveDelete')->name('employee.leave_delete');

        });

        Route::controller(EmployeeAttendanceController::class)->group(function () {

            Route::get('/attendance-view', 'EmployeeAttendanceView')->name('employees.attendance_view');
            Route::get('/add-attendance', 'AddEmployeeAttendance')->name('employee.attendance_add');
            Route::post('/add-attendance', 'StoreEmployeeAttendance')->name('employee.attendance_store');
            Route::get('/edit-attendance/{date}', 'EditEmployeeAttendance')->name('employee.attendance_edit');
            Route::post('/update-attendance/{date}', 'UpdateEmployeeAttendance')->name('employee.attendance_update');
            Route::get('/attendance-detail/{date}', 'DetailEmployeeAttendance')->name('employee.attendance_detail');

        });

        Route::controller(MonthlySalaryController::class)->group(function () {

            Route::get('/monthly-salary', 'MonthlySalaryView')->name('employees.monthlySalary_view');
            Route::get('/search/monthly-salary', 'SearchMonthlySalary')->name('employees.monthlySalary_search');
            Route::get('/pay/salary/{date}/employee/{employee_id}', 'MonthlySalaryPaySlip')->name('employees.paySlipmonthlySalary_search');

        });

    });

    Route::prefix('marks')->middleware('admin')->group(function () {

        Route::controller(MarkController::class)->group(function () {
            Route::get('mark-entry', 'MarkView')->name('mark.view');
            Route::get('mark-subject', 'ClassSubjectGet')->name('mark.class.subject');
            Route::get('mark-student', 'GetAssignStudent')->name('assignStudentGet');
            Route::post('mark-store', 'AssignStudentMarkStore')->name('marks.store');
            Route::get('mark-edit', 'MarkEdit')->name('marks.edit');
            Route::get('/geteditmarks', 'GetEditMarks')->name('marks.edit.get');
            Route::post('/mark-update', 'MarkUpdate')->name('marks.update');
        });

        Route::controller(MarksGradeController::class)->group(function () {
            Route::get('grade-view', 'GradeView')->name('grade.view.all');
            Route::get('grade-add', 'GradeAdd')->name('grades.add');
            Route::post('grade-store', 'GradeStore')->name('grades.store');
            Route::get('grade-edit/{id}', 'GradeEdit')->name('grades.edit');
            Route::post('grade-update/{id}', 'GradeUpdate')->name('grades.update');
            Route::get('grade-delete/{id}', 'GradeDelete')->name('grades.delete');
        });

    });


    Route::prefix('accounts')->middleware('admin')->group(function () {

        // Student All Fees
        Route::controller(AccountStudentFeeController::class)->group(function () {
            Route::get('/students-fee', 'AccountStudentFeeView')->name('accounts.student_fee_view');
            Route::get('/add-student-fee', 'addStudentFees')->name('accounts.student_fee_add');
            Route::get('/search/student-fee', 'SearchStudentFee')->name('accounts.student.search');
            Route::post('/student-fee/store', 'StudentFeeStore')->name('accounts.student.store');
        });

        // Employee Salaries
        Route::controller(AccountEmployeeSalaryController::class)->group(function () {
            Route::get('/employee-salaries', 'AccountEmployeeSalariesView')->name('accounts.employee_salaries_view');
            Route::get('/add-employee-salary', 'AccountEmployeeSalariesAdd')->name('accounts.employee_salary_add');
            Route::get('/employee-salary/search', 'SearchEmployeeSalary')->name('accounts.employee_salary_search');
            Route::post('/employee-salary/store', 'StoreEmployeeSalary')->name('accounts.store_employee_salary');
        });

        // Other Cost
        Route::controller(AccountOtherCostController::class)->group(function () {
            Route::get('/other/cost-view', 'AccountOtherCostView')->name('accounts.other_cost_view');
            Route::post('/add-other-cost', 'AccountOtherCostStore')->name('accounts.other_cost_store');
            Route::get('/other-cost/edit/{id}', 'AccountOtherCostEdit')->name('accounts.other_cost_edit');
            Route::post('/other-cost/update/{id}', 'AccountOtherCostUpdate')->name('accounts.other_cost_update');
            Route::get('/delete/other-cost/{id}', 'AccountOtherCostDelete')->name('accounts.other_cost_delete');
        });


    });


// Manage Reports
    Route::prefix('reports')->middleware('admin')->group(function () {

        // Profit Reports
        Route::controller(ProfitReportController::class)->group(function () {
            Route::get('/profit-view', 'ProfitReportView')->name('reports.profit_view');
            Route::get('/profit/search', 'SearchProfitReport')->name('reports.profit_search');
            Route::get('/profit/pdf/{start_date}/{end_date}', 'PDFProfitReport')->name('reports.profit_pdf');
        });

        // Marksheet Reports
        Route::controller(StudentMarkSheetController::class)->group(function () {
            Route::get('/marksheet-generate', 'MarksheetGenerateView')->name('reports.marksheet_view');
            Route::get('/marksheet/generate/search', 'SearchMarksheet')->name('reports.marksheet_search');
            Route::get('/marksheet/generate/{year_id}/{class_id}/{exam_type_id}/{id_number}', 'DownloadMarksheetPDF')->name('reports.download_marksheet');
            Route::get('/marksheet/generate/{year_id}/{class_id}/{exam_type_id}/{id_number}/fail', 'DownloadFailMarksheetPDF')->name('reports.download_fail_marksheet');
        });

        // Employee Attendant Reports
        Route::controller(EmployeeAttendantReport::class)->group(function () {
            Route::get('/employee/attendant', 'EmployeeAttendantReport')->name('reports.employee_attendant');
            Route::get('/employee/attendant-view', 'EmployeeAttendantReportView')->name('reports.employee_attendant_view');

        });


        // Student Result Report
        Route::controller(ResultReportController::class)->group(function () {
            Route::get('/exam/results', 'ResultReport')->name('reports.result_report');
            Route::get('/exam/result/search', 'GetResultReport')->name('reports.get_result_report');

        });


    });

});








