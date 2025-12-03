<x-teacher-layout>
    <x-slot name="header">
        {{ __('Record Attendance') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('teacher.attendance.store') }}">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="attendance_date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                            <input type="date" name="attendance_date" id="attendance_date" value="{{ date('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        @foreach($sections as $section)
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-4 border-b pb-2">
                                    Section: {{ $section->name }} (Grade: {{ $section->grade->name }})
                                </h3>
                                
                                @if($section->students->isEmpty())
                                    <p class="text-gray-500 italic">No students in this section.</p>
                                @else
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-200">
                                            <thead>
                                                <tr>
                                                    <th class="py-2 px-4 border-b text-left">Student Name</th>
                                                    <th class="py-2 px-4 border-b text-center">Status</th>
                                                    <th class="py-2 px-4 border-b text-left">Notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($section->students as $student)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="py-2 px-4 border-b">
                                                            <div class="font-medium">{{ $student->user->name }}</div>
                                                            <div class="text-xs text-gray-500">Roll: {{ $student->roll_number }}</div>
                                                            <input type="hidden" name="attendance[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                                                        </td>
                                                        <td class="py-2 px-4 border-b text-center">
                                                            <div class="flex justify-center space-x-4">
                                                                <label class="inline-flex items-center">
                                                                    <input type="radio" name="attendance[{{ $student->id }}][status]" value="Present" class="form-radio text-green-600" checked>
                                                                    <span class="ml-2">Present</span>
                                                                </label>
                                                                <label class="inline-flex items-center">
                                                                    <input type="radio" name="attendance[{{ $student->id }}][status]" value="Absent" class="form-radio text-red-600">
                                                                    <span class="ml-2">Absent</span>
                                                                </label>
                                                                <label class="inline-flex items-center">
                                                                    <input type="radio" name="attendance[{{ $student->id }}][status]" value="Late" class="form-radio text-yellow-600">
                                                                    <span class="ml-2">Late</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="py-2 px-4 border-b">
                                                            <input type="text" name="attendance[{{ $student->id }}][notes]" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Optional notes">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Save Attendance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
