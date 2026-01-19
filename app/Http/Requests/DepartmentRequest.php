<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                // 1. (?!^\d+$) -> Prevents the input from being ONLY numbers
                // 2. [\pL] -> Requires at least one letter (Unicode-safe)
                // 3. [\pL\pN\s\-] -> Allows letters, numbers, spaces, and hyphens
                'regex:/^(?!^\d+$)[\pL\pN\s\-]+$/u',
                Rule::unique('departments', 'name')->ignore($this->department),
            ],
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.regex' => 'The department name must contain letters and cannot consist of only numbers or special characters.',
        ];
    }
}