<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TicketFlow') }} - @yield('title', 'Ticket Management')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation Bar -->
        <nav class="bg-indigo-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="#" class="text-white font-bold text-xl">TicketFlow</a>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <div class="space-x-4">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>

                                @if (auth()->check())
                                    @if (auth()->user()->role === 'client')
                                        <a href="{{ route('client.tickets.index') }}" class="nav-link">My Tickets</a>
                                        <a href="{{ route('client.tickets.create') }}" class="nav-link">Create Ticket</a>
                                    @elseif(auth()->user()->role === 'developer')
                                        <a href="#" class="nav-link">Assigned Tickets</a>
                                    @elseif(auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.tickets.index') }}" class="nav-link">Manage Tickets</a>
                                        <a href="#" class="nav-link">Manage Users</a>
                                    @endif
                                @endif

                                <a href="#" class="nav-link">About</a>
                                <a href="#" class="nav-link">Contact</a>
                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @guest
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                            <a href="{{ route('register') }}"
                                class="ml-4 text-indigo-600 bg-white hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        @else
                            <!-- User Dropdown -->
                            <div class="ml-3 relative">
                                <button type="button" class="user-menu-button nav-button" aria-expanded="false"
                                    aria-haspopup="true">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div
                                    class="user-menu-items hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                                    <div class="py-1">
                                        <a href="#" class="dropdown-item">My Profile</a>
                                    </div>
                                    <div class="py-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left dropdown-item">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

</body>

</html>