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
    $password = "12345678"; // Use a stronger default string

    try {
        if (isset($data['image']) && $data['image']->isValid()) {
            $image = $data['image'];
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
            $data['image'] = $imagename;
        }

        $data['password'] = Hash::make($password);
        $employee = Employee::create($data);

        // Wrap mail in try-catch so if mail fails, the employee is still created
        try {
            Mail::to($employee->email)->send(new EmployeeCredentialsNotification($employee->email, $password));
        } catch (\Exception $e) {
            \Log::error("Mail failed: " . $e->getMessage());
        }

        return $employee;
    } catch (\Exception $e) {
        \Log::error("Employee creation failed: " . $e->getMessage());
        return null; 
    }
}


public function updateEmployee($data, Employee $employee)
{
    try {
        // Handle image update
        if (isset($data['image']) && $data['image']->isValid()) {
            $image = $data['image'];

            // DELETE OLD IMAGE SAFELY
            // Use file_exists to prevent "file not found" crash on Render
            if ($employee->image) {
                $oldPath = public_path('images/' . $employee->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath); // @ suppresses warnings if deletion fails
                }
            }

            // SAVE NEW IMAGE
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
            $data['image'] = $imagename;
        }

        // PERFORM UPDATE
        $employee->update($data);
        
        // Always return the updated model
        return $employee->fresh();

    } catch (\Exception $e) {
        // Log the error so you can see it in Render's dashboard logs
        \Log::error("Employee Update Failed: " . $e->getMessage());
        
        // Throwing the error allows your Controller to catch it and show a message
        throw $e; 
    }
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
