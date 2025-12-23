<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('employees.index') }}" class="p-2 rounded-md hover:bg-gray-100 font-semibold mx-4"><</a>
            <span>
                {{ __('View Employee') }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full">
                        <tr class='border border-gray-400 p-2 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100 transition-all'>
                            <th class='py-4 font-semibold text-4xl'>Employee Name</th>
                            <td>
                                {{ $employee->name }}
                            </td>
                        </tr>
                        <tr class='border border-gray-400 p-2 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100 transition-all'>
                            <th class='py-4 font-semibold text-4xl'>Employee Email</th>
                            <td>
                                {{ $employee->email }}
                            </td>
                        </tr>
                        <tr class='border border-gray-400 p-2 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100 transition-all'>
                            <th class='py-4 font-semibold text-4xl'>Employee Phone</th>
                            <td>
                                {{ $employee->phone }}
                            </td>
                        </tr>
                        <tr class='border border-gray-400 p-2 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100 transition-all'>
                            <th class='py-4 font-semibold text-4xl'>Employee Address</th>
                            <td>
                                {{ $employee->address }}
                            </td>
                        </tr>
                        <tr class='border border-gray-400 p-2 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-100 transition-all'>
                            <th class='py-4 font-semibold text-4xl'>Employee Gender</th>
                            <td>
                                {{ $employee->gender }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>