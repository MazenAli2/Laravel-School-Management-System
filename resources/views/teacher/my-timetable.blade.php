<x-teacher-layout>
    <x-slot name="header">
        {{ __('My Timetable') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($timetable->isEmpty())
                        <p class="text-gray-500">No timetable slots assigned yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left bg-gray-50">Day</th>
                                        <th class="py-2 px-4 border-b text-left bg-gray-50">Time</th>
                                        <th class="py-2 px-4 border-b text-left bg-gray-50">Subject</th>
                                        <th class="py-2 px-4 border-b text-left bg-gray-50">Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($days as $day)
                                        @if($timetable->has($day))
                                            @foreach($timetable[$day] as $slot)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-2 px-4 border-b font-semibold">{{ $day }}</td>
                                                    <td class="py-2 px-4 border-b">
                                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} - 
                                                        {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}
                                                    </td>
                                                    <td class="py-2 px-4 border-b">{{ $slot->subject->name }}</td>
                                                    <td class="py-2 px-4 border-b">{{ $slot->section->grade->name }} - {{ $slot->section->name }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
