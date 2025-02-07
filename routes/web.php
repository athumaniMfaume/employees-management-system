<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;



Route::post('leaves/{id}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');

Route::resource('complaints', ComplainController::class)->only(['store']);
Route::post('complaints/{id}/resolve', [ComplainController::class, 'resolve'])->name('complaints.resolve');

Route::group(['middleware' => 'employee'], function () {
    Route::get('leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('leaves/store', [LeaveController::class, 'store'])->name('leaves.store');

});

Route::group(['middleware' => 'user'], function () {
    

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

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/change_password', [AuthController::class, 'change_password'])->name('change_password');
    Route::post('/change_password/post', [AuthController::class, 'change_password_post'])->name('change_password_post');

    
    
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/post', [AuthController::class, 'registerPost'])->name('registerPost');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'loginPost'])->name('loginPost');

