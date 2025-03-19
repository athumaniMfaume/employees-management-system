<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized|regex:/^[a-zA-Z0-9\s]+$/|max:255
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
'subject' => 'required|regex:/^[a-zA-Z][a-zA-Z0-9\s&\'-]*$/|max:255',
'content' => 'required|regex:/^[a-zA-Z][a-zA-Z0-9\s&\'-]*$/|max:255',

        ];
    }
}
