<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('permissions.store') }}" method="post" class="max-w-md mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-md shadow-md">
                @csrf

                <h3 class='text-lg font-semibold mb-4 text-gray-800 dark:text-white'>Add Permission</h3>
                <p class='mb-4 text-gray-600 dark:text-gray-400'>Create a new permission that can be assigned to roles.</p>

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Permission Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required placeholder="e.g. create users, edit posts" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Use lowercase with spaces (e.g., "view users", "create departments")</p>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('permissions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">
                        Cancel
                    </a>
                    <x-primary-button>
                        {{ svg('css-add', 'w-5 h-5') }} {{ __('Create Permission') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>