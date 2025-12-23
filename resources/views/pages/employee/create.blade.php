{{-- Create Form  --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('employees.store') }}" method="post" class="max-w-md mx-auto mt-8 bg-white dark:bg-gray-800 p-6 rounded-md shadow-md" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Name:</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Email:</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Phone:</label>
                            <input type="text" name="phone" id="phone" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Address:</label>
                            <input type="text" name="address" id="address" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="gender" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Gender:</label>
                            <select name="gender" id="gender" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="profile" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Profile:</label>
                            <input type="file" name="profile" id="profile" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>



                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>