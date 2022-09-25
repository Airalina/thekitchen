<div>
    @switch($view)
        @case('list')
            @include('user.list')
        @break

        @case('create')
            @include('user.create')
        @break

        @case('edit')
            @include('user.edit')
        @break
    @endswitch
</div>
