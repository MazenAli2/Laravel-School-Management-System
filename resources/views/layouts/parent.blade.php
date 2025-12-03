<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Parent Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:block shadow-xl">
            <div class="p-6 flex items-center justify-center border-b border-gray-800">
                <a href="{{ route('parent.dashboard') }}" class="text-2xl font-bold tracking-wider text-purple-400 hover:text-purple-300 transition duration-300">
                    SMS Parent
                </a>
            </div>

            <nav class="mt-6 px-4 space-y-3">
                <a href="{{ route('parent.dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('parent.dashboard') ? 'bg-purple-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('parent.dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Children
                    </p>
                </div>

                <a href="{{ route('parent.child-grades') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('parent.child-grades') ? 'bg-purple-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('parent.child-grades') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    View Grades
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden bg-gray-100">

            <!-- Header -->
            <header class="bg-white shadow-md z-10">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="flex items-center md:hidden">
                        <button class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <span class="ml-4 text-lg font-semibold text-gray-800">Parent Portal</span>
                    </div>

                    <div class="flex items-center ml-auto">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out">
                                <span class="mr-2">{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition duration-150">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @if (isset($header))
                        <h3 class="text-gray-700 text-3xl font-medium mb-4">{{ $header }}</h3>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
