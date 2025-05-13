<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeApiController;
use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\DepartmentApiController;
use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\Api\ComplainApiController;
use App\Http\Controllers\Api\LeaveApiController;

// Public or admin leaves


// Authenticated employee-only routes (use middleware if needed)
Route::middleware(['auth:sanctum', 'guard.token'])->group(function () { 
    Route::get('/leaves', [LeaveApiController::class, 'index']);
Route::get('/leaves/{id}', [LeaveApiController::class, 'show']);
    Route::get('/leaves', [LeaveApiController::class, 'employeeLeaves']);
    Route::post('/leaves', [LeaveApiController::class, 'store']);
    Route::put('/leaves/{id}', [LeaveApiController::class, 'update']);
    Route::delete('/leaves/{id}', [LeaveApiController::class, 'destroy']);
});


Route::middleware(['auth:sanctum', 'guard.token'])->group(function () { 
    Route::get('/employee/stats', [EmployeeApiController::class, 'stats']);
    Route::get('/employee/dashboard', [EmployeeApiController::class, 'employeeDashboard']);
    Route::get('/employee/profile', [EmployeeApiController::class, 'profile']);
    Route::put('/employee/profile/{id}', [EmployeeApiController::class, 'updateProfile']);

    Route::get('/employee/complains', [EmployeeApiController::class, 'showComplains']);
    Route::get('/employee/leaves', [EmployeeApiController::class, 'showLeaves']);

    Route::put('/employee/complains/{id}/approve', [EmployeeApiController::class, 'approveComplain']);
    Route::put('/employee/leaves/{id}/approve', [EmployeeApiController::class, 'approveLeave']);
});

Route::middleware(['auth:sanctum', 'guard.token'])->group(function () { 
    Route::get('/complains', [ComplainApiController::class, 'index']);
    Route::get('/complains/employee', [ComplainApiController::class, 'employeeComplains']);
    Route::post('/complains', [ComplainApiController::class, 'store']);
    Route::get('/complains/{id}', [ComplainApiController::class, 'show']);
    Route::put('/complains/{id}', [ComplainApiController::class, 'update']);
    Route::delete('/complains/{id}', [ComplainApiController::class, 'destroy']);
});


Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware(['auth:sanctum', 'guard.token'])->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::post('/change-password', [AuthApiController::class, 'change_password']);
});

Route::middleware(['auth:sanctum', 'guard.token'])->group(function () {    
    Route::get('/admin/dashboard', [AdminApiController::class, 'dashboard']);

    // Employees
    Route::get('/admin/employees', [AdminApiController::class, 'view_employees']);
    Route::post('/admin/employees', [AdminApiController::class, 'store_employee']);
    Route::get('/admin/employees/{employee}', [AdminApiController::class, 'single_view_employee']);
    Route::put('/admin/employees/{employee}', [AdminApiController::class, 'update_employee']);
    Route::delete('/admin/employees/{employee}', [AdminApiController::class, 'destroy_employee']);

    // Profile
    Route::get('/admin/profile', [AdminApiController::class, 'admin_profile']);
    Route::put('/admin/profile/{id}', [AdminApiController::class, 'admin_profile_update']);

    // Complaints
    Route::get('/admin/complaints', [AdminApiController::class, 'show_complain']);
    Route::get('/admin/complaints/{id}', [AdminApiController::class, 'approve_complain']);
    Route::post('/admin/complaints/{id}/approve', [AdminApiController::class, 'approve_complain_post']);

    // Leaves
    Route::get('/admin/leaves', [AdminApiController::class, 'show_leave']);
    Route::get('/admin/leaves/{id}', [AdminApiController::class, 'approve_leave']);
    Route::post('/admin/leaves/{id}/approve', [AdminApiController::class, 'approve_leave_post']);
});


// Define routes for the departments API with middleware for authentication
Route::middleware(['auth:sanctum', 'guard.token'])->prefix('departments')->group(function () {
    // Get all departments
    Route::get('/', [DepartmentApiController::class, 'index']);
    
    // Store a new department
    Route::post('/', [DepartmentApiController::class, 'store']);
    
    // Get a single department by ID
    Route::get('/{department}', [DepartmentApiController::class, 'show']);
    
    // Update an existing department by ID
    Route::put('/{department}', [DepartmentApiController::class, 'update']);
    
    // Delete a department by ID
    Route::delete('/{department}', [DepartmentApiController::class, 'destroy']);
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
