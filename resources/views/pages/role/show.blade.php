<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('roles.index') }}" class="p-2 rounded-md hover:bg-gray-700 transition">
                {{ svg('css-chevron-left', 'w-6 h-6') }}
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Role Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                
                <!-- Role Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-8 text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center">
                            {{ svg('css-user', 'w-8 h-8') }}
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold">{{ $role->name }}</h3>
                            <p class="text-indigo-100 mt-1">{{ $permissions->count() }} permissions assigned</p>
                        </div>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="p-6">
                    
                    <!-- Role Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                {{ svg('css-calendar', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Created</h4>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 ml-8">{{ $role->created_at->format('d M Y') }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                {{ svg('css-time', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Last Updated</h4>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 ml-8">{{ $role->updated_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Permissions List -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                            {{ svg('css-lock-unlock', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                            Permissions
                        </h4>
                        
                        @if($permissions->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($permissions as $permission)
                                    <div class="flex items-center gap-2 p-3 bg-white dark:bg-gray-800 rounded-md">
                                        {{ svg('css-check', 'w-4 h-4 text-green-500') }}
                                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No permissions assigned to this role.</p>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 mt-8 justify-end">
                        <a href="{{ route('roles.edit', $role->id) }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            {{ svg('css-pen', 'w-5 h-5') }}
                            Edit
                        </a>
                        
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this role?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                {{ svg('css-trash', 'w-5 h-5') }}
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>