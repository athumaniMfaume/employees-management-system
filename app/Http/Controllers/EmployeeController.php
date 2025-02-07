<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Mail\EmployeeCredentialsNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $deps = Department::all()->count();
        $emp = Employee::all()->count();
        return view('index',compact('deps','emp'));
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
        'dob' => 'required',
        'salary' => 'required',
    ]);

    // Generate a password (you can also use a random password generator)
    $password = 123;

    // Create a new employee
    $data = new Employee();

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
            'dob' => 'sometimes',
            'salary' => 'sometimes',
        ]);

        $data = Employee::findOrFail($employee);

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
