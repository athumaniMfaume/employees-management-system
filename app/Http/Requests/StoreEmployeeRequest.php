<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'gender' => 'required|in:male,female,other',
            'department_id' => 'required|exists:departments,id',
            'position' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|unique:employees,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]{2,}\.[a-zA-Z]{2,}$/',
            'phone' => 'required|regex:/^\+255[0-9]{9}$/',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:10240',
            'dob' => 'required|date|before:' . now()->subYears(18)->toDateString(),
            'salary' => 'required|numeric|min:100000|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            // Name
            'name.required' => 'Please enter the full name of the employee.',
            'name.regex' => 'The name can only contain letters and spaces.',
            
            // Gender
            'gender.required' => 'Please select a gender.',
            'gender.in' => 'The selected gender is invalid.',
            
            // Department
            'department_id.required' => 'Please select a department.',
            'department_id.exists' => 'The selected department does not exist in our records.',
            
            // Position
            'position.required' => 'The job position is required.',
            'position.regex' => 'The position should only contain letters.',
            
            // Email
            'email.required' => 'An email address is required.',
            'email.email' => 'Please enter a valid email format.',
            'email.unique' => 'This email address is already assigned to another employee.',
            'email.regex' => 'Please provide a valid email (e.g., user@domain.com).',
            
            // Phone
            'phone.required' => 'The phone number is required.',
            'phone.regex' => 'The phone number must start with +255 followed by 9 digits (e.g., +255754123456).',
            
            // Image
            'image.required' => 'Please upload an employee profile picture.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png, or gif.',
            'image.max' => 'The image size may not be greater than 10MB.',
            
            // Date of Birth
            'dob.required' => 'The date of birth is required.',
            'dob.date' => 'Please enter a valid date.',
            'dob.before' => 'The employee must be at least 18 years old.',
            
            // Salary
            'salary.required' => 'Please enter the employee salary amount.',
            'salary.numeric' => 'The salary must be a number.',
            'salary.min' => 'The minimum salary allowed is 100,000.',
            'salary.regex' => 'Please enter a valid salary amount (e.g., 500000 or 500000.50).',
        ];
    }
}


