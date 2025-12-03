<x-student-layout>
    <x-slot name="header">
        {{ __('My Grades') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($grades->isEmpty())
                        <p class="text-gray-500">No grades recorded yet.</p>
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
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
