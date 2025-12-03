<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('admin.sections.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Grade -->
                        <div class="mb-4">
                            <x-input-label for="grade_id" :value="__('Grade')" />
                            <select id="grade_id" name="grade_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Select Grade</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('grade_id')" class="mt-2" />
                        </div>

                        <!-- Capacity -->
                        <div class="mb-4">
                            <x-input-label for="capacity" :value="__('Capacity')" />
                            <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="old('capacity', 30)" required min="1" />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.sections.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                            <x-primary-button>
                                {{ __('Create Section') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
