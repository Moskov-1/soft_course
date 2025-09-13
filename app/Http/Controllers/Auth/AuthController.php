<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signin(){
        return view("auth.signin");
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        $key = $request->throttleKey();
        if (Auth::attempt($credentials)) {
            RateLimiter::clear($key); // reset on success
            $request->session()->regenerate();

           return redirect()->route('home') 
            ->with('success', 'Login successful.');
            
        }

       return redirect()->back()
        ->withInput($request->only('email')) 
        ->withErrors([
            'email' => 'Invalid credentials. Please check your email and password.',
        ]);
    }

    public function signup(){
         return view("auth.signup");
    }
    public function register(SignUpRequest $request){
        $key = 'register|' . $request->ip();

        // Check if user exceeded attempts
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json(['message' => 'Too many registration attempts.'], 429);
        }

        // Record this attempt (decay 60 seconds)
        RateLimiter::hit($key, 60);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // optionally log in immediately
        Auth::login($user);

        return redirect()->route('home') 
                 ->with('success', 'Registration successful.');

    }

    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('login');
    }
}
