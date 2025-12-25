<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Employees') }}
        </h2>
        <div class="flex items-center gap-4">
            {{-- <a class="btn-blue" href="{{ route('employees.create') }}">Add Employee</a> --}}
            {{-- <a href="{{ route('employees.trash') }}">{{ svg('css-trash', 'w-6 h-6') }}</a> --}}
            <x-anchor_button href="{{ route('employees.create') }}" variant='secondary'>{{ svg('css-add', 'w-4 h-4') }} Add Employee</x-anchor_button>
            <x-anchor_button href="{{ route('employees.trash') }}" variant='secondary'>{{ svg('css-trash', 'w-4 h-4') }}</x-anchor_button>
        </div>
    </x-slot>


    <x-slot name="slot">
        <x-alert />

        <div class=" relative overflow-x-auto shadow-md sm:rounded-lg  mt-4  p-4  ">

            <table class="min-w-full divide-y divide-gray-200  table-stripe ">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            ID
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Name
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Email
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Phone
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Status
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Image
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($employees as $employee)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $employee->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                <img src="{{ asset('images/demo.jpg') }}" alt="image" class="w-10 h-10 rounded-full">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $employee->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $employee->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $employee->phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300 rounded-md }}">
                                <span class="px-2 py-1 {{ $employee->status == 'active' ? 'bg-green-500' : 'bg-red-500' }} {{ $employee->status == 'active' ? 'text-green-100' : 'text-red-100' }} rounded-lg">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium flex items-center gap-2">
                                <a class="px-2 py-2 text-blue-500 hover:bg-blue-500 hover:text-white rounded-md transition ease-in-out duration-150" href="{{ route('employees.destroy', $employee->id) }}">View</a>
                                <a class="px-2 py-2 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded-md transition ease-in-out duration-150" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="post" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition ease-in-out duration-150">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
            {{$employees->links()}}
        </div>

    </x-slot>



</x-app-layout>