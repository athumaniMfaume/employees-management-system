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

      // Check if there is an image in the request data
      if (isset($data['image'])) {
        $image = $data['image'];

        // Ensure the image is valid before moving it
        if ($image->isValid()) {
            // Generate a unique image name using the current time
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            // Move the image to the 'images' directory
            $image->move(public_path('images'), $imagename);

            // Save the image name to the data array
            $data['image'] = $imagename;
        } else {
            // Handle invalid image (optional)
            // return response()->json(['error' => 'Invalid image file.'], 400);
          }
       }

      // Hash the password
      $data['password'] = Hash::make($password);

      // Create employee and save to database
      $employee = Employee::create($data); // Ensure $data contains 'image' now

      // Send email notification
      if ($employee) {
        Mail::to($employee->email)->send(new EmployeeCredentialsNotification($employee->email, $password));
      }

      return $employee;

    }

    public function updateEmployee($data, Employee $employee)
    {
       // Check if a new image is being uploaded
       if (isset($data['image'])) {
          $image = $data['image'];

          // Validate if the image is valid
          if ($image->isValid()) {
            // Check if the employee already has an image and delete it if necessary
            if ($employee->image && file_exists(public_path('images/' . $employee->image))) {
                unlink(public_path('images/' . $employee->image)); // Delete the old image
            }

            // Generate a new image name using the current timestamp
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded image to the 'images' directory
            $image->move(public_path('images'), $imagename);

            // Save the new image name to the data array
            $data['image'] = $imagename;
           } else {
            // Return an error if the image is invalid
            return response()->json(['error' => 'Invalid image file.'], 400);
            }
        }

        // Update the employee record with the new data (including the image name if available)
        if ($employee->update($data)) {
          return response()->json(['success' => 'Employee updated successfully.'], 200);
        } else {
        return response()->json(['error' => 'Failed to update employee.'], 400);
           }
    }

    public function deleteEmployee(Employee $employee)
    {
      // Check if the employee has an image and delete it if it exists
      if ($employee->image && file_exists(public_path('images/' . $employee->image))) {
        unlink(public_path('images/' . $employee->image)); // Delete the image
       }

       // Now delete the employee record from the database
       $employee->delete();

       return response()->json(['success' => 'Employee and image deleted successfully.'], 200);
    }

}
