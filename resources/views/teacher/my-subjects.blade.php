<x-teacher-layout>
    <x-slot name="header">
        {{ __('My Subjects') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Assigned Subjects</h3>
                    
                    @if($subjects->isEmpty())
                        <p class="text-gray-500">No subjects assigned yet.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($subjects as $subject)
                                <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition duration-200 bg-white">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-bold text-xl text-indigo-600">{{ $subject->name }}</h4>
                                        <span class="px-2 py-1 text-xs font-semibold text-indigo-800 bg-indigo-100 rounded-full">
                                            {{ $grades[$subject->pivot->grade_id] ?? 'Grade N/A' }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm">{{ $subject->description ?? 'No description available.' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
