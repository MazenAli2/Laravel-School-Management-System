<x-student-layout>
    <x-slot name="header">
        {{ __('My Attendance') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($attendances->isEmpty())
                        <p class="text-gray-500">No attendance records found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left">Date</th>
                                        <th class="py-2 px-4 border-b text-left">Status</th>
                                        <th class="py-2 px-4 border-b text-left">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendances as $attendance)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M d, Y') }}</td>
                                            <td class="py-2 px-4 border-b">
                                                @if($attendance->status === 'Present')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Present
                                                    </span>
                                                @elseif($attendance->status === 'Absent')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Absent
                                                    </span>
                                                @elseif($attendance->status === 'Late')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Late
                                                    </span>
                                                @else
                                                    {{ $attendance->status }}
                                                @endif
                                            </td>
                                            <td class="py-2 px-4 border-b text-gray-500">{{ $attendance->notes ?? '-' }}</td>
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
</x-student-layout>
