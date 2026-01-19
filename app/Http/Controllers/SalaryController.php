<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryController extends Controller
{

 public function allSalaryPDF()
{
    $salaries = Salary::with('employee.departments')->get();



    $pdf = Pdf::loadView('admin.salary.pdf', compact('salaries'));

    $employeeName = str_replace(' ', '_', strtolower('all_salary'));
    $fileName = $employeeName . '_salary_slip.pdf';

    return $pdf->download($fileName);
}   


public function generatePDF($id)
{
    $salary = Salary::with('employee.departments')->findOrFail($id);



    $pdf = Pdf::loadView('employees.salary.pdf', compact('salary'));

    $employeeName = str_replace(' ', '_', strtolower($salary->employee->name));
    $fileName = $employeeName . '_salary_slip.pdf';

    return $pdf->download($fileName);
}


    public function index()
    {
        $salaries = Salary::with('employee')->latest()->get();
        return view('admin.salary.index', compact('salaries'));
    }

    public function mySalary()
{
    $employee = Auth::guard('employee')->user();
    $salary = Salary::where('employee_id', $employee->id)->with('employee')->firstOrFail();
    return view('employees.salary', compact('salary'));
}

    public function create()
    {
        $employees = Employee::all();
        return view('admin.salary.create', compact('employees'));
    }

        public function store(Request $request)
    {
$request->validate([
    'employee_id' => 'required|exists:users,id',
    'basic_salary' => 'required|numeric|max:999999999', // Zuia namba zisizozidi Bilioni 1
    'allowance' => 'nullable|numeric|max:99999999',
    'deductions' => 'nullable|numeric|max:99999999'
]);

        $basic = $request->basic_salary;
        $allowance = $request->allowance ?? 0;
        $deductions = $request->deductions ?? 0;
        $net = $basic + $allowance - $deductions;

        Salary::create([
            'employee_id' => $request->employee_id,
            'basic_salary' => $basic,
            'allowance' => $allowance,
            'deductions' => $deductions,
            'net_salary' => $net,
            'pay_date' => now()
        ]);

        return redirect()->route('salaries.index')->with('success', 'Salary record added successfully.');
    }

    public function show($id)
{
    $salary = Salary::with('employee')->findOrFail($id);
    return view('admin.salary.show', compact('salary'));
}

public function edit($id)
{
    $salary = Salary::findOrFail($id);
    $employees = Employee::all();
    return view('admin.salary.edit', compact('salary', 'employees'));
}

public function update(Request $request, $id)
{
$request->validate([
    'employee_id' => 'required|exists:users,id',
    'basic_salary' => 'required|numeric|max:999999999', // Zuia namba zisizozidi Bilioni 1
    'allowance' => 'nullable|numeric|max:99999999',
    'deductions' => 'nullable|numeric|max:99999999'
]);

    $salary = Salary::findOrFail($id);

    $basic = $request->basic_salary;
    $allowance = $request->allowance ?? 0;
    $deductions = $request->deductions ?? 0;
    $net = $basic + $allowance - $deductions;

    $salary->update([
        'employee_id' => $request->employee_id,
        'basic_salary' => $basic,
        'allowance' => $allowance,
        'deductions' => $deductions,
        'net_salary' => $net,
    ]);

    return redirect()->route('salaries.index')->with('success', 'Salary record updated successfully.');
}

public function destroy($id)
{
    $salary = Salary::findOrFail($id);
    $salary->delete();

    return redirect()->route('salaries.index')->with('success', 'Salary record deleted successfully.');
}

}
