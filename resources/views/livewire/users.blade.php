<div>
    @switch($view)
        @case('index')
            @can('user.index')
                @include('user.index')
            @endcan
        @break

        @case('create')
            @include('user.create')
        @break

        @case('edit')
            @include('user.update')
        @break

        @case('show')
            @include('user.show')
        @break
    @endswitch
</div>