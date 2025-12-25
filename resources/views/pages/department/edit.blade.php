<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('departments.update', $department->id) }}" method="post" class="max-w-md mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-md shadow-md">
                @csrf
                @method('PUT')

                <h3 class='text-lg font-semibold mb-4 text-gray-800 dark:text-white'>Edit Department</h3>

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Department Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $department->name)" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" rows="4" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">{{ old('description', $department->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required>
                        <option value="active" {{ old('status', $department->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $department->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2">
                    <a href="{{ route('departments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">
                        Cancel
                    </a>
                    <x-primary-button>
                        {{ svg('css-check', 'w-5 h-5') }} {{ __('Update Department') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>