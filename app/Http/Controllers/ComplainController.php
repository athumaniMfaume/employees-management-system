<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

     public function view()
    {
         $datas = Complain::all();
        return view('employees.complain.view_complain',compact('datas'));
    }

     public function single_employee_complain_view()
    {
        $emp_id = Auth::guard('employee')->user()->id;
        $datas = Complain::where('employee_id',$emp_id)->get();
        return view('employees.complain.view_complain',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.complain.add_complain');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

           $data = new Complain();
            $data->subject = $request->subject;
            $data->content = $request->content;
             // Get the authenticated employee's ID and set it to the 'employee_id' field
             $data->employee_id = Auth::guard('employee')->user()->id;

      
        if ($data->save()) {
            return redirect()->route('single.employee.complain.view')->with('success','Complain Added Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($complain)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $complain)
    {
         $datas = Complain::findOrFail($complain);
        return view('employees.complain.edit_complain',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $complain)
    {
        $request->validate([
            'subject' => 'sometimes',
            'content' => 'sometimes',
        ]);

         $data = Complain::findOrFail($complain);

        $data->subject = $request->subject;
        $data->content = $request->content;
        

        if ($data->update()) {
            return redirect()->route('single.employee.complain.view')->with('success','Complain Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $complain)
    {
         $datas = Complain::findOrFail($complain);
        if ($datas->delete()) {
            return redirect()->back()->with('success','complain Delete Successfully!');
        }
        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }
}
