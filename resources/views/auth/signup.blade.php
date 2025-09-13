@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md border border-gray-200">
    <form method="POST" action="{{ route('signup.store') }}">
        @csrf
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Create an Account</h2>

        <!-- Username -->
        <div class="mb-5">
            <label for="name" class="block mb-2 text-base font-medium text-gray-700">Username</label>
            <input id="name" name="name" type="text" required value="{{ old('name') }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label for="email" class="block mb-2 text-base font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" required value="{{ old('email') }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block mb-2 text-base font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" required
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 text-base font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password_confirmation')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" 
            class="w-full py-3 bg-blue-600 text-white text-lg font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
            Sign Up
        </button>

        <!-- Login Redirect -->
        <p class="mt-6 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
                Sign in
            </a>
        </p>
    </form>
</div>
@endsection
