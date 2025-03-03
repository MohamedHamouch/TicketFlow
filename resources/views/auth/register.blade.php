@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="flex justify-center items-center min-h-[calc(100vh-4rem)] py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8 bg-white p-8 rounded-lg shadow-md">
        <!-- Title -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
            <p class="mt-2 text-sm text-gray-600">Join us to get started</p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Full Name
                </label>
                <div class="mt-1">
                    <input id="name" name="name" type="text" required autofocus
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('name') }}"
                    >
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email Address
                </label>
                <div class="mt-1">
                    <input id="email" name="email" type="email" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('email') }}"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <!-- Role Selection -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">
                    Account Type
                </label>
                <div class="mt-1">
                    <select id="role" name="role" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                        <option value="developer" {{ old('role') == 'developer' ? 'selected' : '' }}>Developer</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <div class="mt-1">
                    <input id="password" name="password" type="password" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Confirm Password
                </label>
                <div class="mt-1">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Already have an account?
                </a>
                <button type="submit" 
                        class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection