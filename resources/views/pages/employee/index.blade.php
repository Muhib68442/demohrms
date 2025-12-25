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

            <div class='flex items-center gap-4 justify-center mb-6'>
                <div class='flex items-center gap-2'>
                    <x-input-label for="status" :value="__('Status')" />
                    <select name="status" id="filterStatus" class='input-select'>
                        <option value="">All</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class='flex items-center gap-2'>
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select name="gender" id="filterGender" class='input-select'>
                        <option value="">All</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <button id='refresh' class='p-2 bg-gray-200 rounded dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700'>{{ svg('css-spinner', 'w-5 h-5') }}</button>
            </div>



            <table class="min-w-full divide-y divide-gray-200  table-stripe mt-4" id="employeeTable">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            #
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Image
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
                            Action
                        </th>
                    </tr>
                </thead>

                {{-- <tbody class="bg-white divide-y divide-gray-200">
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
                </tbody> --}}
            </table>

            
            {{-- {{$employees->links()}} --}}
        </div>

    </x-slot>



</x-app-layout>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Datatables core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- ColVis button -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>


<script>
    $(document).ready(function () {
        console.log("ready!");
        $('#employeeTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{ route('employees.index') }}",
                data: function(d){
                    d.filterStatus = $('#filterStatus').val();
                    d.filterGender = $('#filterGender').val();
                }
            },
            columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'id' 
                },
                {
                    data : 'image',
                    name: 'image',
                    defaultContent: '--',
                    orderable: false,
                    searchable: false
                },
                {
                    data : 'name',
                    name: 'name',
                    defaultContent: '--'
                },
                {
                    data : 'email',
                    name: 'email',
                    defaultContent: '--'
                }
                ,{
                    data : 'phone',
                    name: 'phone',
                    defaultContent: '--'
                }
                ,{
                    data : 'status',
                    name: 'status',
                    defaultContent: '--',
                    orderable: false,
                    searchable: false
                }
                ,{
                    data : 'action',
                    name: 'action',
                    defaultContent: '--',
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                search: "Search",
                searchPlaceholder: "Type name or email..."
            },
            dom: '<"top"lBf>rt<"bottom"ip>',
            // B = Buttons, l = lengthMenu dropdown, f = search box, r = processing, t = table, i = info, p = pagination
            
           
            buttons: [
                {
                    extend: 'copy',
                    text: `Copy`
                },
                {
                    extend: 'csv',
                    text: `CSV`
                },
                {
                    extend: 'excel',
                    text: `Excel`
                },
                {
                    extend: 'pdf',
                    text: `PDF`
                },
                {
                    extend: 'print',
                    text: `Print`
                },
                {
                    text: `Reload`,
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                },
                {
                    extend: 'colvis',
                    text: `View`
                },
            ],

            lengthMenu: [ [10, 20, 30, 40], [10, 20, 30, 40] ],
            pageLength: 10, // default show
        });

        $("#refresh").click(function(){
            $('#employeeTable').DataTable().ajax.reload();
        });
    });

</script>
