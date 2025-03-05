<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComplainRequest extends FormRequest
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
            'subject' => 'sometimes|regex:/^[a-zA-Z0-9\s]+$/|max:255',
            'content' => 'sometimes|regex:/^[a-zA-Z0-9\s]+$/|max:255',
        ];
    }
}
