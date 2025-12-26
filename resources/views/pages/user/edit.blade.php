{{-- Edit Form  --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('users.update', $user->id) }}" method="post" class="max-w-md mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-md shadow-md" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h3 class='text-lg font-semibold mb-4 text-gray-800 dark:text-white'>Edit User</h3>
                <p class='mb-4 text-gray-600'>Update the User information below.</p>

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"  />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"  />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required>
                        <option value="">Select Status</option>
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <!-- Roles -->
                <div class="mb-4">
                    <x-input-label :value="__('Assign Roles')" />
                    
                    @if($roles->count() > 0)
                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($roles as $role)
                                <label class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        {{ in_array($role->id, old('roles', $userRoles)) ? 'checked' : '' }}>
                                    <span class="ml-3 text-sm text-gray-900 dark:text-gray-300">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mt-2">No roles available.</p>
                    @endif
                    
                    <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                </div>


                <!-- Submit Button -->
                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">
                        Cancel
                    </a>
                    <x-primary-button>
                       {{ svg('css-check', 'w-5 h-5') }} {{ __('Update User') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>