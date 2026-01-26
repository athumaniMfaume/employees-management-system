<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


Route::fallback(function () {
    return view('404');
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is working!";
    } catch (\Exception $e) {
        return "Database connection failed: " . $e->getMessage();
    }
});




 Route::get('/employee/salary/{id}/pdf', [SalaryController::class, 'generatePDF'])->name('employee.salary.pdf');
Route::group(['middleware' => 'employee'], function () {

    Route::get('/my-salary', [SalaryController::class, 'mySalary'])->name('mySalary');
    Route::get('/employees/dashboard', [EmployeeController::class, 'employees_dashboard'])->name('employees.dashboard');
    Route::get('/employees/profile', [EmployeeController::class, 'employees_profile'])->name('employees.profile');
    Route::get('/employees/profile/{employee}/edit', [EmployeeController::class, 'employees_profile_edit'])->name('employees.profile.edit');
    Route::put('/employees/profile/{employee}/update', [EmployeeController::class, 'employees_profile_update'])->name('employees.profile.update');
    Route::get('complain/create', [ComplainController::class, 'create'])->name('complain.create');
    Route::get('complain/view', [ComplainController::class, 'view'])->name('complain.view');
    Route::get('complain/single/employee/view', [ComplainController::class, 'single_employee_complain_view'])->name('single.employee.complain.view');
    Route::post('/complain/store', [ComplainController::class, 'store'])->name('complain.store');
    Route::get('/complain/{complain}/edit', [ComplainController::class, 'edit'])
    ->name('complain.edit');
     Route::put('/complain/{complain}/update', [ComplainController::class, 'update'])->name('complain.update');
      Route::delete('/complain/{complain}', [ComplainController::class, 'destroy'])->name('complain.destroy');


    Route::get('leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::get('leaves/view', [LeaveController::class, 'view'])->name('leaves.view');
    Route::get('leaves/single/employee/view', [LeaveController::class, 'single_employee_leave_view'])->name('single.employee.leaves.view');
    Route::post('leaves/store', [LeaveController::class, 'store'])->name('leaves.store');
    Route::get('/leaves/{leaves}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
     Route::put('/leaves/{leaves}/update', [LeaveController::class, 'update'])->name('leaves.update');
      Route::delete('/leaves/{leaves}', [LeaveController::class, 'destroy'])->name('leaves.destroy');

});

Route::group(['middleware' => 'user'], function () {
    Route::get('/admin/departments/pdf', [PdfController::class, 'department_pdf'])->name('admin.department.pdf');
    Route::get('/admin/employees/pdf', [PdfController::class, 'employee_pdf'])->name('admin.employee.all.pdf');
    Route::get('/admin/employees/{id}/pdf', [PdfController::class, 'single_employee_pdf'])->name('admin.single.employee.all.pdf');
    Route::get('/admin/salary/pdf', [SalaryController::class, 'allSalaryPDF'])->name('admin.salary.pdf');

    // Payroll routes
Route::get('/admin/salaries', [SalaryController::class, 'index'])->name('salaries.index');
Route::get('/admin/salaries/create', [SalaryController::class, 'create'])->name('salaries.create');
Route::post('/admin/salaries', [SalaryController::class, 'store'])->name('salaries.store');

Route::get('/admin/salaries/{id}', [SalaryController::class, 'show'])->name('salaries.show');
Route::get('/admin/salaries/{id}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
Route::put('/admin/salaries/{id}', [SalaryController::class, 'update'])->name('salaries.update');
Route::delete('/admin/salaries/{id}', [SalaryController::class, 'destroy'])->name('salaries.destroy');


    Route::get('/admin/profile', [AdminController::class, 'admin_profile'])->name('admin.profile');

    Route::get('/admin/profile/{user}/edit', [AdminController::class, 'admin_profile_edit'])->name('admin.profile.edit');

    Route::put('/admin/profile/{user}/update', [AdminController::class, 'admin_profile_update'])->name('admin.profile.update');


     Route::get('/admin/complain/show', [AdminController::class, 'show_complain'])->name('complain.show');

    Route::get('/admin/complain/{complain}/approve', [AdminController::class, 'approve_complain'])->name('complain.approve');

    Route::put('/admin/complain/{complain}/approve_complain_post', [AdminController::class, 'approve_complain_post'])->name('approve_complain_post');


    Route::get('/admin/leave/show', [AdminController::class, 'show_leave'])->name('leave.show');

    Route::get('/admin/leave/{leave}/approve', [AdminController::class, 'approve_leave'])->name('leave.approve');

    Route::put('/admin/leave/{leave}/approve_leave_post', [AdminController::class,
        'approve_leave_post'])->name('approve_leave_post');


    Route::get('/admin/employees/view', [AdminController::class, 'view_employees'])->name('employees.view');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/employees/create', [AdminController::class, 'create_employees'])->name('employees.create');
    Route::post('/admin/employees/store', [AdminController::class, 'store_employee'])->name('employees.store');

     Route::get('/admin/employees/{employee}/show', [AdminController::class, 'single_view_employees'])->name('single.employees');

    Route::get('/admin/employees/{employee}/edit', [AdminController::class, 'edit_employee'])->name('employees.edit');
    Route::put('/admin/employees/{employee}/update', [AdminController::class, 'update_employee'])->name('employees.update');
    Route::delete('/admin/employees/{employee}', [AdminController::class, 'destroy_employee'])->name('employees.destroy');


    Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/admin/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/admin/departments/index', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/admin/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/admin/departments/{department}/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

});





Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/post', [AuthController::class, 'registerPost'])->name('registerPost');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'loginPost'])->name('loginPost');



    // Routes for authorized users to change their password
    Route::get('/change_password', [AuthController::class, 'change_password'])->name('change_password');
    Route::post('/change_password/post', [AuthController::class, 'change_password_post'])->name('change_password_post');

    Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.forgot');
    Route::post('forgot-password/post', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

    // Route for logging out (authenticated users)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
