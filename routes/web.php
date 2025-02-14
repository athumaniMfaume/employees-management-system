<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;



Route::post('leaves/{id}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');



Route::group(['middleware' => 'employee'], function () {
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

     Route::get('/complain/show', [EmployeeController::class, 'show_complain'])->name('complain.show');

    Route::get('/complain/{complain}/approve', [EmployeeController::class, 'approve_complain'])->name('complain.approve');

    Route::put('/complain/{complain}/approve_complain_post', [EmployeeController::class, 'approve_complain_post'])->name('approve_complain_post');


    Route::get('/leave/show', [EmployeeController::class, 'show_leave'])->name('leave.show');

    Route::get('/leave/{leave}/approve', [EmployeeController::class, 'approve_leave'])->name('leave.approve');

    Route::put('/leave/{leave}/approve_leave_post', [EmployeeController::class, 
        'approve_leave_post'])->name('approve_leave_post');
    

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/show', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}/update', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');


    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/show', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/departments/{departments}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/{departments}/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{departments}', [DepartmentController::class, 'destroy'])->name('departments.destroy');



    
    
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/post', [AuthController::class, 'registerPost'])->name('registerPost');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'loginPost'])->name('loginPost');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/change_password', [AuthController::class, 'change_password'])->name('change_password');
    Route::post('/change_password/post', [AuthController::class, 'change_password_post'])->name('change_password_post');

