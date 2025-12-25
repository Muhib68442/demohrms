@if(session('success'))
    <div class="alert alert-success" role="alert">
        <div class="flex items-center gap-2">
            {{ svg('css-check', 'w-5 h-5') }}
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if(session('danger'))
    <div class="alert alert-danger" role="alert">
        <div class="flex items-center gap-2">
            {{ svg('css-danger', 'w-5 h-5') }}
            <span>{{ session('danger') }}</span>
        </div>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning" role="alert">
        <div class="flex items-center gap-2">
            {{ svg('css-info', 'w-5 h-5') }}
            <span>{{ session('warning') }}</span>
        </div>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info" role="alert">
        <div class="flex items-center gap-2">
            {{ svg('css-info', 'w-5 h-5') }}
            <span>{{ session('info') }}</span>
        </div>
    </div>
@endif