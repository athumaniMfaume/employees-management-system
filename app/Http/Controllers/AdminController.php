<?php

namespace App\Http\Controllers;

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

class AdminController extends Controller
{
    protected $employeeService;
     protected $userService;
     protected $approveComplainService;
       protected $approveLeaveService;

public function __construct(
    ApproveLeaveService $approveLeaveService,  // Updated this line
    ApproveComplainService $approveComplainService, 
    EmployeeService $employeeService, 
    UserService $userService
) {
    $this->approveLeaveService = $approveLeaveService; // Correct variable name
    $this->approveComplainService = $approveComplainService;
    $this->employeeService = $employeeService;
    $this->userService = $userService;
}

    public function dashboard()
    {
        $leave = Leave::count();
        $complain = Complain::count();
        $deps = Department::count();
        $emp = Employee::count();
        return view('admin.index', compact('deps', 'emp', 'leave', 'complain'));
    }

    public function create_employees()
    {
        $deps = Department::all();
        return view('admin.employees.create', compact('deps'));
    }

    public function store_employee(StoreEmployeeRequest $request)
    {
        $this->employeeService->createEmployee($request->validated());
        return redirect()->route('employees.view')->with('success', 'Employee Added Successfully!');
    }

    public function edit_employee(Employee $employee)
    {
        $deps = Department::all();
        return view('admin.employees.edit', compact('employee', 'deps'));
    }

    public function update_employee(UpdateEmployeeRequest $request, Employee $employee)
    {
        // dd($request->validated()); 
        $this->employeeService->updateEmployee($request->validated(), $employee);
          // dd($request->all());

        return redirect()->route('employees.view')->with('success', 'Employee Updated Successfully!');
    }

    public function destroy_employee(Employee $employee)
    {
        $this->employeeService->deleteEmployee($employee);
        return redirect()->back()->with('success', 'Employee Deleted Successfully!');
    }

    public function view_employees()
    {
        $datas = Employee::with('departments')->get();
        return view('admin.employees.index', compact('datas'));
    }

    public function single_view_employees(Employee $employee)
    {
        // dd($employee);
        // dd($employee->name);
        return view('admin.employees.show', compact('employee'));
    }

    public function admin_profile()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

  public function admin_profile_edit(User $user)
    {
     
        return view('admin.profile.edit',compact('user'));
    }

        public function admin_profile_update(UpdateUserRequest $request, $user)
    {
        // Validate request through the Form Request
        $validated = $request->validated();

        // Find user
        $data = User::findOrFail($user);

        // Call service to update user
        if ($this->userService->updateUser($data, $validated)) {
            return redirect()->route('admin.profile')->with('success', 'Admin Info Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Error, Please Try Again Later!');
        }
    }



   public function show_complain()
    {
        $datas = Complain::all();
        return view('admin.complaints.index',compact('datas'));
    }

    public function show_leave()
    {
        $datas = Leave::all();
        return view('admin.leave.index',compact('datas'));
    }

      public function approve_complain( $complain)
    {
        $datas = Complain::findOrFail($complain);
        return view('admin.complaints.approve',compact('datas'));
    }

      public function approve_leave( $leave)
    {
        $datas = Leave::findOrFail($leave);
        return view('admin.leave.approve',compact('datas'));
    }

      // Approve complain post
    public function approve_complain_post(ApproveComplainRequest $request, $complain)
    {
        // Validate the request using the ApproveComplainRequest class
        $data = $request->validated(); // Get the validated data

        // Find the complain by ID
        $complain = Complain::findOrFail($complain);

        // Call the service method to update the complain
        if ($this->approveComplainService->updateComplain($complain, $data)) {
            return redirect()->route('complain.show')->with('success', 'Complain Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Error, Please Try Again Later!');
        }
    }

       public function approve_leave_post(ApproveLeaveRequest $request, $leave)
    {
        // Call the service to update the leave
        $data = $request->validated();

        $success = $this->approveLeaveService->approveLeave($leave, $data);

        if ($success) {
            return redirect()->route('leave.show')->with('success', 'Leave Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Error, Please Try Again Later!');
        }
    }

}
