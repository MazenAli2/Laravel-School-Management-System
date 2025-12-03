<x-teacher-layout>
    <x-slot name="header">
        {{ __('Record Grades') }}
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

                    <!-- Subject Selection Form -->
                    <form method="GET" action="{{ route('teacher.grades.record') }}" class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-end gap-4">
                            <div class="flex-1">
                                <label for="subject_id" class="block text-gray-700 text-sm font-bold mb-2">Select Subject</label>
                                <select name="subject_id" id="subject_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="">-- Select a Subject --</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Load Students
                                </button>
                            </div>
                        </div>
                    </form>

                    @if($selectedSubject && $students->isNotEmpty())
                        <!-- Grading Form -->
                        <form method="POST" action="{{ route('teacher.grades.store') }}">
                            @csrf
                            <input type="hidden" name="subject_id" value="{{ $selectedSubject->id }}">

                            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="grading_date" class="block text-gray-700 text-sm font-bold mb-2">Grading Date</label>
                                    <input type="date" name="grading_date" id="grading_date" value="{{ date('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                </div>
                                <div>
                                    <label for="term" class="block text-gray-700 text-sm font-bold mb-2">Term/Exam</label>
                                    <select name="term" id="term" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                        <option value="">-- Select Term --</option>
                                        <option value="First Semester">First Semester</option>
                                        <option value="Second Semester">Second Semester</option>
                                        <option value="Midterm Exam">Midterm Exam</option>
                                        <option value="Final Exam">Final Exam</option>
                                        <option value="Quiz">Quiz</option>
                                        <option value="Assignment">Assignment</option>
                                    </select>
                                </div>
                            </div>

                            <h3 class="text-lg font-semibold mb-4">
                                Subject: {{ $selectedSubject->name }} 
                                @if($selectedGrade)
                                    (Grade: {{ $selectedGrade->name }})
                                @endif
                            </h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b text-left">Roll Number</th>
                                            <th class="py-2 px-4 border-b text-left">Student Name</th>
                                            <th class="py-2 px-4 border-b text-left">Section</th>
                                            <th class="py-2 px-4 border-b text-left">Score (0-100)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                            <tr class="hover:bg-gray-50">
                                                <td class="py-2 px-4 border-b">{{ $student->roll_number }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    {{ $student->user->name }}
                                                    <input type="hidden" name="grades[{{ $loop->index }}][student_id]" value="{{ $student->id }}">
                                                </td>
                                                <td class="py-2 px-4 border-b">{{ $student->section->name ?? 'N/A' }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <input type="number" 
                                                           name="grades[{{ $loop->index }}][score]" 
                                                           min="0" 
                                                           max="100" 
                                                           step="0.01"
                                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                           placeholder="Enter score">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Save Grades
                                </button>
                            </div>
                        </form>
                    @elseif($selectedSubject && $students->isEmpty())
                        <p class="text-gray-500">No students found for this subject/grade.</p>
                    @else
                        <p class="text-gray-500">Please select a subject to begin recording grades.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
