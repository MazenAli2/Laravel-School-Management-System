<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Guardian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Guardian Details</h3>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Name</label>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $guardian->user->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $guardian->user->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $guardian->phone_number ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Occupation</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $guardian->occupation ?? 'N/A' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Address</label>
                            <p class="mt-1 text-lg text-gray-900">{{ $guardian->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
