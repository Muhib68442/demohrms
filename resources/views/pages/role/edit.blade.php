<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('roles.update', $role->id) }}" method="post" class="max-w-2xl mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-md shadow-md">
                @csrf
                @method('PUT')

                <h3 class='text-lg font-semibold mb-4 text-gray-800 dark:text-white'>Edit Role</h3>
                <p class='mb-4 text-gray-600'>Update role information and permissions.</p>

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Role Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $role->name)" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label :value="__('Assign Permissions')" />
                    
                    @if($groupedPermissions->count() > 0)
                        <div class="mt-3 space-y-6">
                            @foreach($groupedPermissions as $module => $permissions)
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <!-- Module Header -->
                                    <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center gap-2">
                                        {{ svg('css-folder', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                        {{ $module }}
                                    </h4>
                                    
                                    <!-- Permissions Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 ml-7">
                                        @foreach($permissions as $permission)
                                            <label class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                    {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                                <span class="ml-3 text-sm text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mt-2">No permissions available.</p>
                    @endif
                    
                    <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">
                        Cancel
                    </a>
                    <x-primary-button>
                        {{ svg('css-check', 'w-5 h-5') }} {{ __('Update Role') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>