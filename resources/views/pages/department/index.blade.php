<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Departments') }}
        </h2>
        <div class="flex items-center gap-4">
            <x-anchor_button href="{{ route('departments.create') }}" variant='secondary'>
                {{ svg('css-add', 'w-6 h-6') }} Add Department
            </x-anchor_button>
            <x-anchor_button href="{{ route('departments.trash') }}" variant='secondary'>
                {{ svg('css-trash', 'w-6 h-6') }}
            </x-anchor_button>
        </div>
    </x-slot>

    <x-slot name="slot">
        <x-alert />

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 p-4">
            <table class="min-w-full divide-y divide-gray-200 table-stripe">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">ID</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Name</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Status</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($departments as $department)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                {{ $department->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $department->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 py-1 {{ $department->status == 'active' ? 'bg-green-500 text-green-100' : 'bg-red-500 text-red-100' }} rounded-lg">
                                    {{ ucfirst($department->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium flex items-center gap-2">
                                <a href="{{ route('departments.edit', $department->id) }}" class="px-2 py-2 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded-md transition">
                                    Edit
                                </a>
                                <form action="{{ route('departments.destroy', $department->id) }}" method="post" class="inline-block" onsubmit="return confirm('Delete this department?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                No departments found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $departments->links() }}
        </div>
    </x-slot>
</x-app-layout>