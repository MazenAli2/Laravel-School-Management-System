<x-parent-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifications Component -->
            <x-parent-notifications />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welcome to the Parent Portal!</h3>
                    <p>Here you can view information about your children's academic progress.</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">My Children</h3>
                    @if($students->isEmpty())
                        <p class="text-gray-500">No students linked to your account.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($students as $student)
                                <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition duration-200">
                                    <div class="flex items-center mb-2">
                                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold mr-3">
                                            {{ substr($student->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $student->user->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $student->user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <p><span class="font-semibold">Grade:</span> {{ $student->grade->name ?? 'N/A' }}</p>
                                        <p><span class="font-semibold">Section:</span> {{ $student->section->name ?? 'N/A' }}</p>
                                        <p><span class="font-semibold">Roll Number:</span> {{ $student->roll_number }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-parent-layout>
