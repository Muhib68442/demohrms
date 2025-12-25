{{-- Edit Form  --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('employees.update', $employee->id) }}" method="post" class="max-w-md mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-md shadow-md" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h3 class='text-lg font-semibold mb-4 text-gray-800 dark:text-white'>Edit Employee</h3>
                <p class='mb-4 text-gray-600'>Update the employee information below.</p>

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $employee->name)" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $employee->email)" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $employee->phone)" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $employee->address)" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Gender -->
                <div class="mb-4">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select name="gender" id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required>
                        <option value="">Select Status</option>
                        <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <!-- Current Image -->
                @if($employee->image)
                <div class="mb-4">
                    <x-input-label :value="__('Current Image')" />
                    <img src="{{ asset('storage/employees/' . $employee->image) }}" alt="Employee Image" class="w-32 h-32 object-cover rounded-md mt-2">
                </div>
                @endif

                <!-- Profile Image -->
                <div class="mb-4">
                    <x-input-label for="image" :value="__('Profile Image (Optional)')" />
                    <input type="file" name="image" id="image" accept="image/*" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <p class="text-sm text-yellow-600 dark:text-yellow-400">*Note: Leave empty to keep current image. Max size 2MB</p>

                <!-- Submit Button -->
                <div class="flex justify-end gap-2 mt-4">
                    <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">
                        Cancel
                    </a>
                    <x-primary-button>
                       {{ svg('css-check', 'w-5 h-5') }} {{ __('Update Employee') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>