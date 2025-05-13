<?php

namespace App\Http\Controllers\API;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DepartmentApiController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Get all departments.
     */
    public function index()
    {
        // Use the service to get all departments
        $departments = $this->departmentService->getAllDepartments();

        // Return response as JSON
        return response()->json([
            'success' => true,
            'departments' => $departments
        ], 200);
    }

    /**
     * Create a new department.
     */
    public function store(DepartmentRequest $request)
    {
        // Validate incoming request
        $validatedData = $request->validated();

        // Use service to create department
        $department = $this->departmentService->createDepartment($validatedData);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Department Added Successfully!',
            'department' => $department
        ], 201);
    }

    /**
     * Edit department (get single department details).
     */
    public function show(Department $department)
    {
        // Return the department data as JSON
        return response()->json([
            'success' => true,
            'department' => $department
        ], 200);
    }

    /**
     * Update an existing department.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        // Validate incoming request
        $validatedData = $request->validated();

        // Use service to update the department
        $updatedDepartment = $this->departmentService->updateDepartment($department, $validatedData);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Department Updated Successfully!',
            'department' => $updatedDepartment
        ], 200);
    }

    /**
     * Delete a department.
     */
    public function destroy(Department $department)
    {
        // Use service to delete the department
        $this->departmentService->deleteDepartment($department);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Department Deleted Successfully!'
        ], 200);
    }
}
