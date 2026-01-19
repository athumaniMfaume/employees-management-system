<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateEmployeeRequest extends FormRequest
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
        'name' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
        'gender' => 'nullable|in:male,female,other',
        'department_id' => 'sometimes',
        'position' => 'sometimes|regex:/^[a-zA-Z\s]+$/|max:255',
        'email' => [
            'sometimes',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]{2,}\.[a-zA-Z]{2,}$/',
            Rule::unique('employees', 'email')->ignore($this->employee),  // Use employee instance passed from the controller
        ],
        'phone' => 'sometimes|regex:/^\+255[0-9]{9}$/',
        'image' => 'sometimes|mimes:jpg,jpeg,png,gif|max:10000',
        'dob' => 'sometimes|date|before:' . now()->subYears(18)->toDateString(),
        'salary' => 'sometimes|numeric|regex:/^\d+(\.\d{1,2})?$/',
    ];

    }
}
