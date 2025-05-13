<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Services\LeaveService;
use Illuminate\Support\Facades\Auth;

class LeaveApiController extends Controller
{
    protected $leaveService;

    public function __construct(LeaveService $leaveService)
    {
        $this->leaveService = $leaveService;
    }

    // List all leaves
    public function index()
    {
        $leaves = Leave::all();
        return response()->json(['leaves' => $leaves], 200);
    }

    // List leaves for a specific employee (authenticated)
    public function employeeLeaves()
    {
        $emp_id = Auth::guard('employee_api')->user()->id;
        $leaves = Leave::where('employee_id', $emp_id)->get();
        return response()->json(['leaves' => $leaves], 200);
    }

    // Store a new leave
    public function store(StoreLeaveRequest $request)
    {
        $data = $request->validated();

        if ($this->leaveService->storeLeave($data)) {
            return response()->json(['message' => 'Leave Added Successfully!'], 201);
        }

        return response()->json(['message' => 'Error, Please Try Again Later!'], 500);
    }

    // Show a single leave
    public function show($id)
    {
        $emp_id = Auth::guard('employee_api')->user()->id;
        
        $leave = Leave::where('id', $id)
              ->where('employee_id', $emp_id)
              ->firstOrFail(); // will throw 404 if not found;

        if (!$leave) {
            return response()->json(['message' => 'Leave not found'], 404);
        }

        return response()->json(['leave' => $leave], 200);
    }

    // Update a leave
    public function update(UpdateLeaveRequest $request, $id)
    {
        $emp_id = Auth::guard('employee_api')->user()->id;
        
        $leave = Leave::where('id', $id)
              ->where('employee_id', $emp_id)
              ->firstOrFail(); // will throw 404 if not found;

        if (!$leave) {
            return response()->json(['message' => 'Leave not found'], 404);
        }

        $data = $request->validated();

        if ($this->leaveService->updateLeave($leave, $data)) {
            return response()->json(['message' => 'Leave Updated Successfully!'], 200);
        }

        return response()->json(['message' => 'Error, Please Try Again Later!'], 500);
    }

    // Delete a leave
    public function destroy($id)
    {
        $emp_id = Auth::guard('employee_api')->user()->id;
        
        $leave = Leave::where('id', $id)
              ->where('employee_id', $emp_id)
              ->firstOrFail(); // will throw 404 if not found;

        if (!$leave) {
            return response()->json(['message' => 'Leave not found'], 404);
        }

        if ($this->leaveService->deleteLeave($leave)) {
            return response()->json(['message' => 'Leave Deleted Successfully!'], 200);
        }

        return response()->json(['message' => 'Error, Please Try Again Later!'], 500);
    }
}
