<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     */
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
        return view('employees.employees_dashboard',compact('deps','emp','leave','complain'));
    }


    public function single_view_employees($employee)
    {
 
        $emp = Employee::with('departments')->where('id',$employee)->get();
        return view('single_view_employee',compact('emp'));
    }



    public function employees_profile()
    {
        $emp_id = Auth::guard('employee')->user()->id;
        $leave = Leave::where('employee_id',$emp_id)->count();
        $complain = Complain::where('employee_id',$emp_id)->count();
        $emp = Employee::with('departments')->where('id',$emp_id)->get();
        $deps = Department::all()->count();
        return view('employees.employees_profile',compact('deps','emp','leave','complain'));
    }

    public function admin_profile()
    {
        $emp_id = Auth::user()->id;
        $user = User::where('id',$emp_id)->get();
        return view('profile',compact('user'));
    }

    public function admin_profile_edit( $user)
    {
        $datas = User::findOrFail($user);
     
        return view('admin_profile_edit',compact('datas'));
    }

    public function admin_profile_update(Request $request, $user)
    {
        $request->validate([
            'name' => 'sometimes',
            'email' => 'sometimes|email',
        ]);

        $data = User::findOrFail($user);

        $data->name = $request->name;
        $data->email = $request->email;

        if ($data->update()) {
            return redirect()->route('admin.profile')->with('success','Admin Info Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }

    public function employees_profile_edit( $employee)
    {
        $datas = Employee::with('departments')->findOrFail($employee);
        $deps = Department::all();
        return view('employees.employees_profile_edit',compact('datas','deps'));
    }

     public function employees_profile_update(Request $request, $employee)
    {
        $request->validate([
            'name' => 'sometimes',
            'department_id' => 'sometimes',
            'position' => 'sometimes',
            'email' => 'sometimes|email',
            'image' => 'sometimes|mimes:jpg,jpeg,png,gif|max:10000',
            'phone' => 'sometimes',
            'dob' => 'sometimes',
            'salary' => 'sometimes',
        ]);

      

        $data = Employee::findOrFail($employee);

          $image = $request->image;
    if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move(public_path('/images'), $imagename);
            $data->image = $imagename;
        }

        $data->name = $request->name;
        $data->department_id = $request->department_id;
        $data->position = $request->position;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->dob = $request->dob;
        $data->salary = $request->salary;

        if ($data->update()) {
            return redirect()->route('employees.profile')->with('success','Employee Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
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


    public function approve_complain( $complain)
    {
        $datas = Complain::findOrFail($complain);
        return view('approve_complain',compact('datas'));
    }

      public function approve_leave( $leave)
    {
        $datas = Leave::findOrFail($leave);
        return view('approve_leave',compact('datas'));
    }

     public function approve_complain_post(Request $request, $complain)
    {
          $request->validate([
            'subject' => 'sometimes',
            'content' => 'sometimes',
            'status' => 'sometimes',
            
            
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
            'type' => 'sometimes',
            'reason' => 'sometimes',
            'start_date' => 'sometimes',
            'end_date' => 'sometimes',
            'status' => 'sometimes',
            
            
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deps = Department::all();
        return view('add_employee',compact('deps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'department_id' => 'required', 
        'position' => 'required',
        'email' => 'required|email|unique:employees,email',
        'phone' => 'required',
        'image' => 'sometimes|mimes:jpg,jpeg,png,gif|max:10000',
        'dob' => 'required',
        'salary' => 'required',
    ]);

    // Generate a password (you can also use a random password generator)
    $password = 123;

    // Create a new employee
    $data = new Employee();

    $image = $request->image;
    if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move(public_path('/images'), $imagename);
            $data->image = $imagename;
        }

    $data->name = $request->name;
    $data->department_id = $request->department_id;
    $data->position = $request->position;
    $data->email = $request->email;
    $data->password = Hash::make($password); // Save the password as hashed
    $data->phone = $request->phone;
    $data->dob = $request->dob;
    $data->salary = $request->salary;


    if ($data->save()) {
        // Send the email to the employee
         Mail::to($data->email)->send(new EmployeeCredentialsNotification($data->email, $password));

        return redirect()->route('employees.show')->with('success', 'Employee Added Successfully!');
    } else {
        return redirect()->back()->with('error', 'Error, Please Try Again Later!');
    }
}

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $datas = Employee::with('departments')->get();
        return view('view_employee',compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $employee)
    {
        $datas = Employee::with('departments')->findOrFail($employee);
        $deps = Department::all();
        return view('edit_employee',compact('datas','deps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employee)
    {
        $request->validate([
            'name' => 'sometimes',
            'department_id' => 'sometimes',
            'position' => 'sometimes',
            'email' => 'sometimes|email',
            'phone' => 'sometimes',
            'image' => 'sometimes|mimes:jpg,jpeg,png,gif|max:10000',
            'dob' => 'sometimes',
            'salary' => 'sometimes',
        ]);

        $data = Employee::findOrFail($employee);
        $image = $request->image;
        
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move(public_path('/images'), $imagename);
            $data->image = $imagename;
        }

        $data->name = $request->name;
        $data->department_id = $request->department_id;
        $data->position = $request->position;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->dob = $request->dob;
        $data->salary = $request->salary;
       


        if ($data->update()) {
            return redirect()->route('employees.show')->with('success','Employee Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $employee)
    {
        $datas = Employee::findOrFail($employee);
        if ($datas->delete()) {
            return redirect()->back()->with('success','Employee Delete Successfully!');
        }
        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }
}
