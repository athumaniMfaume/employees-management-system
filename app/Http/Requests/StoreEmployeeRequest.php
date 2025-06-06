<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'gender' => 'required|in:male,female,other',
            'department_id' => 'required',
            'position' => 'required|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|unique:employees,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]{2,}\.[a-zA-Z]{2,}$/',
            'phone' => 'required|regex:/^\+255[0-9]{9}$/',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:10000',
            'dob' => 'required|date|before:' . now()->subYears(18)->toDateString(),
            'salary' => 'required|numeric|min:100000|regex:/^\d+(\.\d{1,2})?$/',

        ];
    }
}
