<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // add policy check if needed
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3', 'max:8', 'regex:/[0-9]/', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'confirmed'],
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least :min characters long.',
            'password.max' => 'Password may not be longer than :max characters.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'password.confirmed' => 'Password confirmation does not match.',
        ] ;
    }
}
