<x-admin-layout>
    <x-slot name="header">
        {{ __('Attendance Report') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('admin.attendance.report') }}" class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="grade_id" class="block text-gray-700 text-sm font-bold mb-2">Grade</label>
                                <select name="grade_id" id="grade_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">All Grades</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                                            {{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="section_id" class="block text-gray-700 text-sm font-bold mb-2">Section</label>
                                <select name="section_id" id="section_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">All Sections</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }} ({{ $section->grade->name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="date_from" class="block text-gray-700 text-sm font-bold mb-2">From Date</label>
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <div>
                                <label for="date_to" class="block text-gray-700 text-sm font-bold mb-2">To Date</label>
                                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Apply Filters
                            </button>
                            <a href="{{ route('admin.attendance.report') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Clear Filters
                            </a>
                        </div>
                    </form>

                    @if($attendances->isEmpty())
                        <p class="text-gray-500">No attendance records found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left">Date</th>
                                        <th class="py-2 px-4 border-b text-left">Student Name</th>
                                        <th class="py-2 px-4 border-b text-left">Grade</th>
                                        <th class="py-2 px-4 border-b text-left">Section</th>
                                        <th class="py-2 px-4 border-b text-left">Status</th>
                                        <th class="py-2 px-4 border-b text-left">Recorded By</th>
                                        <th class="py-2 px-4 border-b text-left">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendances as $attendance)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M d, Y') }}</td>
                                            <td class="py-2 px-4 border-b">{{ $attendance->student->user->name }}</td>
                                            <td class="py-2 px-4 border-b">{{ $attendance->student->section->grade->name ?? 'N/A' }}</td>
                                            <td class="py-2 px-4 border-b">{{ $attendance->student->section->name ?? 'N/A' }}</td>
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
                                            <td class="py-2 px-4 border-b">{{ $attendance->teacher->user->name ?? 'N/A' }}</td>
                                            <td class="py-2 px-4 border-b text-gray-500">{{ $attendance->notes ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $attendances->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
