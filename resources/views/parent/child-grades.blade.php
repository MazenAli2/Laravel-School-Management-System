<x-parent-layout>
    <x-slot name="header">
        {{ __('View Child Grades') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Student Selection Form -->
                    <form method="GET" action="{{ route('parent.child-grades') }}" class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-end gap-4">
                            <div class="flex-1">
                                <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">Select Child</label>
                                <select name="student_id" id="student_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">-- Select a Child --</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    View Grades
                                </button>
                            </div>
                        </div>
                    </form>

                    @if($selectedStudent)
                        <h3 class="text-lg font-semibold mb-4">
                            Grades for: {{ $selectedStudent->user->name }}
                        </h3>

                        @if($grades->isEmpty())
                            <p class="text-gray-500">No grades recorded yet for this student.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b text-left">Date</th>
                                            <th class="py-2 px-4 border-b text-left">Subject</th>
                                            <th class="py-2 px-4 border-b text-left">Term/Exam</th>
                                            <th class="py-2 px-4 border-b text-left">Score</th>
                                            <th class="py-2 px-4 border-b text-left">Teacher</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grades as $grade)
                                            <tr class="hover:bg-gray-50">
                                                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($grade->grading_date)->format('M d, Y') }}</td>
                                                <td class="py-2 px-4 border-b font-medium">{{ $grade->subject->name }}</td>
                                                <td class="py-2 px-4 border-b">{{ $grade->term }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                                        @if($grade->score >= 90) bg-green-100 text-green-800
                                                        @elseif($grade->score >= 80) bg-blue-100 text-blue-800
                                                        @elseif($grade->score >= 70) bg-yellow-100 text-yellow-800
                                                        @elseif($grade->score >= 60) bg-orange-100 text-orange-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ number_format($grade->score, 2) }}%
                                                    </span>
                                                </td>
                                                <td class="py-2 px-4 border-b text-gray-500">{{ $grade->teacher->user->name ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @else
                        <p class="text-gray-500">Please select a child to view their grades.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-parent-layout>
