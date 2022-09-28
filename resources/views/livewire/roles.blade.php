<div>
    @switch($view)
        @case('index')
            @can('role.index')
                @include('role.index')
            @endcan
        @break

        @case('create')
            @include('role.create')
        @break

        @case('edit')
            @include('role.update')
        @break

        @case('show')
            @include('role.show')
        @break

    @endswitch
</div>