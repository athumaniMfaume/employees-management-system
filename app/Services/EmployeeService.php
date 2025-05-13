<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCredentialsNotification;

class EmployeeService
{
    public function createEmployee($data)
    {
        $password = 123; // Default password

        // Handle image upload
        if (isset($data['image'])) {
            $image = $data['image'];

            if ($image->isValid()) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imagename);
                $data['image'] = $imagename;
            }
        }

        // Hash the password
        $data['password'] = Hash::make($password);

        // Create employee
        $employee = Employee::create($data);

        // Send email
        if ($employee) {
            Mail::to($employee->email)->send(new EmployeeCredentialsNotification($employee->email, $password));
        }

        return $employee;
    }

public function updateEmployee($data, Employee $employee)
{
    // Handle image update
    if (isset($data['image'])) {
        $image = $data['image'];

        if ($image->isValid()) {
            // Delete old image
            if ($employee->image && file_exists(public_path('images/' . $employee->image))) {
                unlink(public_path('images/' . $employee->image));
            }

            // Save new image
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
            $data['image'] = $imagename;
        } else {
            return 'Invalid image file.';
        }
    }

    if ($employee->update($data)) {
        // ✅ Return updated model instance
        return $employee->fresh(); // Refresh and return updated data
    }

    return 'Failed to update employee.';
}


    public function deleteEmployee(Employee $employee)
    {
        if ($employee->image && file_exists(public_path('images/' . $employee->image))) {
            unlink(public_path('images/' . $employee->image));
        }

        $employee->delete();

        return 'Employee and image deleted successfully.';
    }
}
