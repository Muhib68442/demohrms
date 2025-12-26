<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Roles') }}
        </h2>
        <div class="flex items-center gap-4">
            <x-anchor_button href="{{ route('roles.create') }}" variant='secondary'>
                {{ svg('css-add', 'w-6 h-6') }} Add Role
            </x-anchor_button>


            <x-anchor_button href="{{ route('permissions.create') }}" variant='secondary'>
                {{ svg('css-play-list-add', 'w-6 h-6') }} Add Permission
            </x-anchor_button>

            <x-anchor_button href="{{ route('permissions.index') }}" variant='secondary'>
                {{ svg('css-lock', 'w-6 h-6') }} Permissions
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
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Permissions</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Created</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($roles as $role)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ $role->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100 rounded-full text-xs font-semibold">
                                    {{ $role->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                <span class="text-gray-600 dark:text-gray-400">{{ $role->permissions->count() }} permissions</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                {{ $role->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium flex items-center gap-2">
                                <a href="{{ route('roles.show', $role->id) }}" class="px-2 py-2 text-blue-500 hover:bg-blue-500 hover:text-white rounded-md transition ease-in-out duration-150">View</a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="px-2 py-2 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded-md transition ease-in-out duration-150">Edit</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="post" class="inline-block" onsubmit="return confirm('Delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-2 text-red-500 hover:bg-red-500 hover:text-white rounded-md transition ease-in-out duration-150">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                No roles found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $roles->links() }}
        </div>
    </x-slot>
</x-app-layout>