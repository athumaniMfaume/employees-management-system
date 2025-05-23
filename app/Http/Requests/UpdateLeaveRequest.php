<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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
'type' => 'sometimes|regex:/^[a-zA-Z][a-zA-Z0-9\s&\'-]*$/|max:255',
'reason' => 'sometimes|regex:/^[a-zA-Z][a-zA-Z0-9\s&\'-]*$/|max:255',
'start_date' => 'sometimes|date',
'end_date' => 'sometimes|date|after_or_equal:start_date',

        ];
    }
}
