<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use App\Models\{User, Employee, Department, Leave, Complain};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeApiController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function stats()
    {
        return response()->json([
            'departments' => Department::count(),
            'employees' => Employee::count(),
            'leaves' => Leave::count(),
            'complains' => Complain::count(),
        ]);
    }

    public function employeeDashboard()
    {
        $emp = Auth::guard('employee')->user();
        return response()->json([
            'departments' => Department::count(),
            'employee' => $emp,
            'leaves' => Leave::where('employee_id', $emp->id)->count(),
            'complains' => Complain::where('employee_id', $emp->id)->count(),
        ]);
    }

    public function profile()
    {
        $emp = Auth::guard('employee')->user();
        return response()->json([
            'employee' => Employee::with('departments')->find($emp->id),
        ]);
    }

    public function updateProfile(UpdateEmployeeRequest $request, $id)
    {
        $data = $request->validated();
        $employee = Employee::findOrFail($id);
        $this->employeeService->updateEmployee($data, $employee);

        return response()->json(['message' => 'Employee updated successfully.']);
    }

    public function showComplains()
    {
                $emp_id = Auth::guard('employee_api')->user()->id;
        
        $complains = complain::where('employee_id', $emp_id)
              ->get(); // will throw 404 if not found;
        return response()->json($complains);
    }

    public function showLeaves()
    {
        return response()->json([
            'leaves' => Leave::all(),
        ]);
    }

    public function approveComplain(Request $request, $id)
    {
        $validated = $request->validate([
            'subject' => 'sometimes|string|max:255',
            'content' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:255',
        ]);

        $complain = Complain::findOrFail($id);
        $complain->update($validated);

        return response()->json(['message' => 'Complain updated successfully.']);
    }

    public function approveLeave(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'sometimes|string|max:255',
            'reason' => 'sometimes|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'sometimes|string|max:255',
        ]);

        $leave = Leave::findOrFail($id);
        $leave->update($validated);

        return response()->json(['message' => 'Leave updated successfully.']);
    }
}

