<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
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
            'name'              => ['required', 'string', 'max:100'],
            'email'             => ['required', 'string', 'email', 'max:190'],
            'phone'             => ['nullable', 'numeric', 'max_digits:11', 'regex:/^01[3-9][0-9]{8}$/'],
            'nid'               => [
                'required', 'string', 'regex:/^\w{10}$|^\w{14}$|^\w{17}$/', Rule::unique('users', 'identity_number')
            ],
            'dob'               => ['required', 'date', 'date_format:d F Y'],
            'vaccine_center_id' => ['required', 'integer', 'exists:vaccine_centers,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'The phone number is invalid.',
            'nid.regex'   => 'The nid/birth certificate number is invalid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nid' => 'nid/birth certificate number',
            'vaccine_center_id' => 'vaccine center',
        ];
    }
}
