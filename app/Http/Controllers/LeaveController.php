<?php 

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Services\LeaveService;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    protected $leaveService;
   



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
        $datas = Leave::where('employee_id', $emp_id)->get();
        return view('employees.leaves.view_leaves', compact('datas'));
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
    public function store(StoreLeaveRequest $request)
    {
        $data = $request->validated(); // Get validated data from request

        if ($this->leaveService->storeLeave($data)) {
            return redirect()->route('single.employee.leaves.view')->with('success', 'Leave Added Successfully!');
        } else {
            return redirect()->back()->with('error', 'Error, Please Try Again Later!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($leave)
    {
        $datas = Leave::findOrFail($leave);
        return view('employees.leaves.edit_leaves', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequest $request, $leave)
    {
        $data = $request->validated(); // Get validated data from request
        $leave = Leave::findOrFail($leave);

        if ($this->leaveService->updateLeave($leave, $data)) {
            return redirect()->route('single.employee.leaves.view')->with('success', 'Leave Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Error, Please Try Again Later!');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($leave)
    {
        $leave = Leave::findOrFail($leave);

        if ($this->leaveService->deleteLeave($leave)) {
            return redirect()->back()->with('success', 'Leave Deleted Successfully!');
        } else {
            return redirect()->back()->with('error', 'Error, Please Try Again Later!');
        }
    }
}
