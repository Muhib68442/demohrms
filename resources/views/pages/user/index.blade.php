<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
        <div class="flex items-center gap-4">
            {{-- <a class="btn-blue" href="{{ route('users.create') }}">Add Employee</a> --}}
            {{-- <a href="{{ route('users.trash') }}">{{ svg('css-trash', 'w-6 h-6') }}</a> --}}
            <x-anchor_button href="{{ route('users.create') }}" variant='secondary'>{{ svg('css-add', 'w-4 h-4') }} Add User</x-anchor_button>
            <x-anchor_button href="{{ route('users.trash') }}" variant='secondary'>{{ svg('css-trash', 'w-4 h-4') }}</x-anchor_button>
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

                <button id='refresh' class='p-2 bg-gray-200 rounded dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700'>{{ svg('css-spinner', 'w-5 h-5') }}</button>
            </div>



            <table class="min-w-full divide-y divide-gray-200  table-stripe mt-4" id="table">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            #
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Name
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Email
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Status
                        </th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-900 dark:text-gray-300 text-left">
                            Action
                        </th>
                    </tr>
                </thead>

                
            </table>
        </div>

    </x-slot>



</x-app-layout>

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
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{ route('users.index') }}",
                data: function(d){
                    d.filterStatus = $('#filterStatus').val();
                }
            },
            columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'id' 
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
            $('#table').DataTable().ajax.reload();
        });
    });

</script>
