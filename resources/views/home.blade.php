<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/2">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">TicketFlow</h1>
                            <h2 class="text-xl md:text-2xl font-semibold text-indigo-600 mb-6">Smart Ticket Management and
                                Developer Assignment</h2>
                            <p class="text-gray-600 text-lg mb-6">
                                Simplify issue tracking, task assignment, and improve your team's efficiency
                                with our comprehensive ticket management platform.
                            </p>
                            <!-- Replace the existing buttons div with this: -->
                            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 mb-6">
                                @auth
                                    <a href=""
                                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Go to Dashboard
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('register') }}"
                                        class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Create Account
                                    </a>
                                    <a href="{{ route('login') }}"
                                        class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50">
                                        Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <div class="md:w-1/2 flex justify-center mt-8 md:mt-0">
                            <img src="{{ asset('images/ticket-management.svg') }}" alt="TicketFlow Illustration"
                                class="h-64 w-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-12">Main Features</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-indigo-600 mb-4">
                    <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Ticket Creation</h3>
                <p class="text-gray-600">
                    Clients can easily create detailed tickets to report issues or request assistance with specific
                    software.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-indigo-600 mb-4">
                    <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Smart Assignment</h3>
                <p class="text-gray-600">
                    Administrators can quickly assign tickets to the most qualified developers to solve the problem
                    efficiently.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-indigo-600 mb-4">
                    <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Statistics & Analysis</h3>
                <p class="text-gray-600">
                    Access customized dashboards with detailed statistics on performance and activity metrics.
                </p>
            </div>
        </div>
    </div>
@endsection