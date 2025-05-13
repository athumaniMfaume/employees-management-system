<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ApproveComplainRequest;
use App\Services\ApproveComplainService;
use App\Http\Requests\ApproveLeaveRequest;
use App\Services\ApproveLeaveService;
use App\Services\EmployeeService;
use App\Services\UserService;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Leave;
use App\Models\Complain;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminApiController extends Controller
{
    protected $employeeService;
    protected $userService;
    protected $approveComplainService;
    protected $approveLeaveService;

    public function __construct(
        ApproveLeaveService $approveLeaveService,
        ApproveComplainService $approveComplainService,
        EmployeeService $employeeService,
        UserService $userService
    ) {
        $this->approveLeaveService = $approveLeaveService;
        $this->approveComplainService = $approveComplainService;
        $this->employeeService = $employeeService;
        $this->userService = $userService;
    }

    public function dashboard()
    {
        return response()->json([
            'departments' => Department::count(),
            'employees' => Employee::count(),
            'leaves' => Leave::count(),
            'complaints' => Complain::count(),
        ]);
    }

    public function store_employee(StoreEmployeeRequest $request)
    {
        $this->employeeService->createEmployee($request->validated());
        return response()->json(['message' => 'Employee Added Successfully!']);
    }

    public function update_employee(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->employeeService->updateEmployee($request->validated(), $employee);
        return response()->json(['message' => 'Employee Updated Successfully!']);
    }

    public function destroy_employee(Employee $employee)
    {
        $this->employeeService->deleteEmployee($employee);
        return response()->json(['message' => 'Employee Deleted Successfully!']);
    }

    public function view_employees()
    {
        $employees = Employee::with('departments')->get();
        return response()->json($employees);
    }

    public function single_view_employee(Employee $employee)
    {
        return response()->json($employee->load('departments'));
    }

    public function admin_profile()
    {
        return response()->json(Auth::user());
    }

    public function admin_profile_update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::findOrFail($id);

        if ($this->userService->updateUser($user, $validated)) {
            return response()->json(['message' => 'Admin Info Updated Successfully!']);
        } else {
            return response()->json(['error' => 'Error, Please Try Again Later!'], 500);
        }
    }

    public function show_complain()
    {
        return response()->json(Complain::all());
    }

    public function show_leave()
    {
        return response()->json(Leave::all());
    }

    public function approve_complain($id)
    {
        $complain = Complain::findOrFail($id);
        return response()->json($complain);
    }

    public function approve_leave($id)
    {
        $leave = Leave::findOrFail($id);
        return response()->json($leave);
    }

    public function approve_complain_post(ApproveComplainRequest $request, $id)
    {
        $data = $request->validated();
        $complain = Complain::findOrFail($id);

        if ($this->approveComplainService->updateComplain($complain, $data)) {
            return response()->json(['message' => 'Complain Updated Successfully!']);
        } else {
            return response()->json(['error' => 'Error, Please Try Again Later!'], 500);
        }
    }

    public function approve_leave_post(ApproveLeaveRequest $request, $id)
    {
        $data = $request->validated();
        $success = $this->approveLeaveService->approveLeave($id, $data);

        if ($success) {
            return response()->json(['message' => 'Leave Updated Successfully!']);
        } else {
            return response()->json(['error' => 'Error, Please Try Again Later!'], 500);
        }
    }
}
