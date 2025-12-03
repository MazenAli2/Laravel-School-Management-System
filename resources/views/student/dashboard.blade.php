<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Hello, {{ $user->name }}!</h3>
                <p class="text-gray-600">Welcome to your student portal.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Academic Info Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="px-6 py-4 bg-teal-50 border-b border-teal-100 flex items-center justify-between">
                        <h4 class="font-bold text-lg text-teal-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            Academic Details
                        </h4>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center border-b border-gray-100 pb-3">
                            <span class="text-gray-500 w-32 font-medium">Roll Number:</span>
                            <span class="text-gray-800 font-semibold">{{ $student->roll_number }}</span>
                        </div>
                        <div class="flex items-center border-b border-gray-100 pb-3">
                            <span class="text-gray-500 w-32 font-medium">Grade:</span>
                            <span class="text-gray-800">{{ $student->grade->name }}</span>
                        </div>
                        <div class="flex items-center border-b border-gray-100 pb-3">
                            <span class="text-gray-500 w-32 font-medium">Section:</span>
                            <span class="text-gray-800">{{ $student->section->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-500 w-32 font-medium">Admission Date:</span>
                            <span class="text-gray-800">{{ $student->admission_date ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Guardian Info Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="px-6 py-4 bg-blue-50 border-b border-blue-100 flex items-center justify-between">
                        <h4 class="font-bold text-lg text-blue-800 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Guardian Information
                        </h4>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center border-b border-gray-100 pb-3">
                            <span class="text-gray-500 w-32 font-medium">Name:</span>
                            <span class="text-gray-800 font-semibold">{{ $student->guardian->user->name }}</span>
                        </div>
                        <div class="flex items-center border-b border-gray-100 pb-3">
                            <span class="text-gray-500 w-32 font-medium">Phone:</span>
                            <span class="text-gray-800">{{ $student->guardian->phone_number ?? 'N/A' }}</span>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('student.my-guardian') }}" class="text-teal-600 hover:text-teal-800 text-sm font-medium flex items-center">
                                View Full Details
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
