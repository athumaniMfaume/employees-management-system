<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function department_pdf()
    {
        $departments = Department::all();
        $pdf = Pdf::loadView('admin.departments.pdf', compact('departments'));
        $department = str_replace(' ', '_', strtolower('all'));
        $fileName = $department . '_department.pdf';
        return $pdf->download($fileName);
    }

    public function employee_pdf()
    {
        $employees = Employee::with(['departments','salaries'])->get();
        // dd($employees);
        $pdf = Pdf::loadView('admin.employees.all_pdf', compact('employees'));
        $employees = str_replace(' ', '_', strtolower('all'));
        $fileName = $employees . '_employees.pdf';
        return $pdf->download($fileName);
    }

    public function single_employee_pdf($id)
    {
        $employee = Employee::with(['departments','salaries'])->findOrFail($id);
        //  dd($employee->name);
        $pdf = Pdf::loadView('admin.employees.single_pdf', compact('employee'));
        $employee = str_replace(' ', '_', strtolower($employee->name));
        $fileName = $employee . '_.pdf';
        return $pdf->download($fileName);
    }
}
