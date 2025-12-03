<x-admin-layout>
    <x-slot name="header">
        {{ __('Create Timetable Slot') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.timetables.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="section_id" class="block text-gray-700 text-sm font-bold mb-2">Section</label>
                            <select name="section_id" id="section_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Select Section --</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->grade->name }} - {{ $section->name }}</option>
                                @endforeach
                            </select>
                            @error('section_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="subject_id" class="block text-gray-700 text-sm font-bold mb-2">Subject</label>
                            <select name="subject_id" id="subject_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="teacher_id" class="block text-gray-700 text-sm font-bold mb-2">Teacher</label>
                            <select name="teacher_id" id="teacher_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Select Teacher --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="day_of_week" class="block text-gray-700 text-sm font-bold mb-2">Day of Week</label>
                            <select name="day_of_week" id="day_of_week" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Select Day --</option>
                                @foreach($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('day_of_week')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Start Time</label>
                                <input type="time" name="start_time" id="start_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @error('start_time')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">End Time</label>
                                <input type="time" name="end_time" id="end_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @error('end_time')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.timetables.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Slot
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
