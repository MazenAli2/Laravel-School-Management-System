<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Teacher Portal</title>

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
                <a href="{{ route('teacher.dashboard') }}" class="text-2xl font-bold tracking-wider text-indigo-400 hover:text-indigo-300 transition duration-300">
                    SMS Teacher
                </a>
            </div>

            <nav class="mt-6 px-4 space-y-3">
                <a href="{{ route('teacher.dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('teacher.dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Academic
                    </p>
                </div>

                <a href="{{ route('teacher.my-students') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('teacher.my-students') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.my-students') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    My Students
                </a>

                <a href="{{ route('teacher.my-timetable') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('teacher.my-timetable') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.my-timetable') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    My Timetable
                </a>

                <a href="{{ route('teacher.attendance.record') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('teacher.attendance.record') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.attendance.record') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Record Attendance
                </a>

                <a href="{{ route('teacher.attendance.view') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('teacher.attendance.view') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.attendance.view') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View Attendance History
                </a>

                <a href="{{ route('teacher.grades.record') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('teacher.grades.*') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.grades.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Record Grades
                </a>

                <a href="{{ route('teacher.my-subjects') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('teacher.my-subjects') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('teacher.my-subjects') ? 'text-white' : 'text-gray-500 group-hover:text-white' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    My Subjects
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
                        <span class="ml-4 text-lg font-semibold text-gray-800">Teacher Portal</span>
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
