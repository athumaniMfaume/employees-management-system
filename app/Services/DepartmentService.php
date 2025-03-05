<?php
    
namespace App\Services;

use App\Models\Department;

class DepartmentService
{
	public function getAllDepartments()
    {
        return Department::all();  
    }

    public function createDepartment(array $data)
    {
        return Department::create($data);
    }

    public function updateDepartment(Department $department, array $data)
    {
        return $department->update($data);
    }

    public function deleteDepartment(Department $department)
    {
        return $department->delete();
    }
}
