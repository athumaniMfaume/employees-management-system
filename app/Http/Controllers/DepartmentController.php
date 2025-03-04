<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        // Use the service to get all departments
        $departments = $this->departmentService->getAllDepartments();
        
        // Return the view with the data
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(DepartmentRequest $request)
    {
        $this->departmentService->createDepartment($request->validated());

        return redirect()->route('departments.index')->with('success', 'Department Added Successfully!');
    }

    public function edit(Department $department)
    {
        
        return view('admin.departments.edit', compact('department'));

    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $this->departmentService->updateDepartment($department, $request->validated());

        return redirect()->route('departments.index')->with('success', 'Department Updated Successfully!');
    }

    public function destroy(Department $department)
    {
        $this->departmentService->deleteDepartment($department);

        return redirect()->back()->with('success', 'Department Deleted Successfully!');
    }
}