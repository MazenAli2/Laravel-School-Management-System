<x-admin-layout>
    <x-slot name="header">
        {{ __('Manage Timetables') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Timetable Slots</h2>
                        <a href="{{ route('admin.timetables.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Slot
                        </a>
                    </div>

                    @if($timetables->isEmpty())
                        <p class="text-gray-500">No timetable slots created yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left">Section</th>
                                        <th class="py-2 px-4 border-b text-left">Subject</th>
                                        <th class="py-2 px-4 border-b text-left">Teacher</th>
                                        <th class="py-2 px-4 border-b text-left">Day</th>
                                        <th class="py-2 px-4 border-b text-left">Time</th>
                                        <th class="py-2 px-4 border-b text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timetables as $slot)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-2 px-4 border-b">{{ $slot->section->grade->name }} - {{ $slot->section->name }}</td>
                                            <td class="py-2 px-4 border-b">{{ $slot->subject->name }}</td>
                                            <td class="py-2 px-4 border-b">{{ $slot->teacher->user->name }}</td>
                                            <td class="py-2 px-4 border-b">{{ $slot->day_of_week }}</td>
                                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}</td>
                                            <td class="py-2 px-4 border-b">
                                                <div class="flex gap-2">
                                                    <a href="{{ route('admin.timetables.edit', $slot) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                    <form method="POST" action="{{ route('admin.timetables.destroy', $slot) }}" onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
