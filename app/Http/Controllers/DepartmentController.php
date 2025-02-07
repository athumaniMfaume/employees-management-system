<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_department');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $data = new Department();

        $data->name = $request->name;


        if ($data->save()) {
            return redirect()->route('departments.show')->with('success','Department Added Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $datas = Department::all();
        return view('view_departments',compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($department)
    {
        $datas = Department::findOrFail($department);
        return view('edit_department',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $department)
    {
        $request->validate([
            'name' => 'sometimes',
           
        ]);

        $data = Department::findOrFail($department);

        $data->name = $request->name;


        if ($data->update()) {
            return redirect()->route('departments.show')->with('success','Department Updated Successfully!');
        }

        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $department)
    {
        $datas = Department::findOrFail($department);
        if ($datas->delete()) {
            return redirect()->back()->with('success','Department Delete Successfully!');
        }
        else {
            return redirect()->back()->with('error','Error, Please Try Again Later!');
        }
    }
}
