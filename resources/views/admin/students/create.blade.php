<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.students.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Grade -->
                        <div class="mt-4">
                            <x-input-label for="grade_id" :value="__('Grade')" />
                            <select id="grade_id" name="grade_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Grade</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('grade_id')" class="mt-2" />
                        </div>

                        <!-- Section -->
                        <div class="mt-4">
                            <x-input-label for="section_id" :value="__('Section')" />
                            <select id="section_id" name="section_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('section_id')" class="mt-2" />
                        </div>

                        <!-- Guardian -->
                        <div class="mt-4">
                            <x-input-label for="guardian_id" :value="__('Guardian')" />
                            <select id="guardian_id" name="guardian_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Guardian</option>
                                @foreach($guardians as $guardian)
                                    <option value="{{ $guardian->id }}" {{ old('guardian_id') == $guardian->id ? 'selected' : '' }}>{{ $guardian->user->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('guardian_id')" class="mt-2" />
                        </div>

                        <!-- Admission Date -->
                        <div class="mt-4">
                            <x-input-label for="admission_date" :value="__('Admission Date')" />
                            <x-text-input id="admission_date" class="block mt-1 w-full" type="date" name="admission_date" :value="old('admission_date')" />
                            <x-input-error :messages="$errors->get('admission_date')" class="mt-2" />
                        </div>

                        <!-- Roll Number -->
                        <div class="mt-4">
                            <x-input-label for="roll_number" :value="__('Roll Number')" />
                            <x-text-input id="roll_number" class="block mt-1 w-full" type="text" name="roll_number" :value="old('roll_number')" required />
                            <x-input-error :messages="$errors->get('roll_number')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.students.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button class="ml-4">
                                {{ __('Save Student') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
