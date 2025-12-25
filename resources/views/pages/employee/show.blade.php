<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('employees.index') }}" class="back-btn">
                {{ svg('css-chevron-left', 'w-6 h-6') }}
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Employee Details') }}
            </h2>
        </div>
    </x-slot>

    <x-alert />

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-8 text-white">
                    <div class="flex items-center gap-6">
                        @if($employee->image)
                            <img src="{{ asset('storage/employees/' . $employee->image) }}" 
                                 alt="{{ $employee->name }}" 
                                 class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center text-4xl font-bold text-gray-700">
                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                            </div>
                        @endif
                        
                        <div>
                            <h3 class="text-3xl font-bold">{{ $employee->name }}</h3>
                            <p class="text-indigo-100 mt-1">{{ $employee->email }}</p>
                            <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-semibold 
                                {{ $employee->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Phone -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                {{ svg('css-phone', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Phone</h4>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 ml-8">{{ $employee->phone }}</p>
                        </div>

                        <!-- Gender -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                {{ svg('css-user', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Gender</h4>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 ml-8">{{ ucfirst($employee->gender) }}</p>
                        </div>

                        <!-- Address -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg md:col-span-2">
                            <div class="flex items-center gap-3 mb-2">
                                {{ svg('css-pin', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Address</h4>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 ml-8">{{ $employee->address }}</p>
                        </div>

                        <!-- Created At -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                {{ svg('css-calendar', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Joined</h4>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 ml-8">{{ $employee->created_at->format('d M Y') }}</p>
                        </div>

                        <!-- Updated At -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-2">
                                {{ svg('css-time', 'w-5 h-5 text-indigo-600 dark:text-indigo-400') }}
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Last Updated</h4>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 ml-8">{{ $employee->updated_at->format('d M Y') }}</p>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 mt-8 justify-end">
                        <form action="{{route('employees.status', $employee->id)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-{{ $employee->status == 'active' ? 'red' : 'green' }}-600 text-white rounded-md hover:bg-{{ $employee->status == 'active' ? 'red' : 'green' }}-700 transition">
                                {{ svg('css-check', 'w-5 h-5') }}
                                {{ $employee->status == 'active' ? 'Deactivate' : 'Activate' }}
                            </button>   
                        </form>

                        
                        <x-secondary-button href="{{ route('employees.edit', $employee->id) }}">
                            {{ svg('css-pen', 'w-5 h-5') }}
                            Edit
                        </x-secondary-button>
                        
                        
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class='inline-block'
                              onsubmit="return confirm('Are you sure you want to delete this employee?')">
                            @csrf
                            @method('DELETE')
                            <x-danger-button>
                                {{ svg('css-trash', 'w-5 h-5') }}
                                Delete
                            </x-danger-button>
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>