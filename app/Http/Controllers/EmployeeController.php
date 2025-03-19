<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Leave;
use App\Models\Complain;
use Illuminate\Http\Request;
use App\Mail\EmployeeCredentialsNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    protected $employeeService;

    // Inject EmployeeService
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }


    public function index()
    {
        $leave = Leave::all()->count();
        $complain = Complain::all()->count();
        $deps = Department::all()->count();
        $emp = Employee::all()->count();
        return view('index',compact('deps','emp','leave','complain'));
    }

    public function employees_dashboard()
    {
        $emp_id = Auth::guard('employee')->user()->id;
        $leave = Leave::where('employee_id',$emp_id)->count();
        $complain = Complain::where('employee_id',$emp_id)->count();
        $deps = Department::all()->count();
        $emp = Employee::all()->count();
        return view('employees.index',compact('deps','emp','leave','complain'));
    }



    public function employees_profile()
    {
        $emp_id = Auth::guard('employee')->user()->id;
        $leave = Leave::where('employee_id',$emp_id)->count();
        $complain = Complain::where('employee_id',$emp_id)->count();
        $emp = Employee::with('departments')->where('id',$emp_id)->get();
        $deps = Department::all()->count();
        return view('employees.profile.index',compact('deps','emp','leave','complain'));
    }



   

    public function employees_profile_edit( $employee)
    {
        $datas = Employee::with('departments')->findOrFail($employee);
        $deps = Department::all();
        return view('employees.profile.edit',compact('datas','deps'));
    }



        public function employees_profile_update(UpdateEmployeeRequest $request, $employeeId)
    {
        // Retrieve validated data from the request
        $data = $request->validated();

        // Find the employee by ID
        $employee = Employee::findOrFail($employeeId);

        // Use the EmployeeService to update the employee
        $this->employeeService->updateEmployee($data, $employee);

        // Redirect back with success message
        return redirect()->route('employees.profile')->with('success', 'Employee Updated Successfully!');
    }


    


    public function show_complain()
    {
        $datas = Complain::all();
        return view('show_complain',compact('datas'));
    }

    public function show_leave()
    {
        $datas = Leave::all();
        return view('show_leave',compact('datas'));
    }




     public function approve_complain_post(Request $request, $complain)
    {
          $request->validate([
            'subject' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
            'content' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
            'status' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
            
            
        ]);

        $data = Complain::findOrFail($complain);

        $data->subject = $request->subject;
        $data->content = $request->content;
        $data->status = $request->status;
      

        if ($data->update()) {
            return redirect()->route('complain.show')->with('success','Complain Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }

     public function approve_leave_post(Request $request, $leave)
    {
          $request->validate([
            'type' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
            'reason' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
            
            
        ]);

        $data = Leave::findOrFail($leave);

        $data->type = $request->type;
        $data->reason = $request->reason;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->status = $request->status;
      

        if ($data->update()) {
            return redirect()->route('leave.show')->with('success','Leave Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }

}
