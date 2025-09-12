<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $key = $this->throttleKey();
        if (RateLimiter::tooManyAttempts($key, 10)) { 
            throw ValidationException::withMessages([
                'email' => ['Too many login attempts. Please try again later.']
            ]);
        }

        return true;
    }
    // public function throttleKey()
    // {
    //     return strtolower($this->input($this->username())) . '|' . $this->ip();
    // }
    public function throttleKey(): string{
        // example: "login|127.0.0.1"
        return Str::lower('login|' . request()->ip());
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

     public function messages(): array
    {
        return [
            'authorize' => 'Too many login attempts. Please try again later.',
            'email.required' => 'We need your email to log you in.',
            'email.exists' => 'This email is not registered with us.',
            'password.required' => 'Password cannot be empty.',
        ];
    }
}
