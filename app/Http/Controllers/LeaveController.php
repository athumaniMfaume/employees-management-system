<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employees.index');
    }

    public function view()
    {
        $datas = Leave::all();
        return view('employees.leaves.view_leaves',compact('datas'));
    }

     public function single_employee_leave_view()
    {
        $emp_id = Auth::guard('employee')->user()->id;
        $datas = Leave::where('employee_id',$emp_id)->get();
        return view('employees.leaves.view_leaves',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.leaves.add_leave');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'type' => 'required|string',
        'reason' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

               $data = new Leave();
            $data->type = $request->type;
            $data->reason = $request->reason;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
             // Get the authenticated employee's ID and set it to the 'employee_id' field
             $data->employee_id = Auth::guard('employee')->user()->id;

    if ($data->save()) {
            return redirect()->route('single.employee.leaves.view')->with('success','Leave Added Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
}


    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $leave)
    {
        $datas = Leave::findOrFail($leave);
        return view('employees.leaves.edit_leaves',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$leave)
    {
        $request->validate([
            'type' => 'sometimes',
            'reason' => 'sometimes',
            'start_date' => 'sometimes',
            'end_date' => 'sometimes',
        ]);

         $data = Leave::findOrFail($leave);

        $data->type = $request->type;
        $data->reason = $request->reason;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        

        if ($data->update()) {
            return redirect()->route('single.employee.leaves.view')->with('success','Leave Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $leave)
    {
         $datas = Leave::findOrFail($leave);
        if ($datas->delete()) {
            return redirect()->back()->with('success','Leave Delete Successfully!');
        }
        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }
}
