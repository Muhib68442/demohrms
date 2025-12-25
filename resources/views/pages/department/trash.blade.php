<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('departments.index') }}" class="p-2 rounded-md hover:bg-gray-700 transition">
                {{ svg('css-chevron-left', 'w-6 h-6') }}
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Trashed Departments') }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="slot">
        <x-alert />

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 p-4">
            @if($departments->isEmpty())
                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                    <p class="text-xl">No trashed departments found</p>
                </div>
            @else
                <table class="min-w-full divide-y divide-gray-200 table-stripe">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">ID</th>
                            <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Name</th>
                            <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Deleted At</th>
                            <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($departments as $department)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ $department->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $department->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ $department->deleted_at->format('d M Y, h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium flex items-center gap-2">
                                    <form action="{{ route('departments.restore', $department->id) }}" method="post" class="inline-block">
                                        @csrf
                                        <button type="submit" class="px-2 py-2 text-green-500 hover:bg-green-500 hover:text-white rounded-md transition">
                                            {{ svg('css-redo', 'w-5 h-5 inline') }} Restore
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('departments.forceDelete', $department->id) }}" method="post" class="inline-block" onsubmit="return confirm('Permanently delete? Cannot be undone!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition">
                                            {{ svg('css-trash', 'w-5 h-5 inline') }} Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $departments->links() }}
            @endif
        </div>
    </x-slot>
</x-app-layout>