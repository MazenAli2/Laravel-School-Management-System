<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Welcome back, {{ $user->name }}!</h3>
                <p class="text-gray-600">Here's an overview of your profile and assigned subjects.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="px-6 py-4 bg-indigo-50 border-b border-indigo-100 flex items-center justify-between">
                        <h4 class="font-bold text-lg text-indigo-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile Information
                        </h4>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center border-b border-gray-100 pb-3">
                            <span class="text-gray-500 w-24 font-medium">Email:</span>
                            <span class="text-gray-800 font-semibold">{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center border-b border-gray-100 pb-3">
                            <span class="text-gray-500 w-24 font-medium">Phone:</span>
                            <span class="text-gray-800">{{ $teacher->phone_number ?? 'Not Provided' }}</span>
                        </div>
                        <div class="flex items-start">
                            <span class="text-gray-500 w-24 font-medium mt-1">Address:</span>
                            <span class="text-gray-800">{{ $teacher->address ?? 'Not Provided' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Subjects Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="px-6 py-4 bg-green-50 border-b border-green-100 flex items-center justify-between">
                        <h4 class="font-bold text-lg text-green-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            My Subjects
                        </h4>
                    </div>
                    <div class="p-6 flex items-center justify-center h-48">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-gray-500 italic">No subjects assigned yet.</p>
                            <p class="text-xs text-gray-400 mt-1">Check back later for updates.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
